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

    //hien thi user
    public function HienThiUser(){
        $user = new User();
        return $user->HienThiUser();
    }

    //them user
    public function ThemUser(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $user = new User();
            $user->tentk = $_POST['tentk'];
            $user->matkhau = $_POST['matkhau'];
            $user->hovaten = $_POST['hovaten'];
            $user->ngaysinh = $_POST['ngaysinh'];
            $user->gioitinh = $_POST['gioitinh'];
            $user->diachi = $_POST['diachi'];
            $user->cccd = $_POST['cccd'];
            $user->sdt = $_POST['sdt'];
            $user->email = $_POST['email'];
            $user->roles = $_POST['roles'];
            //anh
            $target = "views/viewUser/UserImg/";
            $anh = $target . basename($_FILES['anh']['name']);
            $user->anh = $anh;
            if(isset($_POST['submit'])){
                move_uploaded_file($_FILES['anh']['tmp_name'], $anh);
                $user->ThemUser();
                header('Location: index.php?action=QuanLyNguoiDung');
            }
        }
    }

    //xoa user
    public function XoaUser(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $user = new User();
            $user->id = intval($_POST['id']);
            $deleted = $user->XoaUser($user->id);
            if ($deleted) {
                echo "success";
            } else {
                echo "error";
            }
        }
    }

    //lay id user 
    public function getIdUser(){
        $user = new User();
        if(isset($_GET['id'])){
            $id = intval($_GET['id']);
            $data = $user->getIdUser($id);
            $data['anh'] = "http://localhost:8080/BNOStore/" . $data['anh'];
            if($data){
                echo json_encode(['success' => true, 'data' => $data]);
            }
            else{
                echo json_encode(['success' => false]);
            }
        }
    }

    //sua user
    public function SuaUser(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $user = new User();
            $user->id = intval($_POST['id']);
            $user->matkhau = $_POST['matkhau'];
            $user->hovaten = $_POST['hovaten'];
            $user->ngaysinh = $_POST['ngaysinh'];
            $user->gioitinh = $_POST['gioitinh'];
            $user->diachi = $_POST['diachi'];
            $user->cccd = $_POST['cccd'];
            $user->sdt = $_POST['sdt'];
            //anh
            $target = "./views/viewUser/UserImg/";
            $anh = $target . basename($_FILES['anh']['name']);
            //co thay doi anh
            if(!empty($_FILES['anh']['name'])){
                //tai anh len thanh cong
                if(move_uploaded_file($_FILES['anh']['tmp_name'], $anh)){
                    $user->anh = $anh;
                    $success = $user->SuaUserHaveImg($user->id);
                    header('Location: index.php?action=QuanLyNguoiDung');
                }
                //loi tai anh
                else{
                    echo json_encode(['success' => false , 'message' => 'Lỗi tải ảnh lên!']);
                    return;
                }
            }
            //khong thay doi anh
            else{
                $success = $user->SuaUserNoImg($user->id);
                header('Location: index.php?action=QuanLyNguoiDung');
            }
        }
    }

    //kh dang ky user
    public function dangky(){
        
    }

}