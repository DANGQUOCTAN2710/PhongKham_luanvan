<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\ClinicalTest;
use App\Models\ClinicalTestOrder;
use App\Models\ClinicalTestOrderDetail;
use App\Models\ClinicalTestResult;
use App\Models\Doctor;
use App\Models\MedicalBook;
use App\Models\MedicalRecord;
use App\Models\Medicine;
use App\Models\Prescription;
use App\Models\PrescriptionDetail;
use App\Models\RevisitAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clinicalTestOrders = ClinicalTestOrder::with('medicalRecord.medicalBook.patient')
        ->where('status', 'đã thực hiện')
        ->whereHas('medicalRecord', fn($query) => $query->where('status', 'đã CLS'))
        ->get();
        return view('doctor.pages.lab_exam.list_lab1', compact('clinicalTestOrders'));
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
    public function Treatment(Request $request, $id)
    {
        $validated = $request->validate([
            'treatment' => 'required|string|in:cap_toa,nhap_vien',
            'revisit_date_captoa' => 'nullable|date|after_or_equal:today',
            'medicine' => 'nullable|required_if:treatment,cap_toa|array',
            'medicine.*.medicine_id' => 'exists:medicines,id',
            'medicine.*.dosage' => 'string|max:255',
            'medicine.*.quantity' => 'integer|min:1',
            // Các checkbox thời gian dùng: nếu được chọn sẽ có giá trị "1"
            'medicine.*.morning' => 'nullable|in:1',
            'medicine.*.noon' => 'nullable|in:1',
            'medicine.*.evening' => 'nullable|in:1',
            'medicine.*.night' => 'nullable|in:1',
        ]);
            // Kiểm tra hồ sơ bệnh án
        $medicalRecord = MedicalRecord::findOrFail($id);
        if (!$medicalRecord->medical_book_id) {
            return redirect()->back()->with('error', 'Hồ sơ không hợp lệ!');
        }

        // Tìm hồ sơ khám bệnh
        $medicalBook = MedicalBook::find($medicalRecord->medical_book_id);
        if (!$medicalBook) {
            return redirect()->back()->with('error', 'Không tìm thấy hồ sơ bệnh nhân!');
        }

        // Lấy ID bác sĩ
        $doctorId = Doctor::where('user_id', Auth::id())->first();
        if (!$doctorId) {
            return redirect()->back()->with('error', 'Không tìm thấy bác sĩ!');
        }
        
        if ($validated['treatment'] === 'cap_toa' && !empty($validated['medicine'])) {
            $prescription = Prescription::create([
                'medical_record_id' => $medicalRecord->id,
                'doctor_id' => $doctorId->id,
            ]);
        
            $prescriptionDetails = [];
            foreach ($validated['medicine'] as $medicineData) {
                $medicineId = $medicineData['medicine_id'];
                $medicine = Medicine::find($medicineId);
                // Cập nhật tồn kho (nếu cần)
                $quantity = $medicineData['quantity'] ?? 1;
                if($medicine){
                    $medicine->updateStock($quantity);
                    $prescriptionDetails[] = [
                        'prescription_id' => $prescription->id,
                        'medicine_id' => $medicineId,
                        'dosage' => $medicineData['dosage'] ?? null,
                        'quantity' => $quantity,
                        'total_price' => $medicine->price * $quantity,
                        'morning' => isset($medicineData['morning']) ? 1 : 0,
                        'noon' => isset($medicineData['noon']) ? 1 : 0,
                        'evening' => isset($medicineData['evening']) ? 1 : 0,
                        'night' => isset($medicineData['night']) ? 1 : 0,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
            }
        
            if (!empty($prescriptionDetails)) {
                PrescriptionDetail::insert($prescriptionDetails);
                $medicalRecord->status = 'đã CLS';
                $medicalRecord->save();
            } else {
                return redirect()->route('exam.show')->with('error', 'Không xác định được đơn thuốc!');
            }
        }
        
        if (isset($validated['revisit_date_captoa']) && !empty($validated['revisit_date_captoa'])) {
            $appointment = RevisitAppointment::create([
                'patient_id' => $medicalBook->patient_id,
                'clinic_id' => $medicalRecord->clinic_id,
                'revisit_date' => $validated['revisit_date_captoa'],
                'status' => 'Đã xác nhận'
            ]);
            
        }
        return redirect()->route('doctor.lab')->with('success', 'Lưu thông tin thành công!');
    }

    public function show(string $id)
    {
        $clinicalTestOrderDetails = ClinicalTestOrderDetail::with('clinicalTest')->where("clinical_test_order_id", $id)->get();
        return view('doctor.pages.lab_exam.index', compact("clinicalTestOrderDetails"));
    }

    public function show1(string $id)
    {
        $user = ClinicalTestOrder::where('status', 'đã thực hiện')
        ->with('medicalRecord.medicalBook.patient') // Lấy thông tin bệnh nhân
        ->findOrFail($id);

        $clinicalTestOrder = ClinicalTestOrder::with('details.testResult')->findOrFail($id);
        $medicines = Medicine::all();
        
        return view('doctor.pages.lab_exam.index1', compact("clinicalTestOrder", "user", "medicines"));
    }


    public function storeLabResults(Request $request, $id)
    {
        $validated = $request->validate([
            'results' => 'required|array',
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:jpeg,png,jpg,pdf|max:2048', // Mỗi files.* là một file duy nhất
        ]);

        DB::beginTransaction();
        try {
            $allDetailsCompleted = true;

            foreach ($request->input('results', []) as $detailId => $resultText) {
                $filePath = null;

                // Kiểm tra nếu có file tải lên
                if ($request->hasFile("files.$detailId")) {
                    $filePath = $request->file("files.$detailId")->store('lab_results', 'public');
                }

                // Cập nhật hoặc tạo mới kết quả xét nghiệm
                ClinicalTestResult::updateOrCreate(
                    ['clinical_test_order_detail_id' => $detailId],
                    [
                        'result' => $resultText,
                        'file' => $filePath, // Lưu đường dẫn file duy nhất
                        'status' => 'Chưa duyệt',
                    ]
                );

                // Cập nhật trạng thái chi tiết xét nghiệm
                $detail = ClinicalTestOrderDetail::find($detailId);
                if ($detail) {
                    $detail->status = 'đã thực hiện';
                    $detail->save();
                }

                // Kiểm tra nếu có chi tiết nào chưa hoàn thành
                if ($detail->status !== 'đã thực hiện') {
                    $allDetailsCompleted = false;
                }
            }

            // Cập nhật trạng thái đơn xét nghiệm nếu tất cả chi tiết đã hoàn thành
            $clinicalTestOrder = ClinicalTestOrder::find($id);
            if ($clinicalTestOrder && $allDetailsCompleted) {
                $clinicalTestOrder->status = 'đã thực hiện';
                $clinicalTestOrder->save();
            }

            DB::commit();

            return redirect()->route('doctor.lab_waiting', $id)
                ->with('success', 'Kết quả đã được lưu thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
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
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
