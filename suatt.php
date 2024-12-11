<?php
include 'btapgki.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM table_Students WHERE id=$id";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy sinh viên với ID này.";
        exit();
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $hometown = $_POST['hometown'];
    $level = $_POST['level'];
    $group_id = $_POST['group_id'];

    // Sử dụng câu lệnh chuẩn bị để tránh lỗi SQL injection và các lỗi cú pháp
    $stmt = $conn->prepare("UPDATE table_Students SET fullname=?, dob=?, gender=?, hometown=?, level=?, group_id=? WHERE id=?");
    $stmt->bind_param("ssisiis", $fullname, $dob, $gender, $hometown, $level, $group_id, $id);

    if ($stmt->execute()) {
        echo "Cập nhật sinh viên thành công";
    } else {
        echo "Lỗi: ".$sql  . $conn->error;
    }

   
    $conn->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Sửa thông tin sinh viên</title>
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
        .box {
            border: 2px solid #007bff;
            padding: 20px;
            border-radius: 10px;
            background-color: #e6f7ff;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Sửa thông tin sinh viên</h1>
        <div class="box">
            <form method="post" action="suatt.php">
                <input type="hidden" name="id" value="<?php echo isset($student['id']) ? $student['id'] : ''; ?>">
                <div class="form-group">
                    <label>Họ và tên:</label>
                    <input type="text" name="fullname" value="<?php echo isset($student['fullname']) ? $student['fullname'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Ngày sinh:</label>
                    <input type="date" name="dob" value="<?php echo isset($student['dob']) ? $student['dob'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Giới tính:</label>
                    <div class="radio-group">
                        <label><input type="radio" name="gender" value="0" <?php echo isset($student['gender']) && $student['gender'] == 0 ? 'checked' : ''; ?> required> Nữ</label>
                        <label><input type="radio" name="gender" value="1" <?php echo isset($student['gender']) && $student['gender'] == 1 ? 'checked' : ''; ?>> Nam</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Quê quán:</label>
                    <input type="text" name="hometown" value="<?php echo isset($student['hometown']) ? $student['hometown'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <label>Trình độ học vấn:</label>
                    <select name="level" required>
                        <option value="0" <?php echo isset($student['level']) && $student['level'] == 0 ? 'selected' : ''; ?>>Tiến sĩ</option>
                        <option value="1" <?php echo isset($student['level']) && $student['level'] == 1 ? 'selected' : ''; ?>>Thạc sĩ</option>
                        <option value="2" <?php echo isset($student['level']) && $student['level'] == 2 ? 'selected' : ''; ?>>Kỹ sư</option>
                        <option value="3" <?php echo isset($student['level']) && $student['level'] == 3 ? 'selected' : ''; ?>>Khác</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nhóm:</label>
                    <input type="number" name="group_id" value="<?php echo isset($student['group_id']) ? $student['group_id'] : ''; ?>" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="update">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

