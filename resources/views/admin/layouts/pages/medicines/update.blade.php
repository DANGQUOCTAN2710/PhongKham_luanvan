@extends('admin.app')

@section('content')
<div class="container">
    <h2>Chỉnh Sửa Thuốc</h2>
    <a href="{{ route('medicines.index') }}" class="btn btn-secondary mb-3">⬅ Quay lại</a>

    <form action="{{ route('medicines.update', $medicine->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Tên Thuốc</label>
            <input type="text" name="name" class="form-control" value="{{ $medicine->name }}" required>
        </div>

        <div class="mb-3">
            <label for="dosage" class="form-label">Hàm Lượng</label>
            <input type="text" name="dosage" class="form-control" value="{{ $medicine->dosage }}" required>
        </div>

        <div class="mb-3">
            <label for="unit" class="form-label">Đơn Vị</label>
            <input type="text" name="unit" class="form-control" value="{{ $medicine->unit }}" required>
        </div>

        <div class="mb-3">
            <label for="instructions" class="form-label">Hướng Dẫn Sử Dụng</label>
            <textarea name="instructions" class="form-control" rows="3" required>{{ $medicine->instructions }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Giá Thuốc</label>
            <input type="number" name="price" class="form-control" value="{{ $medicine->price }}" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Số Lượng Tồn Kho</label>
            <input type="number" name="stock" class="form-control" value="{{ $medicine->stock }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Trạng Thái</label>
            <select name="status" class="form-control" required>
                <option value="Còn hàng" {{ $medicine->status == 'Còn hàng' ? 'selected' : '' }}>Còn hàng</option>
                <option value="Hết hàng" {{ $medicine->status == 'Hết hàng' ? 'selected' : '' }}>Hết hàng</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
    </form>
</div>
@endsection
