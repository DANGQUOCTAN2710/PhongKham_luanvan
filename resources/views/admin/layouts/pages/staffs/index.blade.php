@extends('admin.app')

@section('content')
<div class="container">
    <h2>Danh sách Nhân Viên</h2>
    <a href="{{ route('staffs.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-user-plus"></i> Thêm Nhân Viên
    </a>

    <!-- Bộ lọc theo phòng khám -->
    <form method="GET" action="{{ route('staffs.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="clinic_id" class="form-control" onchange="this.form.submit()">
                    <option value="">Tất cả phòng khám</option>
                    @foreach($clinics as $clinic)
                        <option value="{{ $clinic->id }}" {{ request('clinic_id') == $clinic->id ? 'selected' : '' }}>
                            {{ $clinic->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Họ Tên</th>
                <th>SĐT</th>
                <th>Chức Vụ</th>
                <th>Phòng Khám</th>
                <th>Trạng thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staffs as $staff)
                <tr>
                    <td>{{ $staff->user->name }}</td>
                    <td>{{ $staff->phone }}</td>
                    <td>{{ $staff->position }}</td>
                    <td>{{ $staff->clinic->name ?? 'Không có' }}</td>
                    <td>{{ $staff->status }}</td>
                    <td>
                        <a href="{{ route('staffs.edit', $staff->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('staffs.destroy', $staff->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $staffs->links('pagination::bootstrap-5') }}
</div>
@endsection
