<!DOCTYPE html>
<html lang="vi">
<head>
    @include('user.layouts.partials.head')
</head>
<body>
    @include('user.layouts.partials.navbar')

    @yield('content')   
    <!-- Modal Đăng Nhập -->
    <!-- Button Kích Hoạt Modal -->
    @include('user.layouts.partials.footer')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
        const loginDropdown = document.querySelector(".navbar-nav .dropdown-toggle");

        navLinks.forEach(link => {
            link.addEventListener("click", function () {
                // Xóa class active ở tất cả menu (trừ dropdown)
                navLinks.forEach(nav => {
                    if (!nav.closest(".dropdown")) {
                        nav.classList.remove("active");
                    }
                });
                // Thêm class active vào mục đã click
                this.classList.add("active");
            });
        });

        // Xử lý khi dropdown mở và đóng
        loginDropdown.addEventListener("click", function () {
            this.classList.add("active");
        });

        document.addEventListener("click", function (event) {
            if (!loginDropdown.parentElement.contains(event.target)) {
                loginDropdown.classList.remove("active");
            }
        });
    });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>