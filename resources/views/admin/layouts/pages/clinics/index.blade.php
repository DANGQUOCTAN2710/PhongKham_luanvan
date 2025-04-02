@extends('admin.app')

@section('content')
<div class="container">
    <h2 class="mt-3">Quản Lý Phòng Khám</h2>

    <a href="{{ route('clinics.create') }}" class="btn btn-primary mb-3">Thêm Phòng Khám</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tên Phòng Khám</th>
                <th>Địa Chỉ</th>
                <th>Số Điện Thoại</th>
                <th>Email</th>
                <th>Người Quản Lý</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clinics as $clinic)
            <tr>  {{-- Áp dụng màu nền sáng --}}
                <td>{{ $clinic->name }}</td>
                <td>{{ $clinic->address }}</td>
                <td>{{ $clinic->phone }}</td>
                <td>{{ $clinic->email }}</td>
                <td>{{ $clinic->user->name ?? 'Chưa có' }}</td>
                <td>
                    <span class="badge bg-{{ $clinic->status == 'Đang hoạt động' ? 'success' : ($clinic->status == 'Chờ duyệt' ? 'warning' : 'danger') }}">
                        {{ $clinic->status }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('clinics.edit', $clinic->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('clinics.destroy', $clinic->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $clinics->links('pagination::bootstrap-5') }}
</div>
@endsection
