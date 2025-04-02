@extends('admin.app')

@section('content')
<div class="container">
    <h2 class="mt-3">Thêm Nhân Viên</h2>

    <form action="{{ route('staffs.store') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Cột bên trái -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Họ Tên</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mật Khẩu</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giới Tính</label>
                    <select name="gender" class="form-select" required>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                        <option value="Khác">Khác</option>
                    </select>
                </div>
            </div>

            <!-- Cột bên phải -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Phòng Khám</label>
                    <select name="clinic_id" class="form-select">
                        <option value="" disabled selected>-- Chọn phòng khám --</option>
                        @foreach($clinics as $clinic)
                            <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Chức Vụ</label>
                    <select name="position" class="form-select" required>
                        <option value="Tiếp đón">Tiếp đón</option>
                        <option value="Cấp thuốc">Cấp thuốc</option>
                        <option value="Cận lâm sàng">Cận lâm sàng</option>
                        <option value="Hỗ trợ khám bệnh">Hỗ trợ khám bệnh</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Số Điện Thoại</label>
                    <input type="text" name="phone" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Ngày Sinh</label>
                    <input type="date" name="dob" class="form-control" required>
                </div>
            </div>
        </div>

        <!-- Nút hành động -->
        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-success">Lưu</button>
            <a href="{{ route('staffs.index') }}" class="btn btn-secondary">Quay lại</a>
        </div>
    </form>
</div>
@endsection
