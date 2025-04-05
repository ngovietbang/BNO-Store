<?php
require_once('./models/class/TheLoai.php');
class TheLoaiController{
    //hien thi the loai
    public function ShowTheLoai(){
        $theloai = new Theloai();
        return $theloai->ShowTheLoai();
    }

    //xoa the loai
    public function XoaTheLoai(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $theloai = new Theloai();
            $theloai->idtheloai = $_POST['idTheloai'];
            $deleted = $theloai->XoaTheLoai($theloai->idtheloai);
            if ($deleted) {
                echo "success";
            } else {
                echo "error";
            }
        }
    }

    //them the loai
    public function ThemTheLoai(){
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $theloai = new Theloai();
            $theloai->loaisp = $_POST['loaisp'];
            $theloai->tentheloai = $_POST['tentheloai'];
            //anh
            $target = "views/viewTheLoai/TheLoaiImg/";
            $anh = $target . basename($_FILES['anh']['name']);
            $theloai->anh = $anh;
            $theloai->ghichu = $_POST['ghichu'];
            //
            if (isset($_POST['submit'])) {
                move_uploaded_file($_FILES['anh']['tmp_name'], $anh);
                $theloai->ThemTheLoai();
                header('Location: index.php?action=QuanLyTheLoai');
                exit();
            }
        }
    }

    //lay id the loai
    public function getIdTheLoai(){
        $theloai = new Theloai();
        if(isset($_GET['idTheloai'])){
            $id = intval($_GET['idTheloai']);
            $data = $theloai->getIdTheLoai($id);
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

    //sua the loai
    public function SuaTheLoai(){
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $theloai = new Theloai();
            $idTheloai = intval($_POST['idTheloai']);
            $theloai->tentheloai = $_POST['tentheloai'];
            $theloai->ghichu = $_POST['ghichu'];
            //anh 
            $target = "views/viewTheLoai/TheLoaiImg/";
            $anh = $target . basename($_FILES['anh']['name']);
            //cap nhat co anh
            if(!empty($_FILES['anh']['name'])){
                if(move_uploaded_file($_FILES['anh']['tmp_name'], $anh)){
                    $theloai->anh = $anh;
                    $success = $theloai->SuaTheLoaiHaveImg($idTheloai);
                    header('Location: index.php?action=QuanLyTheLoai');    
                }
                else{
                    echo json_encode(["success" => false, "message" => "Lỗi tải ảnh lên!"]);
                    return;
                }
            }
            //cap nhat khong anh
            else{
                $success = $theloai->SuaTheLoaiNoImg($idTheloai);
                header('Location: index.php?action=QuanLyTheLoai');
            }
        }
    }

    //tim kiem the loai
    public function TimKIemTheLoai(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $theloai = new Theloai();
            $tentheloai = $_POST['timkiemtheloai'];
            if(isset($_POST['timkiemtheloai'])){
                return $theloai->TimKiemTheLoai($tentheloai);
            }
        }
    }

    //hien thi the loai theo loai san pham
    public function HienThiTheoLoaisp(){
        if (isset($_GET['loaisp'])) {
            $theloai = new Theloai();
            $loaisp = $_GET['loaisp'];
            $dsTheloai = $theloai->HienThiTheoLoaisp($loaisp);
            echo json_encode(["success" => true, "theloai" => $dsTheloai]);
        } else {
            echo json_encode(["success" => false]);
        }
    }

}