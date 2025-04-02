<?php

use App\Http\Controllers\Admin\ClinicController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Doctor\ExamController;
use App\Http\Controllers\Doctor\LabController;
use App\Http\Controllers\Doctor\ReceiveController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\UserController;
use App\Models\HospitalFee;
use Illuminate\Support\Facades\Route;
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('/');
    Route::get('/appointment',[AppointmentController::class,'index'])->name('user.appointment');
});



Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/', [MainController::class,'index'])->name('admin.dashboard');
        
        Route::resource('clinics', ClinicController::class);


        Route::resource('doctors', DoctorController::class);
        Route::post('/doctors/approve', [DoctorController::class,'approve'])->name('doctors.approve');
        Route::post('/doctors/reject', [DoctorController::class,'reject'])->name('doctors.reject');
        Route::post('/doctors/notify', [DoctorController::class,'sendNotification'])->name('doctors.notify');
        
        Route::resource('staffs', StaffController::class);
        Route::resource('medicines', MedicineController::class);
        Route::resource('patients', PatientController::class);
        Route::resource('specialty', SpecialtyController::class);

        // Nhập excel - thuốc
        Route::post('/medicines/import', [MedicineController::class, 'import'])->name('medicines.import');
    });

    Route::prefix('doctor')->group(function () {
        Route::get('/', [DoctorController::class,'index_doctor'])->name('doctor.dashboard');
        
        Route::get('/patient', [PatientController::class,'getAllPatients'])->name('doctor.patient');

        // Tiếp nhận
        Route::resource('receive', ReceiveController::class);

        //danh sách chờ khám 
        Route::get('/list_waiting', [ReceiveController::class,'list_waiting_exam'])->name('doctor.exam_waiting');
        
        //danh sách chờ xét nghiệm
        Route::get('/list_lab', [ReceiveController::class,'list_waiting_lab'])->name('doctor.lab_waiting');

        // Khám lâm sàng
        Route::get('/exam', [PatientController::class,'index_exam'])->name('doctor.exam');
        Route::post('/exam', [ExamController::class,'store'])->name('exam.store');
        Route::get('/exam/{id}', [ExamController::class,'show'])->name('exam.show');
        Route::put('/exam/{id}', [ExamController::class, 'update'])->name('exam.update');

        // Khám cận lâm sàng
        Route::get('/lab', [LabController::class,'index'])->name('doctor.lab');
        Route::get('/lab/{id}', [LabController::class,'show'])->name('lab.show');
        Route::get('/lab1/{id}', [LabController::class,'show1'])->name('lab.show1');
        Route::post('/lab/treatment/{id}', [LabController::class, 'Treatment'])->name('doctor.lab.Treatment');
        Route::post('/lab/{id}', [LabController::class, 'storeLabResults'])->name('doctor.lab.storeLabResults');
        // Route::post('/exam', [ExamController::class,'store'])->name('exam.store');
        // Route::get('/exam/{id}', [ExamController::class,'show'])->name('exam.show');
        // Route::put('/exam/{id}', [ExamController::class, 'update'])->name('exam.update');
        
        // Viện phí
        Route::get('/fee', [FeeController::class, 'index'])->name('doctor.fee');
        Route::get('/schedule', function(){return view('doctor.schedule');})->name('doctor.schedule');
        
        // Route mới để lấy thông tin bệnh nhân dưới dạng JSON
        Route::get('/fee/{id}', [FeeController::class, 'getFeeData'])->name('doctor.fee.show');

        // thanh toán hóa đơn
        Route::put('/payment/approve/{id}', [FeeController::class, 'approvePayment'])->name('payment.approve');
    });
});



