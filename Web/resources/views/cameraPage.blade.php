<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Camera - Hệ Thống Chấm Công</title>
        <link rel="stylesheet" href="\IOT_WEB\public\css\style_cameraPage.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <aside class="sidebar">
            <h2>Chấm Công</h2>
            <ul>
                <li><a href="{{ route('homePage') }}">Trang Chủ</a></li>
                <li><a href="{{ route('staffPage') }}">Quản Lý Nhân Viên</a></li>
                <li><a href="{{ route('cameraPage') }}">Camera</a></li>
                <li><a href="{{ route('reportPage') }}">Báo Cáo</a></li>
            </ul>
        </aside>

        <main class="camera-container">
            <section class="camera-view">
                <h2>Hiển Thị Camera</h2>
                <img id="camera-image" src="" alt="" style="width: 150px; height: 150px;">
                <ul class="recognized-list1">
                </ul>
            </section>

            <section class="camera-list">
                <h2>Danh Sách Nhận Diện</h2>
                <ul class="recognized-list">
                </ul>
            </section>
        </main>
        <script>
        $(document).ready(function() {
            function fetchData() {
                $.ajax({
                    url: '/IOT_WEB/admin/dataserver',
                    method: 'GET',
                    success: function(response) {
                        console.log('Response from server:', response);
                        
                        if (response.status === 'success' && Array.isArray(response.timesheets)) {
                            $('.recognized-list').empty();
                            response.timesheets.forEach(function(item) {
                                $('.recognized-list').append('<li>' + item.Name + ' - ' + item.Time + ' - ' + item.Date + '</li>');
                            });
                            const lastItem = response.timesheets[response.timesheets.length - 1];
                            const imagePath = '/IOT_WEB/' + lastItem.Image;
                            console.log('Đường dẫn hình ảnh:', imagePath);
                            $('#camera-image').attr('src', imagePath); 
                            $('.recognized-list1').text( lastItem.Name + '  -  ' + lastItem.Time + '  -  ' + lastItem.Date );
                        } else {
                            console.error('Không thể tải dữ liệu hoặc dữ liệu không đúng định dạng.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Lỗi: ', error);
                        alert('Có lỗi xảy ra khi tải dữ liệu!');
                    }
                });
            }

            setInterval(fetchData, 5000);
            fetchData();
        });
        </script> 
    </body>
</html>
