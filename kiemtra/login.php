<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5; /* Màu nền trang */
            display: flex;
            justify-content: center; /* Căn giữa theo chiều ngang */
            align-items: center; /* Căn giữa theo chiều dọc */
            height: 100vh; /* Chiều cao là 100% của viewport */
        }
        form {
            background-color: #fff; /* Màu nền của form */
            padding: 20px;
            border-radius: 8px; /* Đường cong viền */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Đổ bóng */
            width: 300px;
        }
        h1 {
            text-align: center;
            color: #007bff; /* Màu chữ */
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin: 6px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff; /* Màu nền nút submit */
            color: white; /* Màu chữ nút submit */
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3; /* Màu nền nút submit khi hover */
        }
    </style>
</head>
<body>
    <form method="POST" action="login.php">
        <h1>Đăng nhập</h1>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $connection = mysqli_connect('localhost', 'root', '', 'ql_nhansu');
            if (!$connection) {
                die("Kết nối cơ sở dữ liệu thất bại: " . mysqli_connect_error());
            }
            $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die("Lỗi truy vấn: " . mysqli_error($connection));
            }
            if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
                session_start();
                $_SESSION['user_id'] = $user['Id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                mysqli_close($connection);
                header('Location: employee_list.php');
                exit();
            } else {
                echo "<p style='color: red; text-align: center;'>Sai tên đăng nhập hoặc mật khẩu. Vui lòng thử lại.</p>";
            }
            mysqli_close($connection);
        }
        ?>
        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Đăng nhập">
    </form>
</body>
</html>
