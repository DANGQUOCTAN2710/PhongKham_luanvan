@extends('admin.app')

@section('content')
<div class="container">
    <h2 class="mt-3">Chỉnh Sửa Nhân Viên</h2>

    <form action="{{ route('staffs.update', $staff->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Cột bên trái -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Họ Tên</label>
                    <input type="text" name="name" class="form-control" value="{{ $staff->user->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $staff->user->email }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mật Khẩu</label>
                    <input type="password" name="password" class="form-control" value="{{ $staff->user->password }} " readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giới Tính</label>
                    <select name="gender" class="form-select" required>
                        <option value="Nam" {{ $staff->user->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ $staff->user->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                        <option value="Khác" {{ $staff->user->gender == 'Khác' ? 'selected' : '' }}>Khác</option>
                    </select>
                </div>
            </div>

            <!-- Cột bên phải -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Phòng Khám</label>
                    <select name="clinic_id" class="form-select">
                        <option value="" disabled>-- Chọn phòng khám --</option>
                        @foreach($clinics as $clinic)
                            <option value="{{ $clinic->id }}" {{ $staff->clinic_id == $clinic->id ? 'selected' : '' }}>
                                {{ $clinic->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Chức Vụ</label>
                    <select name="position" class="form-select" required>
                        <option value="Tiếp đón" {{ $staff->position == 'Tiếp đón' ? 'selected' : '' }}>Tiếp đón</option>
                        <option value="Cấp thuốc" {{ $staff->position == 'Cấp thuốc' ? 'selected' : '' }}>Cấp thuốc</option>
                        <option value="Cận lâm sàng" {{ $staff->position == 'Cận lâm sàng' ? 'selected' : '' }}>Cận lâm sàng</option>
                        <option value="Hỗ trợ khám bệnh" {{ $staff->position == 'Hỗ trợ khám bệnh' ? 'selected' : '' }}>Hỗ trợ khám bệnh</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Số Điện Thoại</label>
                    <input type="text" name="phone" class="form-control" value="{{ $staff->phone }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Ngày Sinh</label>
                    <input type="date" name="dob" class="form-control" value="{{ $staff->user->dob }}" required>
                </div>
            </div>
        </div>

        <!-- Nút hành động -->
        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
            <a href="{{ route('staffs.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>
</div>
@endsection
