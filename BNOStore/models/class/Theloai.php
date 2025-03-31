<?php
require_once('./models/Connection.php');
class Theloai{
    public $idtheloai;
    public $tentheloai;
    public $anh;
    public $ghichu;
    private $conn;

    //goi ket noi
    public function __construct(){
        $connect = new Connection();
        $this->conn = $connect->getConnection();
    }

    //
}