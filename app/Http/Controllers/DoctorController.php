<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Clinic;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::with('user', 'clinic')->paginate(5);
        $clinics = Clinic::all();
        return view('admin.layouts.pages.doctors.index')->with(['doctors' => $doctors, 'clinics'=> $clinics]);
    }

    public function index_doctor(){
        return view('doctor.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clinics = Clinic::all();
        return view('admin.layouts.pages.doctors.create', compact('clinics'));
    }


    public function create_receive(){
        return view('doctor.pages.receive');
    }
    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|min:6',
            'gender'         => 'required|in:Nam,Nữ',
            'dob'            => 'required|date',
            'specialties'    => 'required|string|max:255',
            'type'           => 'required|in:Điều trị,Cận lâm sàng',
            'license_number' => 'required|string|max:255',
            'clinic_id'      => 'nullable|exists:clinics,id',
        ], [
            'name.required'           => 'Vui lòng nhập tên bác sĩ.',
            'name.string'             => 'Tên bác sĩ phải là chuỗi ký tự.',
            'name.max'                => 'Tên bác sĩ không được vượt quá 255 ký tự.',
            
            'email.required'          => 'Vui lòng nhập email.',
            'email.email'             => 'Email không hợp lệ.',
            'email.unique'            => 'Email này đã tồn tại, vui lòng chọn email khác.',
        
            'password.required'       => 'Vui lòng nhập mật khẩu.',
            'password.min'            => 'Mật khẩu phải có ít nhất 6 ký tự.',
        
            'gender.required'         => 'Vui lòng chọn giới tính.',
            'gender.in'               => 'Giới tính phải là Nam hoặc Nữ.',
        
            'dob.required'            => 'Vui lòng nhập ngày sinh.',
            'dob.date'                => 'Ngày sinh không hợp lệ.',
        
            'specialties.required'    => 'Vui lòng chọn chuyên môn.',
            'specialties.string'      => 'Chuyên môn phải là chuỗi ký tự.',
            'specialties.max'         => 'Chuyên môn không được vượt quá 255 ký tự.',
        
            'type.required'           => 'Vui lòng chọn loại bác sĩ.',
            'type.in'                 => 'Loại bác sĩ phải là Điều trị hoặc Cận lâm sàn.',
        
            'license_number.required' => 'Vui lòng nhập chứng chỉ hành nghề.',
            'license_number.string'   => 'Chứng chỉ hành nghề phải là chuỗi ký tự.',
            'license_number.max'      => 'Chứng chỉ hành nghề không được vượt quá 255 ký tự.',
        
            'clinic_id.exists'        => 'Phòng khám không hợp lệ.',
        ]);
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'gender'   => $request->gender,
            'dob'      => $request->dob,
            'age'      => Carbon::parse($request->dob)->age, 
            'role'     => 'doctor',
        ]);

        $doctor = Doctor::create([
            'user_id'        => $user->id,
            'clinic_id'      => $request->clinic_id, 
            'specialties'    => $request->specialties,
            'type'           => $request->type,
            'license_number' => $request->license_number,
        ]);

        $doctor->status = $doctor->clinic_id ? 'Đã đăng ký' : 'Chưa đăng ký';
        $doctor->save();
        return redirect()->route('doctors.index')->with('success', 'Bác sĩ thêm thành công!');
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
        $doctor = Doctor::with(['clinic', 'user'])->find($id);

        if (is_null($doctor)) {
            // Xử lý khi không tìm thấy bác sĩ
            return redirect()->route('doctors.index')->with('error', 'Bác sĩ không tồn tại.');
        }

        return view('admin.layouts.pages.doctors.update', compact('doctor', 'clinics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate dữ liệu từ form
        $validatedData = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'gender'          => 'required|in:Nam,Nữ',
            'dob'             => 'required|date',
            'clinic_id'       => 'nullable|exists:clinics,id',
            'specialties'     => 'required|string',
            'type'            => 'required|in:Điều trị,Cận lâm sàng',
            'license_number'  => 'required|string',
        ]);

        // Lấy bác sĩ theo ID, kèm theo dữ liệu của bảng user
        $doctor = Doctor::with('user')->findOrFail($id);

        // Cập nhật thông tin của bảng user (thông tin cá nhân)
        $doctor->user->update([
            'name'   => $validatedData['name'],
            'email'  => $validatedData['email'],
            'gender' => $validatedData['gender'],
            'dob'    => $validatedData['dob'],
        ]);

        // Cập nhật thông tin của bảng doctors (thông tin bác sĩ)
        $doctor->update([
            'clinic_id'      => $validatedData['clinic_id'],
            'specialties'    => $validatedData['specialties'],
            'type'           => $validatedData['type'],
            'license_number' => $validatedData['license_number'],
        ]);

        if($doctor->clinic_id != NULL){
            $doctor->status = 'Đã đăng ký';
        }
        $doctor->save();    
        // Chuyển hướng về trang danh sách bác sĩ với thông báo thành công
        return redirect()->route('doctors.index')->with('success', 'Cập nhật bác sĩ thành công!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::find($id);

        if ($doctor) {
            $doctor->delete();
        }
        return redirect()->route('doctors.index')->with('success',value: 'Xóa thành công!');
    }
}
