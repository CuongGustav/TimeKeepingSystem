<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Hệ Thống Chấm Công</title>
    <link rel="stylesheet" href="\IOT_WEB\public\css\style_homePage.css">
</head>
<body>
    <!-- Menu ngang -->
    <aside class="sidebar">
        <h2>Chấm Công</h2>
        <ul>
            <li><a href="{{ route('homePage') }}">Trang Chủ</a></li>
            <li><a href="{{ route('staffPage') }}">Quản Lý Nhân Viên</a></li>
            <li><a href="{{ route('cameraPage') }}">Camera</a></li>
            <li><a href="{{ route('reportPage') }}">Báo Cáo</a></li>
        </ul>
    </aside>

    <!-- Nội dung chính -->
    <main class="content">
        <!-- Phần tiêu đề -->
        <section class="hero">
            <h1>Chào Mừng Đến Với Hệ Thống Chấm Công</h1>
            <p>Quản lý nhân viên, theo dõi chấm công và tạo báo cáo nhanh chóng, dễ dàng.</p>
            <a href="{{ route('cameraPage') }}" class="cta-button">Bắt đầu ngay</a>
        </section>

        <!-- Phần thông tin nổi bật -->
        <section class="features">
            <div class="feature">
                <h3>Quản lý nhân viên</h3>
                <p>Theo dõi danh sách nhân viên, giờ làm việc và hiệu suất chấm công.</p>
            </div>
            <div class="feature">
                <h3>Giám sát thời gian thực</h3>
                <p>Nhận diện qua camera với độ chính xác cao và xử lý nhanh.</p>
            </div>
            <div class="feature">
                <h3>Báo cáo chi tiết</h3>
                <p>Xuất báo cáo theo ngày, tuần, tháng chỉ với vài cú click.</p>
            </div>
        </section>
    </main>
</body>
</html>
