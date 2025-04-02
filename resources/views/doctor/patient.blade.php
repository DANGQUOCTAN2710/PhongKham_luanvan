@extends('doctor.layouts.app')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2 class="mb-3 mt-3">Quản Lý Danh Sách Bệnh Nhân</h2>
        
        <!-- Bộ lọc trạng thái -->
        <div class="mb-3">
            <label for="filter-status" class="form-label">Lọc theo trạng thái:</label>
            <select id="filter-status" class="form-select">
                <option value="Tất cả">Tất cả</option>
                <option value="chờ khám">Chờ khám</option>
                <option value="chờ CLS">Chờ CLS</option>
                <option value="đang khám">Đang khám</option>
                <option value="đã khám">Đã khám</option>
                <option value="đã CLS">Đã CLS</option>
            </select>
        </div>
        
        <!-- Danh sách bệnh nhân -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tên bệnh nhân</th>
                    <th>Bác sĩ phụ trách</th>
                    <th>Phòng khám</th>
                    <th>Lý do khám</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody id="patient-list">
                @foreach ($medicalRecords as $record)
                    <tr data-status="{{$record->status}}">
                        <td>{{ $record->medicalBook->patient->name }}</td>
                        <td>{{ $record->doctor->user->name }}</td>
                        <td>{{ $record->clinic->name ?? 'N/A' }}</td>
                        <td>{{ $record->reason }}</td>
                        <td>{{ $record->status }}</td>
                        <td><button class="btn btn-primary">Xem</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
    <script>
        document.getElementById('filter-status').addEventListener('change', function() {
            let selectedStatus = this.value;
            let rows = document.querySelectorAll('#patient-list tr');
            
            rows.forEach(row => {
                if (selectedStatus === 'Tất cả' || row.getAttribute('data-status') === selectedStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection
