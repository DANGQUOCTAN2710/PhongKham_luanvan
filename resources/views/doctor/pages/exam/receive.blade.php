@extends('doctor.layouts.app')

@section('content')
<main class="col-md-10 ms-sm-auto px-md-4" style="height: 100vh; overflow: hidden; display: flex; flex-direction: column;">
    <h2 class="my-3 text-center text-primary">Tiếp Nhận Bệnh Nhân</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="overflow-auto flex-grow-1">
        <form action="{{ route('receive.store') }}" method="POST">
            @csrf

            <!-- Thông Tin Bệnh Nhân -->
            <div class="card p-4 mb-4">
                <h4>Thông Tin Bệnh Nhân</h4>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Tìm Kiếm Bệnh Nhân</label>
                        <input type="text" class="form-control" name="search_patient" placeholder="Nhập CCCD hoặc Số điện thoại...">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Họ và Tên</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Ngày Sinh</label>
                        <input type="date" class="form-control @error('dob') is-invalid @enderror" 
                            name="dob" value="{{ old('dob') }}">
                        @error('dob')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CCCD</label>
                        <input type="text" class="form-control @error('idUser') is-invalid @enderror" 
                            name="idUser" value="{{ old('idUser') }}">
                        @error('idUser')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Giới Tính</label>
                        <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                            <option value="Nam" {{ old('gender') == 'Nam' ? 'selected' : '' }}>Nam</option>
                            <option value="Nữ" {{ old('gender') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Số Điện Thoại</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                            name="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Địa Chỉ</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                name="address" rows="2">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Thông Tin Sinh Hiệu -->
            <div class="card p-4">
                <!-- Thông Tin Phiếu Khám -->
                    <h4>Thông Tin Phiếu Khám</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ngày Khám</label>
                            <input type="date" class="form-control @error('exam_date') is-invalid @enderror" name="exam_date" value="{{ old('exam_date') }}">
                            @error('exam_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bác Sĩ Phụ Trách - Khoa</label>
                            <select class="form-control @error('doctor_id') is-invalid @enderror" name="doctor_id">
                                @if(isset($doctors))
                                    @foreach ($doctors as $doctor)
                                        <option value="{{$doctor->id}}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                            {{$doctor->user->name}} - {{$doctor->specialties}}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="">Không tìm thấy bác sĩ</option>
                                @endif
                            </select>
                            @error('doctor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Lý Do Khám</label>
                            <textarea class="form-control @error('reason') is-invalid @enderror" name="reason" rows="2">{{ old('reason') }}</textarea>
                            @error('reason')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phòng Khám</label>
                            <select class="form-control @error('clinic_id') is-invalid @enderror" name="clinic_id">
                                @if(isset($clinic))
                                    <option value="{{$clinic->id}}" {{ old('clinic_id') == $clinic->id ? 'selected' : '' }}>
                                        {{$clinic->name}}
                                    </option>
                                @else
                                    <option value="">Chưa đăng ký làm việc</option>
                                @endif
                            </select>
                            @error('clinic_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <hr>
                <h4>Thông Tin Sinh Hiệu</h4>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Cân Nặng (kg)</label>
                        <input type="number" class="form-control @error('weight') is-invalid @enderror" 
                               name="weight" id="weight" step="0.1">
                        @error('weight')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Chiều Cao (cm)</label>
                        <input type="number" class="form-control @error('height') is-invalid @enderror" 
                               name="height" id="height" step="0.1">
                        @error('height')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">BMI</label>
                        <input type="text" class="form-control" name="bmi" id="bmi" readonly>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Lưu Thông Tin</button>
        </form>
    </div>
</main>
@endsection
