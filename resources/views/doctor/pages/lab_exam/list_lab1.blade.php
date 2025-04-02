@extends('doctor.layouts.app')

@section('content')
<main class="col-md-10 ms-sm-auto px-md-4">
    <h2 class="my-3 text-center text-primary">Danh Sách Bệnh Nhân Khám</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tìm kiếm -->
    <div class="card p-3 mb-3">
        <form method="GET" action="">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <input type="text" class="form-control" name="search" placeholder="Tìm kiếm theo tên, CCCD, SĐT...">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Danh sách bệnh nhân chờ cận lâm sàng -->
    <div class="card p-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Họ và Tên</th>
                    <th>CCCD</th>
                    <th>Số Điện Thoại</th>
                    <th>Giới tính</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clinicalTestOrders as $key)
                <tr>
                    <td>{{ $key->medicalRecord->medicalBook->patient->name }}</td>
                    <td>{{ $key->medicalRecord->medicalBook->patient->idUser }}</td>
                    <td>{{ $key->medicalRecord->medicalBook->patient->phone }}</td>
                    <td>{{ $key->medicalRecord->medicalBook->patient->gender }}</td>
                    <td>{{ $key->status }}</td>
                    <td class="text-center align-middle">
                        <div class="d-flex gap-2">
                            <!-- Nút Bắt đầu thực hiện cận lâm sàng -->
                            <a href="{{ route('lab.show1', $key->id) }}" class="btn btn-success btn-sm d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; padding: 0;">
                                <i class="fas fa-vials"></i>
                            </a>
                            <!-- Nút Xóa -->
                            <form action="" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; padding: 0;">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
@endsection
