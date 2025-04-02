@extends('doctor.layouts.app')

@section('content')
    <div class="container">
    <h2 class="mb-4">Khám bệnh cho bệnh nhân</h2>
    
    <!-- Thông tin bệnh nhân -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Thông tin bệnh nhân</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
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
                <div class="col-md-4">
                    <label>Tiền sử bệnh:</label>
                    <input type="text" class="form-control" value="Tiểu đường" disabled>
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
                <label>Triệu chứng:</label>
                <textarea class="form-control" rows="3" placeholder="Nhập triệu chứng..."></textarea>
            </div>
        </div>
    </div>
    
    <!-- Chỉ định -->
    <div class="card mb-4">
        <div class="card-header bg-warning text-white">Chỉ định</div>
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
                <input class="form-check-input" type="checkbox" value="thuoc" id="keThuoc">
                <label class="form-check-label" for="keThuoc">Kê đơn thuốc</label>
            </div>
        </div>
    </div>
    
    <!-- Hành động -->
    <div class="text-center">
        <button class="btn btn-primary">Lưu thông tin</button>
        <button class="btn btn-success">Hoàn tất khám</button>
        <button class="btn btn-info">Hẹn tái khám</button>
    </div>
</div>
@endsection
