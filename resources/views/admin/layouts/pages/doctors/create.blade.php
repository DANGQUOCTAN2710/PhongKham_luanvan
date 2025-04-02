@extends('admin.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Thêm Bác Sĩ</h2>
    <form action="{{ route('doctors.store') }}" method="POST">
        @csrf
        

        <div class="row">
            <!-- Cột 1 -->
            <div class="col-md-6">
                <h4 class="text-primary">Thông tin cá nhân</h4>
                <hr>

                <div class="mb-3">
                    <label class="form-label">Tên Bác Sĩ</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" >
                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" >
                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" placeholder="Ít nhất 6 ký tự" >
                    @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Giới tính</label>
                    <select name="gender" class="form-select" >
                        <option value="Nam" {{ old('gender') == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ old('gender') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                    </select>
                    @error('gender') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Ngày sinh</label>
                    <input type="date" name="dob" class="form-control" value="{{ old('dob') }}" >
                    @error('dob') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            </div>

            <!-- Cột 2 -->
            <div class="col-md-6">
                <h4 class="text-primary">Thông tin bác sĩ</h4>
                <hr>

                <div class="mb-3">
                    <label class="form-label">Phòng khám</label>
                    <select name="clinic_id" class="form-select">
                        <option value="" selected>Không thuộc phòng khám</option>
                        @foreach($clinics as $clinic)
                            <option value="{{ $clinic->id }}" {{ old('clinic_id') == $clinic->id ? 'selected' : '' }}>
                                {{ $clinic->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('clinic_id') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Chuyên môn</label>
                    <select name="specialties" class="form-select" >
                        <option value="" disabled selected>-- Chọn chuyên môn --</option>
                        @php
                            $specialties = [
                                "Nội khoa", "Ngoại khoa", "Sản - Phụ khoa", "Nhi khoa", "Tai - Mũi - Họng",
                                "Răng - Hàm - Mặt", "Ung bướu", "Tim mạch", "Da liễu", "Thần kinh",
                                "Chấn thương chỉnh hình", "Tiêu hóa - Gan mật", "Hô hấp", "Nội tiết - Đái tháo đường",
                                "Thận - Tiết niệu", "Mắt", "Huyết học", "Dị ứng - Miễn dịch", "Đông y", "Phục hồi chức năng"
                            ];
                        @endphp
                        @foreach($specialties as $specialty)
                            <option value="{{ $specialty }}" {{ old('specialties') == $specialty ? 'selected' : '' }}>
                                {{ $specialty }}
                            </option>
                        @endforeach
                    </select>
                    @error('specialties') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Loại bác sĩ</label>
                    <select name="type" class="form-select" >
                        <option value="Điều trị" {{ old('type') == 'Điều trị' ? 'selected' : '' }}>Điều trị</option>
                        <option value="Cận lâm sàng" {{ old('type') == 'Cận lâm sàng' ? 'selected' : '' }}>Cận lâm sàng</option>
                    </select>
                    @error('type') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Chứng chỉ hành nghề</label>
                    <input type="text" name="license_number" class="form-control" value="{{ old('license_number') }}" >
                    @error('license_number') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <hr class="mt-4">

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success px-4">Lưu</button>
            <a href="{{ route('doctors.index') }}" class="btn btn-secondary px-4">Quay lại</a>
        </div>
    </form>
</div>
@endsection
