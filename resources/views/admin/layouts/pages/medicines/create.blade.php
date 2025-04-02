@extends('admin.app')

@section('content')
<div class="container">
    <h2>Thêm Thuốc Mới</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('medicines.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tên Thuốc</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Hàm Lượng</label>
            <input type="text" name="dosage" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Đơn Vị</label>
            <input type="text" name="unit" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Hướng Dẫn Sử Dụng</label>
            <textarea name="instructions" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Giá Thuốc</label>
            <input type="number" name="price" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Số Lượng Tồn Kho</label>
            <input type="number" name="stock" class="form-control" min="0" required>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Thêm Thuốc</button>
            <a href="{{ route('medicines.index') }}" class="btn btn-secondary px-4">Quay lại</a>
        </div>
    </form>
</div>
@endsection
