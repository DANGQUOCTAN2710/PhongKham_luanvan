@extends('admin.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Cập nhật Bác Sĩ</h2>

    <form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Cột 1: Thông tin cá nhân -->
            <div class="col-md-6">
                <h4 class="text-primary">Thông tin cá nhân</h4>
                <hr>

                <div class="mb-3">
                    <label class="form-label">Tên Bác Sĩ</label>
                    <input type="text" name="name" class="form-control" required value="{{ $doctor->user->name }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required value="{{ $doctor->user->email }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Giới tính</label>
                    <select name="gender" class="form-select" required>
                        <option value="Nam" {{ $doctor->user->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ $doctor->user->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ngày sinh</label>
                    <input type="date" name="dob" class="form-control" required value="{{ $doctor->user->dob }}">
                </div>
            </div>

            <!-- Cột 2: Thông tin bác sĩ -->
            <div class="col-md-6">
                <h4 class="text-primary">Thông tin bác sĩ</h4>
                <hr>

                <div class="mb-3">
                    <label class="form-label">Phòng khám</label>
                    <select name="clinic_id" class="form-select">
                        <!-- Hiển thị phòng khám hiện tại -->
                        @if($doctor->clinic_id == NULL)
                            <option value="" selected>Chưa đăng ký</option>
                        @else
                            <option value="{{ $doctor->clinic_id }}" selected>{{ $doctor->clinic->name }}</option>
                        @endif

                        <!-- Nếu có danh sách phòng khám khác để lựa chọn -->
                        @if(isset($clinics))
                            @foreach($clinics as $clinic)
                                @if($clinic->id != optional($doctor->clinic)->id)
                                    <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                                @endif
                            @endforeach
                        @else
                            <option value="">Không tìm thấy phòng khám</option>
                        @endif
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Chuyên môn</label>
                    <select name="specialties" class="form-select" required>
                        <option value="" disabled>-- Chọn chuyên môn --</option>
                        <option value="Nội khoa" {{ $doctor->specialties == 'Nội khoa' ? 'selected' : '' }}>Nội khoa</option>
                        <option value="Ngoại khoa" {{ $doctor->specialties == 'Ngoại khoa' ? 'selected' : '' }}>Ngoại khoa</option>
                        <option value="Sản - Phụ khoa" {{ $doctor->specialties == 'Sản - Phụ khoa' ? 'selected' : '' }}>Sản - Phụ khoa</option>
                        <option value="Nhi khoa" {{ $doctor->specialties == 'Nhi khoa' ? 'selected' : '' }}>Nhi khoa</option>
                        <option value="Tai - Mũi - Họng" {{ $doctor->specialties == 'Tai - Mũi - Họng' ? 'selected' : '' }}>Tai - Mũi - Họng</option>
                        <option value="Răng - Hàm - Mặt" {{ $doctor->specialties == 'Răng - Hàm - Mặt' ? 'selected' : '' }}>Răng - Hàm - Mặt</option>
                        <option value="Ung bướu" {{ $doctor->specialties == 'Ung bướu' ? 'selected' : '' }}>Ung bướu</option>
                        <option value="Tim mạch" {{ $doctor->specialties == 'Tim mạch' ? 'selected' : '' }}>Tim mạch</option>
                        <option value="Da liễu" {{ $doctor->specialties == 'Da liễu' ? 'selected' : '' }}>Da liễu</option>
                        <option value="Thần kinh" {{ $doctor->specialties == 'Thần kinh' ? 'selected' : '' }}>Thần kinh</option>
                        <option value="Chấn thương chỉnh hình" {{ $doctor->specialties == 'Chấn thương chỉnh hình' ? 'selected' : '' }}>Chấn thương chỉnh hình</option>
                        <option value="Tiêu hóa - Gan mật" {{ $doctor->specialties == 'Tiêu hóa - Gan mật' ? 'selected' : '' }}>Tiêu hóa - Gan mật</option>
                        <option value="Hô hấp" {{ $doctor->specialties == 'Hô hấp' ? 'selected' : '' }}>Hô hấp</option>
                        <option value="Nội tiết - Đái tháo đường" {{ $doctor->specialties == 'Nội tiết - Đái tháo đường' ? 'selected' : '' }}>Nội tiết - Đái tháo đường</option>
                        <option value="Thận - Tiết niệu" {{ $doctor->specialties == 'Thận - Tiết niệu' ? 'selected' : '' }}>Thận - Tiết niệu</option>
                        <option value="Mắt" {{ $doctor->specialties == 'Mắt' ? 'selected' : '' }}>Mắt</option>
                        <option value="Huyết học" {{ $doctor->specialties == 'Huyết học' ? 'selected' : '' }}>Huyết học</option>
                        <option value="Dị ứng - Miễn dịch" {{ $doctor->specialties == 'Dị ứng - Miễn dịch' ? 'selected' : '' }}>Dị ứng - Miễn dịch</option>
                        <option value="Đông y" {{ $doctor->specialties == 'Đông y' ? 'selected' : '' }}>Đông y</option>
                        <option value="Phục hồi chức năng" {{ $doctor->specialties == 'Phục hồi chức năng' ? 'selected' : '' }}>Phục hồi chức năng</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Loại bác sĩ</label>
                    <select name="type" class="form-select" required>
                        <option value="Điều trị" {{ $doctor->type == 'Điều trị' ? 'selected' : '' }}>Điều trị</option>
                        <option value="Cận lâm sàng" {{ $doctor->type == 'Cận lâm sàng' ? 'selected' : '' }}>Cận lâm sàng</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Chứng chỉ hành nghề</label>
                    <input type="text" name="license_number" class="form-control" required value="{{ $doctor->license_number }}">
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
