<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Form</title>
    <style>
        body, h1, h3, p, ul, li, table, input, button {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Toàn bộ */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    color: #333;
}

/* Menu ngang */
.sidebar {
    background-color: #3a3f58;
    color: #fff;
    width: 100%;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
    display: flex;
    align-items: center;
    padding: 10px 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.sidebar h2 {
    margin-right: 30px;
    font-size: 20px;
    font-weight: bold;
}

.sidebar ul {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
}

.sidebar ul li {
    margin-right: 20px;
}

.sidebar ul li a {
    color: #fff;
    text-decoration: none;
    padding: 8px 15px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.sidebar ul li a:hover {
    background-color: #50597b;
}

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-row {
            display: flex;
            justify-content: space-between;
        }
        .form-group {
            margin-bottom: 15px;
            width: 48%;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="file"] {
            padding: 3px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group button:hover {
            background-color: #45a049;
        }
    </style>
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
    <div class="form-container">
        <h1>Employee Form</h1>
        {!! Form::open(['url' => '/admin/staffpage/addstaff/submit', 'method' => 'POST', 'files' => true]) !!}
            <div class="form-row">
                <div class="form-group">
                    <label for="msnv">MSNV</label>
                    <input type="text" id="MSVN" name="MSNV" required>
                </div>
                <div class="form-group">
                    <label for="Name">Name</label>
                    <input type="text" id="Name" name="Name" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="Address">Address</label>
                    <input type="text" id="Address" name="Address" required>
                </div>
                <div class="form-group">
                    <label for="CCCD">CCCD</label>
                    <input type="text" id="CCCD" name="CCCD" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="Phone">Phone</label>
                    <input type="tel" id="Phone" name="Phone" required>
                </div>
                <div class="form-group">
                    <label for="Gender">Gender</label>
                    <select id="Gender" name="Gender">
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="Duty">Duty</label>
                    <input type="text" id="Duty" name="Duty" required>
                </div>
                <div class="form-group">
                    <label for="Image">Image</label>
                    <input type="file" id="Image" name="Image" accept="image/*">
                </div>
            </div>
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        {!! Form::close() !!}
    </div>
</body>
</html>