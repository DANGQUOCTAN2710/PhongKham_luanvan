<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clinics = Clinic::paginate(5);
        return view('admin.layouts.pages.clinics.index', compact('clinics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'doctor')->doesntHave('clinic')->get();

        return view('admin.layouts.pages.clinics.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $validatedData = $request->validate([
            'name'    => 'required|string|max:255|unique:clinics',
            'address' => 'required|string',
            'phone'   => 'required|string|max:20|unique:clinics',
            'email'   => 'nullable|email|unique:clinics',
            'user_id' => 'required|exists:users,id',
        ]);

        // Tạo mới phòng khám
        $clinic = Clinic::create($validatedData);
        $clinic->status = 'Đang hoạt động';
        $clinic->save();

        $doctor = Doctor::where('user_id', $clinic->user_id)->first();
        $doctor->status = 'Đã đăng ký';
        $doctor->clinic_id = $clinic->id;
        $doctor->save();
        // Chuyển hướng với thông báo thành công
        return redirect()->route('clinics.index')->with('success', 'Phòng khám đã được thêm thành công.');
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
        $clinic = Clinic::findOrFail($id);
        return view('admin.layouts.pages.clinics.update', compact('clinic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $clinic = Clinic::findOrFail($id); // Tìm phòng khám cần cập nhật

        $validatedData = $request->validate([
            'name'    => 'required|string|max:255|unique:clinics,name,' . $id,
            'address' => 'required|string',
            'phone'   => 'required|string|max:20|unique:clinics,phone,' . $id,
            'email'   => 'nullable|email|unique:clinics,email,' . $id,
            'status'  => 'in:Chờ duyệt,Bị từ chối,Đang hoạt động',
        ]);

        // Cập nhật dữ liệu (Không cập nhật user_id)
        $clinic->update([
            'name'    => $validatedData['name'],
            'address' => $validatedData['address'],
            'phone'   => $validatedData['phone'],
            'email'   => $validatedData['email'],
            'status'  => $validatedData['status'],
        ]);

        return redirect()->route('clinics.index')->with('success', 'Phòng khám đã được cập nhật.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $clinic = Clinic::findOrFail($id); // Tìm phòng khám cần xóa

        $clinic->delete(); // Xóa phòng khám

        return redirect()->route('clinics.index')->with('success', 'Phòng khám đã được xóa.');
    }
}
