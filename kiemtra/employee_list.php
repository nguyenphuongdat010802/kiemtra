<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>NHANVIEN</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; 
            color: #333; 
            margin: 0;
            padding: 0;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #3498db; 
            color: rebeccapurple; 
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #ff8c00; 
        }
        td {
            background-color: #3498db; 
        }
        .thumbnail {
            width: 50px;
        }
        .action-links a {
            color: #3498db; 
            text-decoration: none; 
            margin-right: 8px;
        }
        .action-links a:hover {
            text-decoration: underline; 
        }
    </style>
</head>
<body>
    <?php
    session_start();
    $role = $_SESSION['role'];

    if ($role === 'admin') {
        echo '<a href="add_employee.php"><button style="background-color: #3498db; color: #fff; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">Thêm nhân viên</button></a>';
    }
    ?>
    <h1 style="color: #3498db;">Danh sách nhân viên</h1>
    <?php
    $connection = mysqli_connect('localhost', 'root', '', 'ql_nhansu');
    if (!$connection) {
        die("Kết nối cơ sở dữ liệu thất bại: " . mysqli_connect_error());
    }
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 5;
    $start = ($page - 1) * $limit;
    $query = "SELECT Ma_NV, TEN_NV, Phai, Noi_Sinh, Ma_Phong, Luong FROM NHANVIEN LIMIT $start, $limit";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("Lỗi truy vấn: " . mysqli_error($connection));
    }
    ?>
    <div id="data-container">
        <table>
            <tr>
                <th>Mã Nhân Viên</th>
                <th>Tên Nhân Viên</th>
                <th>Phái</th>
                <th>Nơi Sinh</th>
                <th>Mã Phòng</th>
                <th>Lương</th>
                <th>ACTION</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['Ma_NV'] . "</td>";
                echo "<td>" . $row['TEN_NV'] . "</td>";
                echo "<td><img class='thumbnail' src='http://localhost:81/kiemtra/images/" . ($row['Phai'] == 'NU' ? 'bbjpg.jpg' : 'aa.jpg') . "' alt='Hình ảnh' height='70px'  ></td>";
                echo "<td>" . $row['Noi_Sinh'] . "</td>";
                echo "<td>" . $row['Ma_Phong'] . "</td>";
                echo "<td>" . $row['Luong'] . "</td>";
                if ($role === 'admin') {
                    echo "<td><a href='edit_employee.php?id=" . $row['Ma_NV'] . "' style='color: #3498db; text-decoration: none;'>Sửa</a> | <a href='delete_employee.php?id=" . $row['Ma_NV'] . "' style='color: #3498db; text-decoration: none;'>Xóa</a></td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <?php
    $totalQuery = "SELECT COUNT(*) AS total FROM NHANVIEN";
    $totalResult = mysqli_query($connection, $totalQuery);
    $totalRow = mysqli_fetch_assoc($totalResult);
    $totalEmployees = $totalRow['total'];
    $totalPages = ceil($totalEmployees / $limit);
    echo "<div>";
    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<a href='?page=$i' style='color: #3498db; text-decoration: none;'>" . $i . "</a> ";
    }
    echo "</div>";
    ?>
</body>
</html>


<?php
mysqli_close($connection);
?>