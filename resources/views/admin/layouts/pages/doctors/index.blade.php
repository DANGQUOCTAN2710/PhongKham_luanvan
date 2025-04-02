@extends('admin.app')

@section('content')
    <div class="container">
        <h2>Danh sách bác sĩ</h2>
        <a href="{{ route('doctors.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-user-plus"></i> Thêm Bác Sĩ
        </a>
        <button class="btn btn-warning mb-3" onclick="openNotifyModal()">📢 Gửi Thông Báo</button>
        <form method="GET" action="{{ route('doctors.index') }}" class="mb-3">
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
                <div class="col-md-4">
                    <select name="specialization" class="form-control" onchange="this.form.submit()">
                        <option value="">Tất cả chuyên môn</option>
                        @php
                            $specializations = [
                                "Nội khoa", "Ngoại khoa", "Sản - Phụ khoa", "Nhi khoa", "Tai - Mũi - Họng",
                                "Răng - Hàm - Mặt", "Ung bướu", "Tim mạch", "Da liễu", "Thần kinh",
                                "Chấn thương chỉnh hình", "Tiêu hóa - Gan mật", "Hô hấp", "Nội tiết - Đái tháo đường",
                                "Thận - Tiết niệu", "Mắt", "Huyết học", "Dị ứng - Miễn dịch", "Đông y", "Phục hồi chức năng"
                            ];
                        @endphp
                        
                        @foreach ($specializations as $specialization)
                            <option value="{{ $specialization }}" {{ request('specialization') == $specialization ? 'selected' : '' }}>
                                {{ $specialization }}
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
                    <th>Chuyên Môn</th>
                    <th>Nơi Công Tác</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($doctors as $doctor)
                    <tr>
                        <td>{{ $doctor->user->name }}</td>
                        <td>{{ $doctor->specialties }}</td>
                        @if($doctor->status == 'Chưa đăng ký')
                            <td>Trống</td>
                            <td>
                                <span class="badge bg-warning">Chưa đăng ký</span>
                            </td>
                        @elseif($doctor->status == 'Bị từ chối')
                            <td>Trống</td>
                            <td>
                                <span class="badge bg-danger">Bị từ chối</span>
                            </td>
                        @elseif($doctor->status == 'Chờ duyệt')
                            <td>Chờ duyệt</td>
                            <td>
                                <span class="badge bg-warning">Chờ duyệt</span>
                            </td>
                        @else
                            <td>{{ $doctor->clinic->name }}</td>
                            <td>
                                <span class="badge bg-success">Đã duyệt</span>
                            </td>
                        @endif

                        <td>
                            <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bác sĩ này?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    {{ $doctors->links('pagination::bootstrap-5') }}
    </div>

<!-- Modal Gửi Thông Báo -->
<div class="modal fade" id="notifyModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('doctors.notify') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gửi Thông Báo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Chọn bác sĩ -->
                    <label for="doctors">Chọn Bác Sĩ:</label>
                    <select name="doctors[]" id="doctors" class="form-control select2" multiple>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }} - {{ $doctor->specialization }}</option>
                        @endforeach
                    </select>

                    <!-- Nhập nội dung thông báo -->
                    <label for="message" class="mt-3">Nội dung thông báo:</label>
                    <textarea name="message" class="form-control" rows="3" placeholder="Nhập nội dung..."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Gửi</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript -->
<script>
function openNotifyModal() {
    var notifyModal = new bootstrap.Modal(document.getElementById('notifyModal'));
    notifyModal.show();
}

// Kích hoạt Select2 cho dropdown chọn bác sĩ
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Chọn bác sĩ...",
        allowClear: true
    });
});
</script>

<!-- Nhúng thư viện Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

@endsection
