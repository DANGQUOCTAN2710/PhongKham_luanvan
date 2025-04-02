<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\ClinicalTest;
use App\Models\ClinicalTestOrder;
use App\Models\ClinicalTestOrderDetail;
use App\Models\ClinicalTestResult;
use App\Models\ClinicTest;
use App\Models\DiagnosticImaging;
use App\Models\Doctor;
use App\Models\HospitalFee;
use App\Models\MedicalBook;
use App\Models\MedicalExamination;
use App\Models\MedicalRecord;
use App\Models\Medicine;
use App\Models\Prescription;
use App\Models\Prescription_Detail;
use App\Models\PrescriptionDetail;
use App\Models\RevisitAppointment;
use App\Models\RevisitExam;
use App\Models\Ultrasound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $medicines = Medicine::all();
        return view('doctor.pages.exam.receive', compact('medicines'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $medicines = Medicine::all();

        // Kiểm tra user có phải bác sĩ không
        if (!Auth::user()->doctor) {
            abort(403, 'User is not a doctor.');
        }
    
        // Kiểm tra bác sĩ có thuộc phòng khám không
        $clinicId = Auth::user()->doctor->clinic_id ?? null;
        if (!$clinicId) {
            abort(403, 'Doctor is not assigned to a clinic.');
        }
        
        $clinicalTestsByCategory = ClinicalTest::all()->groupBy('category');
        $ultrasounds = Ultrasound::all();
        $diagnosticImagings = DiagnosticImaging::all();     
    
        // Lấy thông tin khám bệnh
        $exam = MedicalRecord::with( 'medicalBook.patient','doctor', 'clinic')->findOrFail($id);
        
        if($exam){
            $exam->status = 'đang khám';
            $exam->save();
        }

        return view('doctor.pages.exam.index', compact('exam', 'medicines', 'clinicalTestsByCategory', 'ultrasounds', 'diagnosticImagings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        // Nếu chọn "Cấp toa", loại bỏ dữ liệu xét nghiệm
        if ($data['treatment'] === 'cap_toa') {
            unset($data['clinical_test_id'], $data['ultrasound_id'], $data['imaging_id']);
        }

        // Nếu chọn "Cận lâm sàng", loại bỏ dữ liệu thuốc (bao gồm dữ liệu mảng lồng 'medicine')
        if ($data['treatment'] === 'can_lam_sang') {
            unset($data['medicine']);
        }

        $validated = validator($data, [
            'temperature'    => 'nullable|numeric|min:35|max:42',
            'pulse'          => 'nullable|integer|min:40|max:180',
            'spo2'           => 'nullable|integer|min:80|max:100',

            'diagnosis'      => 'required|string|max:255',
            'main_disease'   => 'required|string|max:255',
            'sub_disease'    => 'nullable|string|max:255',

            'treatment'      => 'required|in:cap_toa,can_lam_sang',

            // Dữ liệu thuốc (cho Cấp toa) được gửi dưới dạng mảng lồng
            'medicine'               => 'nullable|required_if:treatment,cap_toa|array',
            'medicine.*.medicine_id' => 'required|exists:medicines,id',
            'medicine.*.dosage'      => 'required|string|min:1|max:255',
            'medicine.*.quantity'    => 'required|integer|min:1',
            // Các checkbox thời gian dùng: nếu được chọn sẽ có giá trị "1"
            'medicine.*.morning'     => 'nullable|in:1',
            'medicine.*.noon'        => 'nullable|in:1',
            'medicine.*.evening'     => 'nullable|in:1',
            'medicine.*.night'       => 'nullable|in:1',

            // Dữ liệu cận lâm sàng
            'clinical_test_id' => 'nullable|array',
            'clinical_test_id.*' => 'exists:clinical_tests,id',

            'ultrasound_id'    => 'nullable|array',
            'ultrasound_id.*'  => 'exists:ultrasounds,id',

            'imaging_id'       => 'nullable|array',
            'imaging_id.*'     => 'exists:diagnostic_imagings,id',

            're_exam_date'     => 'nullable|date|after_or_equal:today',
        ])->validate();

        // 🔹 1️⃣ Cập nhật thông tin phiếu khám
        $treatmentType = $validated['treatment'] === 'cap_toa' ? 'Cấp toa' : 'Cận lâm sàng';
        $medicalExam = MedicalRecord::findOrFail($id);
        $medicalBook = MedicalBook::where('id', $medicalExam->medical_book_id)->first();
        $doctorId = Doctor::where('user_id', Auth::id())->value('id');

        $medicalExam->update([
            'temperature'    => $validated['temperature'],
            'pulse'          => $validated['pulse'],
            'spo2'           => $validated['spo2'],
            'diagnosis'      => $validated['diagnosis'],
            'main_disease'   => $validated['main_disease'],
            'sub_disease'    => $validated['sub_disease'] ?? null,
            'treatment_type' => $treatmentType
        ]);

        // 🔹 2️⃣ Nếu chọn "Cấp toa", tạo đơn thuốc và lưu chi tiết đơn thuốc với dữ liệu thời gian dùng
        if ($validated['treatment'] === 'cap_toa' && !empty($validated['medicine'])) {
            $prescription = Prescription::create([
                'medical_record_id' => $medicalExam->id,
                'doctor_id'         => $doctorId
            ]);

            $prescriptionDetails = [];
            $totalPrescriptionPrice = 0;

            foreach ($validated['medicine'] as $medicineData) {
                $medicineId = $medicineData['medicine_id'];
                $medicine = Medicine::find($medicineId);

                if ($medicine) {
                    $quantity = $medicineData['quantity'] ?? 1;
                    $unitPrice = $medicine->price; // Đơn giá
                    $totalPrice = $medicine->price * $quantity;

                    $prescriptionDetails[] = [
                        'prescription_id' => $prescription->id,
                        'medicine_id'     => $medicineId,
                        'dosage'          => $medicineData['dosage'] ?? null,
                        'quantity'        => $medicineData['quantity'] ?? 1,
                        'unit_price'      => $unitPrice,  
                        'total_price'     => $totalPrice,
                        // Lưu các checkbox, nếu tồn tại thì là 1, nếu không thì 0
                        'morning'         => isset($medicineData['morning']) ? 1 : 0,
                        'noon'            => isset($medicineData['noon']) ? 1 : 0,
                        'evening'         => isset($medicineData['evening']) ? 1 : 0,
                        'night'           => isset($medicineData['night']) ? 1 : 0,
                        'created_at'      => now(),
                        'updated_at'      => now()
                    ];
                    $totalPrescriptionPrice += $totalPrice;
                }
            }

            if (!empty($prescriptionDetails)) {
                PrescriptionDetail::insert($prescriptionDetails);
                $prescription->total_price = $totalPrescriptionPrice;
                $prescription->save();

                $medicalExam->status = 'đã khám';
                $medicalExam->save();

                // Lưu viện phí cho đơn thuốc
                $examinationFee = 100000;  // Phí khám (mặc định hoặc tính toán)
                $medicineFee = $totalPrescriptionPrice; // Tổng phí thuốc từ PrescriptionDetail
                $clinicalFee = 0;  // Phí cận lâm sàng nếu có
                $totalFee = $examinationFee + $medicineFee + $clinicalFee;

                // Tạo bản ghi viện phí
                HospitalFee::create([
                    'prescription_id'      => $prescription->id,
                    'clinical_test_order_id' => null, // Không có cận lâm sàng trong trường hợp này
                    'examination_fee'      => $examinationFee,
                    'medicine_fee'         => $medicineFee,
                    'clinical_fee'         => $clinicalFee,
                    'total_fee'            => $totalFee,
                    'status'               => 'Chưa thanh toán'  // Trạng thái thanh toán mặc định
                ]);
            } else {
                return redirect()->route('exam.show')->with('error', 'Không xác định được đơn thuốc!');
            }
        }

        // 🔹 3️⃣ Nếu chọn "Cận lâm sàng", tạo phiếu yêu cầu xét nghiệm
        if ($validated['treatment'] === 'can_lam_sang') {
            $testRequest = ClinicalTestOrder::create([
                'medical_record_id' => $medicalExam->id,
                'doctor_id'         => $doctorId,
                'status'            => 'Chờ thực hiện'
            ]);

            $testDetails = [];
            $totalTestFee = 0;

            // Xét nghiệm
            if (!empty($validated['clinical_test_id'])) {
                foreach ($validated['clinical_test_id'] as $testId) {
                    $test = ClinicalTest::find($testId);
                    if($test){
                        $testDetails[] = [
                            'clinical_test_order_id' => $testRequest->id,
                            'clinical_test_id'       => $testId,
                            'ultrasound_id'          => null,
                            'diagnostic_imaging_id'  => null,
                            'status'                 => 'Chờ thực hiện',
                            'created_at'             => now(),
                            'updated_at'             => now()
                        ];

                        $totalTestFee += $test->fee;
                    }
                }
            }

            // Siêu âm
            if (!empty($validated['ultrasound_id'])) {
                foreach ($validated['ultrasound_id'] as $ultrasoundId) {
                    $ultrasound = Ultrasound::find($ultrasoundId);
                    if($ultrasound){
                        $testDetails[] = [
                            'clinical_test_order_id' => $testRequest->id,
                            'clinical_test_id'       => null,
                            'ultrasound_id'          => $ultrasoundId,
                            'diagnostic_imaging_id'  => null,
                            'status'                 => 'Chờ thực hiện',
                            'created_at'             => now(),
                            'updated_at'             => now()
                        ];

                        $totalTestFee += $ultrasound->fee;
                    }
                }
            }

            // Chẩn đoán hình ảnh
            if (!empty($validated['imaging_id'])) {
                foreach ($validated['imaging_id'] as $imagingId) {
                    $imaging = DiagnosticImaging::find($imagingId);
                    if($imaging){
                        $testDetails[] = [
                            'clinical_test_order_id' => $testRequest->id,
                            'clinical_test_id'       => null,
                            'ultrasound_id'          => null,
                            'diagnostic_imaging_id'  => $imagingId,
                            'status'                 => 'Chờ thực hiện',
                            'created_at'             => now(),
                            'updated_at'             => now()
                        ];

                        $totalTestFee += $imaging->fee;
                    }
                }
            }

            MedicalRecord::where('id', $id)->update(['status' => 'chờ CLS']);
            ClinicalTestOrderDetail::insert($testDetails);

            // Cập nhật tổng phí vào bảng clinical_test_orders
            $testRequest->update(['total_fee' => $totalTestFee]);
            HospitalFee::calculateTotalFee($prescription->id);
        }

        // 🔹 5️⃣ Nếu có ngày tái khám => Tạo lịch tái khám
        if (!empty($validated['re_exam_date'])) {
            RevisitAppointment::create([
                'patient_id'   => $medicalBook->patient_id,
                'clinic_id'    => $medicalExam->clinic_id,
                'revisit_date' => $validated['re_exam_date'],
                'status'       => 'Đã xác nhận'
            ]);
        }

        return redirect()->route('doctor.exam_waiting')->with('success', 'Cập nhật và lưu thông tin khám bệnh thành công!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
