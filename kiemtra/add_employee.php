
<?php

$connection = mysqli_connect('localhost', 'root', '', 'ql_nhansu');


if (!$connection) {
    die("Kết nối cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}


$query = "SELECT Ma_Phong, Ten_Phong FROM PHONGBAN";
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) > 0) {
    $phongBanOptions = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $maPhong = $row['Ma_Phong'];
        $tenPhong = $row['Ten_Phong'];
        $phongBanOptions .= "<option value='$maPhong'>$tenPhong</option>";
    }
} else {
    echo "Không có dữ liệu phòng ban.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $maNV = $_POST['maNV'];
    $tenNV = $_POST['tenNV'];
    $phai = $_POST['phai'];
    $noiSinh = $_POST['noiSinh'];
    $maPhong = $_POST['maPhong'];
    $luong = $_POST['luong'];
    $query = "INSERT INTO NHANVIEN (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES ('$maNV', '$tenNV', '$phai', '$noiSinh', '$maPhong', '$luong')";
    $result = mysqli_query($connection, $query);

    if ($result) {
        header("Location: employee_list.php");
        exit();
    } else {
        echo "Lỗi: " . mysqli_error($connection);
    }
}
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thêm nhân viên</title>
    <style>
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ff7f0e;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #fff;
            text-align: center;
        }
        label {
            color: #fff;
        }
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #fff;
            color: #ff7f0e;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #ffaf4a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thêm nhân viên</h1>
        <form method="POST" action="add_employee.php">
            <label for="maNV">Mã nhân viên:</label>
            <input type="text" id="maNV" name="maNV" required><br>

            <label for="tenNV">Tên nhân viên:</label>
            <input type="text" id="tenNV" name="tenNV" required><br>

            <label for="phai">Phái:</label>
            <select id="phai" name="phai">
                <option value="NU">Nữ</option>
                <option value="NAM">Nam</option>
            </select><br>

            <label for="noiSinh">Nơi sinh:</label>
            <input type="text" id="noiSinh" name="noiSinh" required><br>

            <label for="maPhong">Tên Phòng:</label>
            <select id="maPhong" name="maPhong">
                <?php echo $phongBanOptions; ?>
            </select><br>
            
            <label for="luong">Lương:</label>
            <input type="text" id="luong" name="luong" required><br>

            <input type="submit" value="Thêm">
        </form>
    </div>
</body>
</html>
