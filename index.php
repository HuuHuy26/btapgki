<?php
include 'btapgki.php';

$sql = "SELECT * FROM table_students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Danh sách sinh viên</title>
    <style>
    body { /*body: Thiết lập font chữ cho toàn bộ trang.*/
    font-family: 'Times New Roman', Times, serif; 
} 

    h1{
        text-align: center;
        border: 3px solid palegoldenrod;
        width: 100%;
        margin :auto;
        padding : auto;
    }
table { /*Thiết lập chiều rộng bảng, loại bỏ khoảng trống (border-collapse),
     và thêm khoảng trống giữa bảng và nội dung xung quanh (margin).*/
    width: 100%;  
    margin: 20px 0; 
    border: 2px solid black;
    font-size: 18px; 
    text-align: left;
 }
th, td { /*Thêm padding, đường viền và căn lề cho các ô bảng.*/
    padding: 12px; 
    border: 3px solid #040404; 
} 
th { /*Thiết lập màu nền cho các tiêu đề bảng.*/
    background-color: #ffffff; 
} 
 tr:hover { /*hêm màu nền khi di chuột qua các hàng để tạo hiệu ứng trực quan*/
    background-color: #ffffff; 
} 

 .edit-btn, .delete-btn { /*Tạo kiểu cho các nút sửa và xóa, bao gồm padding, màu chữ, màu nền, bo tròn góc, và kích thước font chữ.*/
    padding: 8px 12px;
     color: #fff; 
     border:none; 
     border-radius: 5px; 
     text-decoration: none; 
     font-size: 16px; 
     cursor: pointer; 
    } 
     
    .edit-btn { /**/
        background-color: #4CAF50; 
    } 
    .delete-btn { /**/
        background-color: #f44336; 
    } 
    .edit-btn:hover, .delete-btn:hover /*Thay đổi độ mờ khi di chuột qua các nút để tạo hiệu ứng phản hồi người dùng*/
    { 
        opacity: 0.8; 
    }

        .siu{
            
   padding: 8px 12px;
   background-color: aqua;
     border:1px solid; 
     border-radius: 5px; 
     text-decoration: none; 
     font-size: 16px; 
     cursor: pointer; 
}
.siu:hover/*Thay đổi độ mờ khi di chuột qua các nút để tạo hiệu ứng phản hồi người dùng*/
    { 
        opacity: 0.8; 
    }
    .search-container button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .search-container input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
</style>
</head>
<body>
    <h1>Danh sách sinh viên</h1>
    <div class="search-container">
        <form method="get" action="index.php">
            <input type="text" name="search" placeholder="Tìm kiếm sinh viên...">
            <button type="submit">Tìm kiếm</button>
        </form>
    </div>
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
            $search = isset($_GET['search']) ? $_GET['search'] : '';

            if ($search) {
                $sql = "SELECT * FROM table_Students WHERE fullname LIKE '%$search%'";
            } else {
                $sql = "SELECT * FROM table_Students";
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['fullname']}</td>
                            <td>{$row['dob']}</td>
                            <td>" . ($row['gender'] == 0 ? "Nữ" : "Nam") . "</td>
                            <td>{$row['hometown']}</td>
                            <td>" . ["Tiến sĩ", "Thạc sĩ", "Kỹ sư", "Khác"][$row['level']] . "</td>
                            <td>Nhóm {$row['group_id']}</td>
                            <td><a href='suatt.php?id={$row['id']}' class = 'edit-btn'>Sửa</a></td>
                            <td><a href='xoa.php?id={$row['id']}' class = 'delete-btn'>Xóa</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Không có sinh viên nào</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="themsv.php" class = "siu">Thêm sinh viên</a>
</body>
</html>

<?php
$conn->close();
?>
