<?php
require_once('./models/class/SanPham.php');

class SanPhamController{
    //hien thi san pham
    public function HienThiSP(){
        $sp = new SanPham();
        return $sp->HienThiSP();
    }

    //them san pham
    public function ThemSanPham(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $sanpham = new SanPham();
            if(isset($_POST['submit'])){
                $sanpham->tensp = $_POST['tensp'];
                $sanpham->loaisp = $_POST['loaisp'];
                $sanpham->tentheloai = $_POST['tentheloai'];
                $sanpham->giaban = $_POST['giaban'];
                $sanpham->soluong = $_POST['soluong'];
                //anh
                $target = "./views/viewSanPham/SanPhamImg/";
                $anh = $target . basename($_FILES['anh']['name']);
                $sanpham->anh = $anh;
                if($sanpham->loaisp != "-- Chọn loại sản phẩm --"){
                    move_uploaded_file($_FILES['anh']['tmp_name'], $anh);
                    $sanpham->TheSanPham();
                    header('Location: index.php?action=QuanLySanPham');
                }
                else{
                    echo json_encode(['success' => false]);
                }
            }
        }
    }

    //xoa san pham
    public function XoaSanPham(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $sanpham = new SanPham();
            $sanpham->idsp = $_POST['idsp'];
            $deleted = $sanpham->XoaSanPham($sanpham->idsp);
            if ($deleted) {
                echo "success";
            } else {
                echo "error";
            }
        }
    }

    //lay id san pham 
    public function getIdSanPham(){
        $sanpham = new SanPham();
        if (isset($_GET['idsp'])) {
            $id = intval($_GET['idsp']);
            $data = $sanpham->getIdSanPham($id);
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

    //sua san pham
    public function SuaSanPham(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $sanpham = new SanPham();
            $idsp = intval($_POST['idsp']);
            $sanpham->tensp = $_POST['tensp'];
            $sanpham->giaban = $_POST['giaban'];
            $sanpham->soluong = $_POST['soluong'];
            //anh 
            $target = "views/viewSanPham/SanPhamImg/";
            $anh = $target . basename($_FILES['anh']['name']);
            $sanpham->anh = $anh;
            //neu thay doi anh
            if(!empty($_FILES['anh']['name'])){
                //tai anh len thanh cong
                if(move_uploaded_file($_FILES['anh']['tmp_name'],$anh)){
                    $success = $sanpham->SuaSanPhamHaveImg($idsp);
                    header('Location: index.php?action=QuanLySanPham');
                }
                else{
                    echo json_encode(["success" => false, "message" => "Lỗi tải ảnh lên!"]);
                    return;
                }
            }
            //khong thay doi anh
            else{
                $sanpham->SuaSanPhamNoImg($idsp);
                header('Location: index.php?action=QuanLySanPham');
            }
        }
    }

    //tim kiem sp 
    public function TimKiemSp(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $sanpham = new SanPham();
            $keyword = $_POST['timkiemtensp'];
            if(isset($_POST['timkiemtensp'])){
                return $sanpham->TimKiemSp($keyword);
            }  
        }
    }

}