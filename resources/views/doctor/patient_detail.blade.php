@extends('doctor.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Khám bệnh cho bệnh nhân</h2>
    
    <!-- Thông tin bệnh nhân -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Thông tin bệnh nhân</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <label>Mã bệnh nhân:</label>
                    <input type="text" class="form-control" value="BN0000001" disabled>
                </div>
                <div class="col-md-3">
                    <label>Họ Tên:</label>
                    <input type="text" class="form-control" value="Nguyễn Văn A" disabled>
                </div>
                <div class="col-md-2">
                    <label>Tuổi:</label>
                    <input type="text" class="form-control" value="35" disabled>
                </div>
                <div class="col-md-2">
                    <label>Giới tính:</label>
                    <input type="text" class="form-control" value="Nam" disabled>
                </div>
                <div class="col-md-2">
                    <label>Ngày sinh:</label>
                    <input type="text" class="form-control" value="1989" disabled>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Chỉ số sức khỏe -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">Chỉ số sức khỏe</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <label>Nhiệt độ (°C):</label>
                    <input type="text" class="form-control" placeholder="Nhập nhiệt độ...">
                </div>
                <div class="col-md-2">
                    <label>Mạch:</label>
                    <input type="text" class="form-control" placeholder="Lần/phút">
                </div>
                <div class="col-md-2">
                    <label>Nhịp thở:</label>
                    <input type="text" class="form-control" placeholder="Lần/phút">
                </div>
                <div class="col-md-2">
                    <label>Huyết áp:</label>
                    <input type="text" class="form-control" placeholder="mmHg">
                </div>
                <div class="col-md-2">
                    <label>SPO2 (%):</label>
                    <input type="text" class="form-control" placeholder="Nhập SPO2">
                </div>
                <div class="col-md-2">
                    <label>BMI:</label>
                    <input type="text" class="form-control" placeholder="Nhập BMI">
                </div>
            </div>
        </div>
    </div>
    
    <!-- Chẩn đoán lâm sàng -->
    <div class="card mb-4">
        <div class="card-header bg-success text-white">Chẩn đoán lâm sàng</div>
        <div class="card-body">
            <div class="mb-3">
                <label>Bệnh chính:</label>
                <input type="text" class="form-control" placeholder="Nhập bệnh chính...">
            </div>
            <div class="mb-3">
                <label>Bệnh phụ:</label>
                <input type="text" class="form-control" placeholder="Nhập bệnh phụ...">
            </div>
            <div class="mb-3">
                <label>Tiền sử bệnh:</label>
                <textarea class="form-control" rows="2" placeholder="Nhập tiền sử bệnh..."></textarea>
            </div>
            <div class="mb-3">
                <label>Triệu chứng:</label>
                <textarea class="form-control" rows="3" placeholder="Nhập triệu chứng..."></textarea>
            </div>
        </div>
    </div>
    
    <!-- Chỉ định cận lâm sàng -->
    <div class="card mb-4">
        <div class="card-header bg-warning text-white">Chỉ định cận lâm sàng</div>
        <div class="card-body">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="xet_nghiem" id="xetNghiem">
                <label class="form-check-label" for="xetNghiem">Xét nghiệm</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="sieu_am" id="sieuAm">
                <label class="form-check-label" for="sieuAm">Siêu âm</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="x_quang" id="xQuang">
                <label class="form-check-label" for="xQuang">X-Quang</label>
            </div>
        </div>
    </div>
    
    <!-- Hướng xử lý -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">Hướng xử lý</div>
        <div class="card-body">
            <div class="mb-3">
                <label>Xử trí:</label>
                <select class="form-control">
                    <option>Cấp toa về</option>
                    <option>Nhập viện</option>
                    <option>Hẹn tái khám</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Ngày hẹn tái khám:</label>
                <input type="date" class="form-control">
            </div>
        </div>
    </div>
    
    <!-- Hành động -->
    <div class="text-center">
        <button class="btn btn-primary">Lưu thông tin</button>
        <button class="btn btn-success">Kết thúc khám</button>
        <button class="btn btn-danger">Hủy khám</button>
        <button class="btn btn-info">In phiếu</button>
    </div>
</div>
@endsection
