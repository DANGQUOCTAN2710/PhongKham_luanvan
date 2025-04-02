@extends('user.app')

@section('content')
    <header class="hero">
        <div class="hero-overlay">
            <h1>Chào Mừng Đến Với <br><span>Phòng Khám Gia Đình</span></h1>
            <p>Chúng tôi luôn đồng hành cùng sức khỏe của bạn và gia đình</p>
            <a href="#" class="btn btn-primary btn-lg">Đặt Lịch Ngay</a>
        </div>
    </header>


    <section id="about" class="container my-5">
        <div class="row align-items-center">
            <!-- Cột nội dung -->
            <div class="col-lg-6">
                <h2 class="fw-bold text-gradient">🌟 Về Chúng Tôi</h2>
                <p class="text-muted">
                    Chúng tôi cam kết mang đến dịch vụ y tế <strong>chất lượng cao</strong>, tận tâm chăm sóc sức khỏe cho bạn và gia đình. Đội ngũ bác sĩ <strong>giàu kinh nghiệm</strong> kết hợp công nghệ hiện đại giúp bạn an tâm mỗi lần thăm khám.
                </p>
                <ul class="list-unstyled mt-4">
                    <li class="mb-2"><i class="fas fa-check-circle text-success"></i> Khám tổng quát chuyên sâu</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success"></i> Chăm sóc sức khỏe gia đình</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success"></i> Xét nghiệm & chẩn đoán chính xác</li>
                    <li><i class="fas fa-check-circle text-success"></i> Đội ngũ bác sĩ hàng đầu</li>
                </ul>
                <a href="#" class="btn btn-primary mt-4 px-4 py-2 shadow-lg">Tìm Hiểu Thêm</a>
            </div>

            <!-- Cột hình ảnh -->
            <div class="col-lg-6 text-center">
                <div class="image-container">
                    <img src="{{asset('img/bacsi.jpg')}}" alt="Bác sĩ tư vấn"
                        class="img-fluid rounded-3 shadow-lg">
                </div>
            </div>
        </div>
    </section>
    <section id="features" class="container my-5 text-center">
        <h2 class="fw-bold text-gradient">✨ Tính Năng Nổi Bật</h2>
        <p class="text-muted mb-5">Hệ thống quản lý phòng khám hiện đại, giúp tối ưu quy trình vận hành.</p>

        <div class="row">
            <!-- Quản lý tiếp đón -->
            <div class="col-md-3">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h5 class="mt-3 fw-bold">Quản Lý Tiếp Đón</h5>
                    <p class="text-muted">Tối ưu hóa quy trình tiếp nhận bệnh nhân, giúp tiết kiệm thời gian.</p>
                </div>
            </div>

            <!-- Quản lý khám bệnh -->
            <div class="col-md-3">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <h5 class="mt-3 fw-bold">Quản Lý Khám Bệnh</h5>
                    <p class="text-muted">Theo dõi lịch sử khám bệnh, quản lý hồ sơ sức khỏe.</p>
                </div>
            </div>

            <!-- Quản lý viện phí -->
            <div class="col-md-3">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h5 class="mt-3 fw-bold">Quản Lý Viện Phí</h5>
                    <p class="text-muted">Kiểm soát chi phí điều trị, in hóa đơn nhanh chóng.</p>
                </div>
            </div>

            <!-- Quản lý cận lâm sàng -->
            <div class="col-md-3">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <i class="fas fa-microscope"></i>
                    </div>
                    <h5 class="mt-3 fw-bold">Quản Lý Cận Lâm Sàng</h5>
                    <p class="text-muted">Hỗ trợ xét nghiệm, chẩn đoán hình ảnh, trả kết quả online.</p>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <!-- Quản lý bán thuốc -->
            <div class="col-md-3">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <i class="fas fa-pills"></i>
                    </div>
                    <h5 class="mt-3 fw-bold">Quản Lý Bán Thuốc</h5>
                    <p class="text-muted">Kiểm soát đơn thuốc, tồn kho, hỗ trợ bán lẻ nhanh.</p>
                </div>
            </div>

            <!-- Chăm sóc khách hàng -->
            <div class="col-md-3">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h5 class="mt-3 fw-bold">Chăm Sóc Khách Hàng</h5>
                    <p class="text-muted">Gửi tin nhắn nhắc lịch, tư vấn sức khỏe online.</p>
                </div>
            </div>

            <!-- Báo cáo -->
            <div class="col-md-3">
                <div class="feature-card">
                    <div class="feature-icon-box">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h5 class="mt-3 fw-bold">Báo Cáo</h5>
                    <p class="text-muted">Thống kê doanh thu, lượng bệnh nhân, hiệu suất phòng khám.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="guide" class="guide-section">
        <div class="container">
            <h2 class="text-center">Hướng Dẫn Sử Dụng</h2>
            <p class="text-center">Làm theo các bước đơn giản sau để đặt lịch khám và sử dụng dịch vụ</p>

            <div class="row">
                <div class="col-md-4 step-box">
                    <div class="step-content">
                        <i class="fas fa-user-plus"></i>
                        <h4>1. Đăng Ký / Đăng Nhập</h4>
                        <p>Tạo tài khoản hoặc đăng nhập để sử dụng dịch vụ của chúng tôi.</p>
                    </div>
                </div>

                <div class="col-md-4 step-box">
                    <div class="step-content">
                        <i class="fas fa-calendar-check"></i>
                        <h4>2. Đặt Lịch Hẹn</h4>
                        <p>Chọn bác sĩ, khung giờ phù hợp và xác nhận đặt lịch khám.</p>
                    </div>
                </div>

                <div class="col-md-4 step-box">
                    <div class="step-content">
                        <i class="fas fa-hospital"></i>
                        <h4>3. Đến Phòng Khám</h4>
                        <p>Đến phòng khám theo lịch hẹn và được bác sĩ tư vấn, điều trị.</p>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-4 step-box">
                    <div class="step-content">
                        <i class="fas fa-file-medical"></i>
                        <h4>4. Xét Nghiệm & Chẩn Đoán</h4>
                        <p>Thực hiện xét nghiệm nếu cần và nhận kết quả chẩn đoán.</p>
                    </div>
                </div>

                <div class="col-md-4 step-box">
                    <div class="step-content">
                        <i class="fas fa-pills"></i>
                        <h4>5. Nhận Đơn Thuốc</h4>
                        <p>Nhận đơn thuốc từ bác sĩ và mua thuốc tại nhà thuốc.</p>
                    </div>
                </div>

                <div class="col-md-4 step-box">
                    <div class="step-content">
                        <i class="fas fa-heart"></i>
                        <h4>6. Chăm Sóc Sức Khỏe</h4>
                        <p>Thực hiện theo hướng dẫn của bác sĩ để hồi phục nhanh chóng.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="contact-section">
        <div class="container">
            <h2 class="text-center">Liên Hệ Chúng Tôi</h2>
            <p class="text-center">Kết nối ngay với chúng tôi để được hỗ trợ tốt nhất!</p>

            <div class="row justify-content-center">
                <!-- Hộp Thông Tin Liên Hệ -->
                <div class="col-md-4 contact-box">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <h4>Địa Chỉ</h4>
                        <p>123 Đường ABC, TP. HCM</p>
                    </div>
                </div>
                <div class="col-md-4 contact-box">
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <h4>Điện Thoại</h4>
                        <p>0123 456 789</p>
                    </div>
                </div>
                <div class="col-md-4 contact-box">
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <h4>Email</h4>
                        <p>contact@phongkham.com</p>
                    </div>
                </div>
            </div>

            <!-- Form Liên Hệ -->
            <div class="row justify-content-center mt-4">
                <div class="col-md-8">
                    <form class="contact-form">
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và Tên</label>
                            <input type="text" class="form-control" id="name" placeholder="Nhập họ và tên">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Nhập email">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Nội Dung</label>
                            <textarea class="form-control" id="message" rows="4" placeholder="Nhập nội dung liên hệ"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Gửi Liên Hệ</button>
                    </form>
                </div>
            </div>
        </div>
    </section>


    
@endsection