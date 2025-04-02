@extends('admin.app')

@section('content')
<div class="container">
    <h2 class="mt-3">Thêm Phòng Khám</h2>

    <form action="{{ route('clinics.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tên Phòng Khám</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Địa Chỉ</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Số Điện Thoại</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Người Quản Lý</label>
            <select name="user_id" class="form-select" required>
                <option value="" disabled selected>-- Chọn người quản lý --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('clinics.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
