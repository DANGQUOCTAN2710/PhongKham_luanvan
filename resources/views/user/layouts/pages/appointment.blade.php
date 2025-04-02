@extends('user.app')

@section('content')
    <section id="appointment" class="appointment-section">
        <div class="container">
            <h2 class="text-center">Đặt Lịch Khám</h2>
            <p class="text-center">Điền thông tin bên dưới để đặt lịch hẹn với bác sĩ</p>

            <div class="form-container">
                <form>
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Họ và Tên</label>
                        <input type="text" class="form-control" id="fullname" placeholder="Nhập họ và tên" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số Điện Thoại</label>
                        <input type="tel" class="form-control" id="phone" placeholder="Nhập số điện thoại" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Nhập email">
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Ngày Khám</label>
                        <input type="date" class="form-control" id="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Chuyên Khoa</label>
                        <select class="form-control" id="department">
                            <option value="general">Khám tổng quát</option>
                            <option value="pediatrics">Nhi khoa</option>
                            <option value="cardiology">Tim mạch</option>
                            <option value="orthopedic">Cơ xương khớp</option>
                            <option value="dermatology">Da liễu</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Ghi Chú</label>
                        <textarea class="form-control" id="message" rows="4" placeholder="Nhập ghi chú nếu có"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Xác Nhận Lịch Hẹn</button>
                </form>
            </div>
        </div>
    </section>

@endsection
