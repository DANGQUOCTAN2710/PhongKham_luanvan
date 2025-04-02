@extends('admin.app')

@section('content')
<div class="container">
    <h2>Danh sách thuốc</h2>

    <div class="mb-3">
        <a href="{{ route('medicines.create') }}" class="btn btn-primary">Thêm Thuốc</a>

        <!-- Nút mở Modal -->
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
            Nhập Excel
        </button>
    </div>

    <!-- Modal nhập Excel -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Nhập dữ liệu từ Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('medicines.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="file" name="file" accept=".xls,.xlsx" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-success">Tải lên</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tên thuốc</th>
                <th>Thành phần</th>
                <th>Nơi sản xuất</th>
                <th>Hàm lượng</th>
                <th>Đơn vị</th>
                <th>Giá</th>
                <th>Tồn kho</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicines as $medicine)
                <tr>
                    <td>{{ $medicine->name }}</td>
                    <td>{{ $medicine->ingredient }}</td>
                    <td>{{ $medicine->manufacturer }}</td>
                    <td>{{ $medicine->dosage }}</td>
                    <td>{{ $medicine->unit }}</td>
                    <td>{{ number_format($medicine->price, 2) }} VNĐ</td>
                    <td>{{ $medicine->stock }}</td>
                    <td>
                        <span class="badge {{ $medicine->status == 'Còn hàng' ? 'bg-success' : 'bg-danger' }}">
                            {{ $medicine->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('medicines.edit', $medicine->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $medicines->links('pagination::bootstrap-5') }}
</div>
@endsection
