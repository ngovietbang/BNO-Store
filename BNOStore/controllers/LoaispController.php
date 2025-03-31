<?php
require_once('./models/class/Loaisanpham.php');

class LoaispController{

   //hien thi loaisp
    public function ShowLoaisp(){
        $loaisp = new Loaisanpham();
        return $loaisp->ShowLoaisp();
    }

    //xoa loai sp
    public function DeleteLoaisp(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $loaisp = new Loaisanpham();
            $loaisp->idloaisp = $_POST['idLoaisp'];
            $deleted = $loaisp->DeleteLoaisp($loaisp->idloaisp);
            if($deleted){
                echo "success";
            }
            else{
                echo "error";
            }
        }
    }

    //them loaisp
    public function ThemLoaisp(){
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $loaisp = new Loaisanpham();
            $loaisp->loaisp = $_POST['loaisp'];
            //anh
            $target = "views/viewLoaisp/LoaispImg/";
            $anh = $target . basename($_FILES['anh']['name']);
            $loaisp->anh = $anh;
            $loaisp->ghichu = $_POST['ghichu'];
            if(isset($_POST['submit'])){
                move_uploaded_file($_FILES['anh']['tmp_name'], $anh);
                $loaisp->ThemLoaisp();
                header('Location: index.php?action=QuanLyLoaisp');
                exit();
            }
        }
    }

    //lay id loai sp
    public function getIdLoaisp(){
         $loaisp = new Loaisanpham();
        if (isset($_GET['idloaisp'])) {
            $id = intval($_GET['idloaisp']);
            $data = $loaisp->getIdLoaisp($id);
            //
            $data['anh'] = "http://localhost:8080/BNOStore/" . $data['anh'];
            //
            if ($data) {
                echo json_encode(["success" => true, "data" => $data]);
            } else {
                echo json_encode(["success" => false]);
            }
        }
    }

    //sua loai sp
    public function UpdateLoaisp(){
        //ajax sua
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $loaisp = new Loaisanpham();
            $idLoaisp = intval($_POST['idloaisp']);
            $loaisp->loaisp = $_POST['loaisp'];
            $loaisp->ghichu = $_POST['ghichu'];
            //anh
            $target = "views/viewLoaisp/LoaispImg/";
            $anh = $target . basename($_FILES['anh']['name']);
            $loaisp->anh = $anh;
            // Xử lý ảnh
            if (!empty($_FILES['anh']['name'])) {           
                // Kiểm tra và lưu file ảnh
                if (move_uploaded_file($_FILES['anh']['tmp_name'], $anh)) {   
                    // Cập nhật ảnh vào database
                    $success = $loaisp->UpdateLoaispHaveImg($idLoaisp);
                    session_start();
                    $_SESSION['show_loaisp'] = true;
                    header('Location: index.php?action=QuanLyLoaisp');
                } else {
                    echo json_encode(["success" => false, "message" => "Lỗi tải ảnh lên!"]);
                    return;
                }
            } else {
                // Nếu không chọn ảnh mới, chỉ cập nhật dữ liệu khác
                $success = $loaisp->UpdateLoaispNoImg($idLoaisp);
                header('Location: index.php?action=QuanLyLoaisp');
            }
        }
    }
}