@extends('admin.app')

@section('content')
<div class="container">
    <h2 class="mt-3">Chỉnh Sửa Phòng Khám</h2>

    <form action="{{ route('clinics.update', $clinic->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tên Phòng Khám</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $clinic->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Địa Chỉ</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $clinic->address) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Số Điện Thoại</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $clinic->phone) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $clinic->email) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Người Quản Lý</label>
            <input type="text" class="form-control" value="{{ $clinic->user->name }}" readonly>
            <input type="hidden" name="user_id" value="{{ $clinic->user_id }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng Thái</label>
            <select name="status" class="form-select">
                <option value="Đang hoạt động" {{ $clinic->status == 'Đang hoạt động' ? 'selected' : '' }}>Đang hoạt động</option>
                <option value="Bị từ chối" {{ $clinic->status == 'Bị từ chối' ? 'selected' : '' }}>Bị từ chối</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật</button>
        <a href="{{ route('clinics.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
