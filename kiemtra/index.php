
<?php include_once("header.php"); ?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5; 
    }
    .menu {
        list-style-type: none;
        padding: 0;
        margin: 0;
        background-color: #fff; 
        border-bottom: 1px solid #ccc; 
        display: flex;
        justify-content: flex-start;
        align-items: center;
        padding: 12px 24px;
    }
    .menu li {
        margin-right: 16px;
    }
    .menu li:last-child {
        margin-right: 0; 
    }
    .menu li a {
        text-decoration: none;
        color: #333; 
        font-weight: bold;
        transition: color 0.3s ease; 
    }
    .menu li a:hover {
        color: #007bff; 
    }
</style>

<ul class="menu">
    <li><a href="/kiemtra/kiemtra/employee_list.php">Danh sách nhân viên</a></li>
    <li><a href="/kiemtra/kiemtra/login.php">Đăng nhập</a></li>
</ul>

