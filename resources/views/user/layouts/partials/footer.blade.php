<footer class="custom-footer">
  @if (Route::currentRouteName() != 'user.appointment')
  <div class="container">
      <div class="row">
          <!-- Cột 1: Logo & Giới thiệu -->
          <div class="col-md-4">
              <h4 class="footer-title">Phòng Khám Gia Đình</h4>
              <p>Chúng tôi cam kết mang đến dịch vụ y tế chất lượng cao cho bạn và gia đình.</p>
          </div>

          <!-- Cột 2: Điều hướng -->
          <div class="col-md-4">
              <h5>Liên Kết</h5>
              <ul class="footer-links">
                  <li><a href="#">Trang Chủ</a></li>
                  <li><a href="#about">Giới Thiệu</a></li>
                  <li><a href="#features">Tính năng</a></li>
                  <li><a href="#contact">Liên Hệ</a></li>
              </ul>
          </div>

          <!-- Cột 3: Liên hệ -->
          <div class="col-md-4">
              <h5>Liên Hệ</h5>
              <p><i class="fas fa-map-marker-alt"></i> 123 Đường ABC, TP. HCM</p>
              <p><i class="fas fa-phone"></i> 0123 456 789</p>
              <p><i class="fas fa-envelope"></i> contact@phongkham.com</p>
          </div>
      </div>
      
      <hr>
  @endif

      <!-- Phần dưới cùng -->
      <div class="text-center">
          <p>&copy; 2025 Phòng Khám Gia Đình. All Rights Reserved.</p>
      </div>
  </div>
</footer>