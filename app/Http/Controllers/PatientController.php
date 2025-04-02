<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Patient;
use App\ModelsPatient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();
        return view('admin.layouts.pages.patients.index', compact('patients'));
    }

    public function index_exam(){
        return view('doctor.pages.exam.index');
    }
    public function getAllPatients()
    {
        // Lấy tất cả hồ sơ khám bệnh, kèm theo MedicalBook và Patient
        $medicalRecords = MedicalRecord::with(['medicalBook.patient', 'doctor.user'])
            ->get();

        return view('doctor.patient', compact('medicalRecords'));
    }

    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
