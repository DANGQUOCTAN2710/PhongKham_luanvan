<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Staff;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clinic = Clinic::all();
        $staffs = Staff::with('user', 'clinic')->paginate(5);
        return view('admin.layouts.pages.staffs.index')->with(['staffs'=> $staffs, 'clinics'=> $clinic]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clinics = Clinic::all();
        return view('admin.layouts.pages.staffs.create')->with('clinics', $clinics);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:6',
            'gender'    => 'required|in:Nam,Nữ,Khác',
            'dob'       => 'required|date',
            'phone'     => 'nullable|string|max:20',
            'clinic_id' => 'nullable|exists:clinics,id',
            'position'  => 'required|in:Tiếp đón,Cấp thuốc',
        ]);

        // Tạo tài khoản user cho nhân viên
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'staff', 
            'gender'   => $request->gender,
            'dob'      => $request->dob,
            'age'      => Carbon::parse($request->dob)->age, 
        ]);

        // Tạo nhân viên
        $staff = Staff::create([
            'user_id'   => $user->id,
            'clinic_id' => $request->clinic_id,
            'position'  => $request->position,
            'phone'     => $request->phone,
            'status'    => 'Đang làm việc', // Trạng thái mặc định
        ]);

        return redirect()->route('staffs.index')->with('success', 'Nhân viên đã được thêm thành công!');
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
        $clinics = Clinic::all();
        $staff = Staff::with('user')->find($id);
        if(is_null($staff)){
            return redirect()->route('staffs.index')->with('error','Không tìm thấy nhân viên.');
        }
        return view('admin.layouts.pages.staffs.update')->with(['clinics' => $clinics, 'staff'=> $staff]);
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
    public function destroy($id)
    {
        $staff = Staff::find($id);
        if($staff){
            $staff->delete();
        }
        if($staff->user){
            $staff->user->delete();
        }
        return redirect()->route('staffs.index')->with('success', 'Nhân viên đã được xóa thành công.');
    }
}
