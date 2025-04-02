<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\ClinicalTestOrder;
use App\Models\Doctor;
use App\Models\MedicalBook;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'doctor') {
            $clinic = optional($user->doctor)->clinic;
        } elseif ($user->role === 'staff') {
            $clinic = optional($user->staff)->clinic; // Nếu là staff, lấy phòng khám của staff
        } else {
            $clinic = null; // Nếu không thuộc role nào, không có clinic
        }

        // Nếu có phòng khám, lấy danh sách tất cả bác sĩ thuộc phòng khám đó
        $doctors = $clinic ? $clinic->doctors()->with('user')->get() : collect();

        return view("doctor.pages.exam.receive", compact('doctors', 'clinic'));
    }

    public function list_waiting_exam(){
        $user = Auth::user();
        $doctor = Doctor::where('user_id', $user->id)->first();
        $list_waiting = MedicalRecord::whereIn('status', ['chờ khám', 'đang khám'])
        ->where('doctor_id', $doctor->id)
        ->with('medicalBook.patient') // Lấy thông tin bệnh nhân qua sổ bệnh
        ->get();

        return view('doctor.pages.exam.list_exam')->with(['list_waiting'=> $list_waiting]);
    }

    public function list_waiting_lab()
    {
        $clinicalTestOrders = ClinicalTestOrder::where('status', 'Chờ thực hiện')
        ->with('medicalRecord.medicalBook.patient') // Lấy thông tin bệnh nhân
        ->get();
        return view('doctor.pages.lab_exam.list_lab', compact('clinicalTestOrders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'idUser' => 'required|string|max:20|unique:patients,idUser',
            'gender' => 'required|string',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'exam_date' => 'required|date',
            'doctor_id' => 'required|exists:doctors,id',
            'clinic_id' => 'required|exists:clinics,id',
            'reason' => 'required|string',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'bmi' => 'nullable|numeric',
        ]);

        $age = Carbon::parse($request->dob)->age;

        $patient = Patient::updateOrCreate(
            ['idUser' => $request->idUser],
            [
                'name' => $request->name,
                'dob' => $request->dob,
                'age' => $age,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'address' => $request->address,
            ]
        );

        if ($patient->wasRecentlyCreated) {
            $medicalbook = MedicalBook::create([
                'patient_id' => $patient->id,
            ]);
            
        }

        $bmi = null;
        if ($request->weight && $request->height) {
            $height_m = $request->height / 100; // Chuyển cm -> mét
            $bmi = round($request->weight / ($height_m * $height_m), 2);
        }

        MedicalRecord::create([
            'medical_book_id' => $medicalbook->id,
            'patient_id' => $patient->id,
            'doctor_id' => $request->doctor_id,
            'clinic_id' => $request->clinic_id,
            'exam_date' => $request->exam_date,
            'reason' => $request->reason,
            'status' => 'chờ khám',
            'weight' => $request->weight,
            'height' => $request->height,
            'bmi' => $bmi
        ]);

        return redirect()->route('receive.index')->with('success', 'Tiếp nhận bệnh nhân thành công!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
