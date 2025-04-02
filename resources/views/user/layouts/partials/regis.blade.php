<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background: #ffffff;
        }
        .card-header {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            background: #f8f9fa;
            color: #000;
        }
        .btn-primary {
            background: #764ba2;
            border: none;
        }
        .btn-primary:hover {
            background: #5a3b89;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Đăng Ký Tài Khoản</h4>
                    </div>
                    <div class="card-body p-4">
                        <form>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Họ và Tên</label>
                                <input type="text" class="form-control" id="fullName" placeholder="Nhập họ và tên">
                            </div>
                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Số Điện Thoại</label>
                                <input type="text" class="form-control" id="phoneNumber" placeholder="Nhập số điện thoại">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Nhập email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mật Khẩu</label>
                                <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Xác Nhận Mật Khẩu</label>
                                <input type="password" class="form-control" id="confirmPassword" placeholder="Nhập lại mật khẩu">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Đăng Ký</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
