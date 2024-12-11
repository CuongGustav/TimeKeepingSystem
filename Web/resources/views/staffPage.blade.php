<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Nhân Viên</title>
    <link rel="stylesheet" href="\IOT_WEB\public\css\style_staffPage.css">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
                            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    <script>
        setTimeout(function() {
            document.getElementById('status').style.display = 'none';
        }, 3000);
    </script>
   


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
    
    <div>
        @if(session('status'))
        <div class="alert alert-success" id="status" style="width: 100%; height: 60px;">
            {{session('status')}}
        </div>
    @endif
    </div>
    

    <!-- Nội dung chính -->
    <main class="employee-container">
        <section class="employee-header">
            <h2>Danh Sách Nhân Viên</h2>
            {!! Form::open(['url' => '/admin/staffpage/staff', 'method' =>'POST']) !!}
                <div>
                    <input type="text" id="searchInput" name="searchInput" style="width: 250px; height:35px; font-size: 25px; border-radius: 10px;">
                    <input type="submit" value="Search"  class="add-employee-btn">
                </div>
            {!! Form::close() !!}
            <a href="{{ route('addStaff') }}" class="add-employee-btn" style="text-decoration: none;">Thêm Nhân Viên</a>
           
        </section>

        <!-- Bảng danh sách nhân viên -->
        <section class="employee-table">
            <table>
                <thead>
                    <tr>
                        <th>Mã Nhân Viên</th>
                        <th>Tên Nhân Viên</th>
                        <th>Chức Vụ</th>
                        <th>Ảnh</th>
                        {{-- <th>Ảnh</th> --}}
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staffs as $staff )
                    <tr>
                        <td>{{$staff->MSNV}}</td>
                        <td>{{$staff->Name}}</td>
                        <td>{{$staff->Duty}}</td>
                        <td style="display: flex; justify-content: center; align-items: center; width: 150px; height: 100px; border: 1px solid red; overflow: hidden;">
                            <img src="{{ url($staff->Image) }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                        </td>
                        
                        
                        <td>
                            <a href="{{ route('editPage', ['MSNV' => $staff->MSNV]) }}" class="edit-btn" style="text-decoration: none;">Sửa</a>
                            <a href="{{ route('deleteStaff', ['MSNV' => $staff->MSNV]) }}" class="delete-btn" style="text-decoration: none;">Xóa</a>
                            <a href="{{ route('detailTimeSheet', ['MSNV' => $staff->MSNV]) }}" class="edit-btn" style="text-decoration: none;">Xem</a>
                            
                        </td>
                    </tr>
                   
                    @endforeach
                
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
