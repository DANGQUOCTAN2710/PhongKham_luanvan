@extends('doctor.layouts.app')

@section('content')
 <!-- Main content -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2 class="mb-3">Quản Lý Lịch Hẹn</h2>
        <div class="btn-group mb-3" role="group">
            <button class="btn btn-primary" onclick="showSection('schedule')">Lịch Hẹn Khám</button>
            <button class="btn btn-secondary" onclick="showSection('follow-up')">Lịch Hẹn Tái Khám</button>
        </div>
        
        <div id="schedule-section">
            <h3 class="mb-3">Lịch Hẹn Khám</h3> 
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ Tên</th>
                        <th>Ngày Hẹn</th>
                        <th>Giờ Hẹn</th>
                        <th>Lý Do</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Nguyễn Văn A</td>
                        <td>14/02/2025</td>
                        <td>10:00 AM</td>
                        <td>Khám tổng quát</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div id="follow-up-section" class="hidden">
            <h3 class="mb-3">Lịch Hẹn Tái Khám</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ Tên</th>
                        <th>Ngày Hẹn</th>
                        <th>Ghi Chú</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Trần Thị B</td>
                        <td>20/02/2025</td>
                        <td>Kiểm tra sau điều trị</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
<script>
    function showSection(section) {
        document.getElementById('schedule-section').classList.add('hidden');
        document.getElementById('follow-up-section').classList.add('hidden');
        
        document.getElementById(section + '-section').classList.remove('hidden');
    }
</script>

@endsection
