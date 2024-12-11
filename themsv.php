<?php
include 'btapgki.php';

if (isset($_POST['save'])) {
    $fullname = $_POST['fullname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $hometown = $_POST['hometown'];
    $level = $_POST['level'];
    $group_id = $_POST['group_id'];

    $sql = "INSERT INTO table_Students (fullname, dob, gender, hometown, level, group_id) 
            VALUES ('$fullname', '$dob', '$gender', '$hometown', '$level', '$group_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm sinh viên thành công";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên mới</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f2f5;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 450px;
        }
        .form-container h1 {
            margin-bottom: 25px;
            font-size: 26px;
            color: #333;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group input[type="number"],
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-group input[type="radio"] {
            margin-right: 10px;
        }
        .form-group .radio-group {
            display: flex;
            justify-content: space-between;
        }
        .form-group .radio-group label {
            display: flex;
            align-items: center;
        }
        .form-group .radio-group label input {
            margin-right: 5px;
        }
        .form-group button {
            width: 100%;
            padding: 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Thêm sinh viên mới</h1>
        <form method="post" action="themsv.php">
            <div class="form-group">
                <label>Họ và tên:</label>
                <input type="text" name="fullname" required>
            </div>
            <div class="form-group">
                <label>Ngày sinh:</label>
                <input type="date" name="dob" required>
            </div>
            <div class="form-group">
                <label>Giới tính:</label>
                <div class="radio-group">
                    <label><input type="radio" name="gender" value="0" required> Nữ</label>
                    <label><input type="radio" name="gender" value="1"> Nam</label>
                </div>
            </div>
            <div class="form-group">
                <label>Quê quán:</label>
                <input type="text" name="hometown" required>
            </div>
            <div class="form-group">
                <label>Trình độ học vấn:</label>
                <select name="level" required>
                    <option value="0">Tiến sĩ</option>
                    <option value="1">Thạc sĩ</option>
                    <option value="2">Kỹ sư</option>
                    <option value="3">Khác</option>
                </select>
            </div>
            <div class="form-group">
                <label>Nhóm:</label>
                <input type="number" name="group_id" required>
            </div>
            <div class="form-group">
                <button type="submit" name="save">Lưu</button>
            </div>
        </form>
    </div>
</body>
</html>
