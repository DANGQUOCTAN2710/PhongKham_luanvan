<?php

namespace App\Http\Controllers;

use App\Models\HospitalFee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fee_list = HospitalFee::with('prescription.medicalRecord.medicalBook.patient')->get();
        return view('doctor.pages.hospital_fees.list', compact('fee_list'));
    }

    public function approvePayment($id)
    {
        // Tìm fee bằng ID
        $fee = HospitalFee::findOrFail($id);

        $fee->status = 'Đã thanh toán'; 
        $fee->save(); 

        // Quay lại trang danh sách hoặc chuyển hướng đến trang khác
        return redirect()->route('doctor.fee')->with('success', 'Thanh toán đã được duyệt!');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function getFeeData($id)
    {
        // Lấy thông tin viện phí cùng với thông tin liên quan (bao gồm prescription, clinical_test_order, ultrasound và diagnostic_imaging)
        $fee = HospitalFee::with([
            'prescription.details',  // Lấy chi tiết thuốc
            'clinicalTestOrder.clinicalTest',  // Lấy thông tin xét nghiệm
            'clinicalTestOrder.ultrasound',  // Lấy thông tin siêu âm
            'clinicalTestOrder.diagnosticImaging',  // Lấy thông tin chẩn đoán hình ảnh
            'prescription.medicalRecord.medicalBook.patient', // Lấy thông tin bệnh nhân
        ])->findOrFail($id);
    
        if ($fee) {
            $patient = $fee->prescription->medicalRecord->medicalBook->patient;
            $prescriptionDetails = $fee->prescription->details;
            $clinicalTests = $fee->clinicalTestOrder ? $fee->clinicalTestOrder->clinicalTest : null;
            $ultrasounds = $fee->clinicalTestOrder ? $fee->clinicalTestOrder->ultrasound : null;
            $diagnosticImaging = $fee->clinicalTestOrder ? $fee->clinicalTestOrder->diagnosticImaging : null;
            $medicalRecord = $fee->prescription->medicalRecord;
            // Tính tổng tiền dịch vụ và thuốc
            $totalMedicineFee = $prescriptionDetails->sum('total_price');
            $totalClinicalFee = $clinicalTests ? $clinicalTests->sum('price') : 0;
            $totalUltrasoundFee = $ultrasounds ? $ultrasounds->sum('price') : 0;
            $totalDiagnosticImagingFee = $diagnosticImaging ? $diagnosticImaging->sum('price') : 0;
            $totalFee = $fee->examination_fee + $totalMedicineFee + $totalClinicalFee + $totalUltrasoundFee + $totalDiagnosticImagingFee;
    
            return response()->json([
                'patientId' => $patient->id,
                'patient_name' => $patient->name,
                'patient_age' => $patient->age,
                'patient_gender' => $patient->gender,
                'idUser' => $patient->idUser, 
                'reason' => $medicalRecord->reason,
                'prescription_details' => $prescriptionDetails,
                'clinical_tests' => $clinicalTests,
                'ultrasounds' => $ultrasounds,
                'diagnostic_imaging' => $diagnosticImaging,
                'total_medicine_fee' => $totalMedicineFee,
                'total_clinical_fee' => $totalClinicalFee,
                'total_ultrasound_fee' => $totalUltrasoundFee,
                'total_diagnostic_imaging_fee' => $totalDiagnosticImagingFee,
                'total_fee' => $totalFee
            ]);
        }
    
        return response()->json(['error' => 'Fee not found'], 404);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
