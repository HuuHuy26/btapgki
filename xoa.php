<?php
include 'btapgki.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Sử dụng câu lệnh chuẩn bị để tránh lỗi SQL injection và các lỗi cú pháp
    $stmt = $conn->prepare("DELETE FROM table_Students WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "Xóa sinh viên thành công";
    } else {
        echo "Lỗi: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Danh sách sinh viên</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }
        h1 {
            text-align: center;
            border: 3px solid palegoldenrod;
            width: 100%;
            margin: auto;
            padding: auto;
        }
        table {
            width: 100%;
            margin: 20px 0;
            border: 2px solid black;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            padding: 12px;
            border: 3px solid #040404;
        }
        th {
            background-color: #ffffff;
        }
        tr:hover {
            background-color: #ffffff;
        }
        .edit-btn, .delete-btn {
            padding: 8px 12px;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
        }
        .edit-btn {
            background-color: #4CAF50;
        }
        .delete-btn {
            background-color: #f44336;
        }
        .edit-btn:hover, .delete-btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <h1>Danh sách sinh viên</h1>
    <table>
        <thead>
            <tr>
                <th>Thứ tự</th>
                <th>Họ và tên</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th>Quê quán</th>
                <th>Trình độ học vấn</th>
                <th>Nhóm</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'btapgki.php';
            $sql = "SELECT * FROM table_Students";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['fullname']}</td>
                            <td>{$row['dob']}</td>
                            <td>" . ($row['gender'] == 0 ? 'Nữ' : 'Nam') . "</td>
                            <td>{$row['hometown']}</td>
                            <td>" . ['Tiến sĩ', 'Thạc sĩ', 'Kỹ sư', 'Khác'][$row['level']] . "</td>
                            <td>Nhóm {$row['group_id']}</td>
                            <td><a href='suatt.php?id={$row['id']}' class='edit-btn'>Sửa</a></td>
                            <td><a href='delete.php?id={$row['id']}' class='delete-btn'>Xóa</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Không có sinh viên nào</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
    <a href="themsv.php">Thêm sinh viên</a>
</body>
</html>

