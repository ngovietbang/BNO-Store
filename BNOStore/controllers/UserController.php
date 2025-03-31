<?php
require_once('./models/class/User.php');

class UserController{
    //login
    public function Login(){
        session_start();
        $users = new User();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $users->tentk = $_POST['tentk'];
            $users->matkhau = $_POST['matkhau'];
            $row = $users->Login($users->tentk, $users->matkhau);
            //
            if(isset($_POST['submit'])){
                //sai tên tk hoặc mật khẩu
                if(empty($row)){
                    header('location:index.php');
                    exit();
                    echo "<script>alert('Sai tài khoản hoặc mật khẩu');</script>";
                }
                //đăng nhập thành công
                else{
                    //
                    foreach($row as $user){
                        //nếu là khách hàng
                        if($user['roles'] == 'User'){
                            $_SESSION['username'] = $user['hovaten'];
                            $_SESSION['role'] = $user['roles'];
                            // Lưu cookie để nhớ đăng nhập
                            setcookie("username", $user['hovaten'], time() + (86400 * 30), "/"); // Lưu 30 ngày
                            setcookie("role", $user['roles'], time() + (86400 * 30), "/"); 
                            header('Location: index.php');
                            exit();
                        }
                        //nếu là admin
                        else if($user['roles'] == 'Admin'){
                            $_SESSION['username'] = $user['hovaten'];
                            $_SESSION['role'] = $user['roles'];
                            // Lưu cookie để nhớ đăng nhập
                            setcookie("username", $user['hovaten'], time() + (86400 * 10), "/"); // Lưu 30 ngày
                            setcookie("role", $user['roles'], time() + (86400 * 10), "/"); 
                            header('Location: index.php?action=Admin');
                            exit();
                        }
                        //nếu là shipper
                        else if ($user['roles'] == 'Shipper') {
                            $_SESSION['username'] = $user['hovaten'];
                            $_SESSION['role'] = $user['roles'];
                            // Lưu cookie để nhớ đăng nhập
                            setcookie("username", $user['hovaten'], time() + (86400 * 10), "/"); // Lưu 30 ngày
                            setcookie("role", $user['roles'], time() + (86400 * 10), "/");
                            header('Location: index.php?action=QuanLyLoaisp');
                            exit();
                        }
                    }
                }
            }
        }
    }

    //logout
    public function Logout(){
        session_start();
        session_unset(); // Xóa tất cả biến session
        session_destroy();
        // Xóa session trên trình duyệt (cookie session)
        setcookie(session_name(), '', time() - 3600, '/');

        header("Location: index.php");
        exit();
    }


}