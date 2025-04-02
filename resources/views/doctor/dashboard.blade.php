@extends('doctor.layouts.app')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2 class="mt-3">Tổng Quan</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Chờ Khám</div>
                    <div class="card-body">
                        <h5 class="card-title">10</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Đang Khám</div>
                    <div class="card-body">
                        <h5 class="card-title">5</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Đã Khám</div>
                    <div class="card-body">
                        <h5 class="card-title">20</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Cận Lâm Sàng</div>
                    <div class="card-body">
                        <h5 class="card-title">7</h5>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Danh sách nhanh bệnh nhân -->
        <h3>Danh Sách Bệnh Nhân Chờ Khám</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ Tên</th>
                    <th>Tuổi</th>
                    <th>Trạng Thái</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Nguyễn Văn A</td>
                    <td>35</td>
                    <td>Chờ khám</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Trần Thị B</td>
                    <td>42</td>
                    <td>Chờ khám</td>
                </tr>
            </tbody>
        </table>
    </main>
@endsection
