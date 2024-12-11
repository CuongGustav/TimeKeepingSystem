<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Báo Cáo</title>
    <link rel="stylesheet" href="/IOT_WEB/public/css/style_reportPage.css">
    
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

    <main class="report-container">
        <section class="date-filter">
            <h2>Chọn Ngày Báo Cáo</h2>
            {!! Form::open(['url' => '/admin/staffpage/detailtimesheet/submit/'.$msnv, 'method' => 'POST']) !!}
            <div class="calendar-container">
                <label for="report-date">Ngày:</label>
                <input type="date" id="report-date" name='report-date'>
                <input type="submit" value="Xem Báo Cáo" id="filter-btn" class="edit-btn">
            </div>
            {!! Form::close() !!}
        </section>

        <section class="report-summary">
            <h2>Tóm Tắt Báo Cáo</h2>
            <div class="summary-cards">
                <div class="card">
                    <h3>Số ngày đi làm trong tháng</h3>
                    <p>{{$count}}/{{$daysInMonth}}</p>
                </div>
                <div class="card">
                    <h3>Vắng Mặt</h3>
                    <p>{{$deserted}}</p>
                </div>
                
            </div>
        </section>

        <!-- Bảng chi tiết -->
        <section class="report-table">
            <h2>Chi Tiết Chấm Công Của {{$formattedDate1}}</h2>
            <table>
                <thead>
                    <tr>
                        <th>MSNV</th>
                        <th>Tên Nhân Viên</th>
                        <th>Thời Gian</th>
                        <th>Ngày</th>
                        <th>Ảnh</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($timesheets as $timesheet)
                    <tr>
                        <td>{{$timesheet->MSNV}}</td>
                        <td>{{$timesheet->Name}}</td>
                        <td>{{$timesheet->Time}}</td>
                        <td>{{$timesheet->Date}}</td>
                        <td>
                            <img src="{{ url($timesheet->Image) }}" alt="" style="height: 100px; width: 150px">
                        </td>
                    </tr>
                    @endforeach
                    
                    
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
