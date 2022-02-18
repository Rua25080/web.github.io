<?php
class login
{
    function connect()
    {
        $host = "localhost"; // luôn luôn là localhost
        $username = "tot"; // user của mysql
        $password = "123"; // Mysql password
        $database = "dbcdcntt20"; // tên database
        //$tbl_name="members"; // tên table
        // Create connection
        $conn = mysqli_connect($host, $username, $password, $database or die("không thể kết nối"));
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        echo "Connected successfully";
        mysqli_close($conn);
    }

    function mylogin($sql)
    {
        $link = mysqli_connect($host, $username, $password, $database or die("không thể kết nối"));
        $sql = "SELECT * FROM  tabledatabas";
        $result = mysqli_query($link, $sql);
        $i = mysqli_num_rows($result);
        //lấy dữ liệu ra
        if ($i == 1) {
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
                $username = $row['username'];
                $password = $row['password'];
                $phanquyen = $row['phanquyen'];
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['user'] = $username;
                $_SESSION['pass'] = $password;
                $_SESSION['phanquyen'] = $phanquyen;

                header('location:themsp.php');
            }
        } else {
            header('location:login.php');
        }
    }
    function confirmlogin($id, $user, $pass, $phanquyen)
    {
        $link = mysqli_connect($host, $username, $password, $database or die("không thể kết nối"));
        $sql = "SELECT id FROM taikhoan where id='$id' and username='$user' and password='$pass' and phanquyen='$phanquyen'";
        $ketqua = mysqli_query($sql, $link);
        $i = mysqli_num_rows($ketqua);
        if ($i != 1) {
            header('location:login.php');
        }
    }
}
