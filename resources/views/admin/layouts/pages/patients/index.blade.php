@extends('admin.app')

@section('content')
<div class="container">
    <h2>Danh sách Bệnh Nhân</h2>
    <a href="{{ route('patients.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-user-plus"></i> Thêm Bệnh Nhân
    </a>

    <!-- Bộ lọc theo phòng khám -->
    <form method="GET" action="{{ route('patients.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="clinic_id" class="form-control" onchange="this.form.submit()">
                    <option value="">Tất cả phòng khám</option>
                    {{-- @foreach($clinics as $clinic)
                        <option value="{{ $clinic->id }}" {{ request('clinic_id') == $clinic->id ? 'selected' : '' }}>
                            {{ $clinic->name }}
                        </option>
                    @endforeach --}}
                </select>
            </div>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Họ Tên</th>
                <th>Số Điện Thoại</th>
                <th>CCCD</th>
                <th>Địa chỉ</th>
                <th>Phòng Khám</th>
                <th>Hành Động</th><
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
                <tr>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->phone }}</td>
                    <td>{{ $patient->clinic->name ?? 'Không có' }}</td>
                    <td>
                        <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
