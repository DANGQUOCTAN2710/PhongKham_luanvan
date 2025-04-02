<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
      <a class="navbar-brand" href="#">
          <img src="{{asset('img/unnamed.png')}}" alt="Logo Phòng Khám">
          <span>Phòng Khám <br> Gia Đình</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto"> 
              <li class="nav-item"><a class="nav-link" href="{{route('/')}}">Trang Chủ</a></li>
              <li class="nav-item"><a class="nav-link" href="#about">Giới Thiệu</a></li>
              <li class="nav-item"><a class="nav-link" href="#features">Tính năng</a></li>
              <li class="nav-item"><a class="nav-link" href="#contact">Liên Hệ</a></li>
              <li class="nav-item"><a class="nav-link" href="#guide">Hướng dẫn</a></li>
              <li class="nav-item"><a class="nav-link" href="{{route('user.appointment')}}">Hẹn khám</a></li>
          </ul>
          <!-- Đưa Đăng Nhập sang phải -->
          <ul class="navbar-nav ms-auto">
              <li class="nav-item dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Tài Khoản
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="loginDropdown"> 
                        <li><a class="dropdown-item" href="{{route('login')}}">Đăng Nhập</a></li>
                        <li><a class="dropdown-item" href="#">Đăng Ký</a></li>
                    </ul>
              </li>
          </ul>
      </div>
  </div>
</nav>