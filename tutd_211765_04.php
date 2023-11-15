<?php
    declare(strict_types=1);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bài 3</title>

</head>
<body>
    <a href="./"><button>Trở về thư mục gốc của dự án</button></a>
    <br><br>

<?php
    class Account {
        private string $stk;
        private string $ten;
        private float $sodu;
        const LAIXUAT = 0.02;

        public function __construct(string $stk, string $ten, float $sodu=50000) {
            $this->stk = $stk;
            $this->ten = $ten;
            $this->sodu = $sodu;
        }

        private function getSodu () :float{
            return $this->sodu;
        }

        private function setSodu (float $tien) {
            $this->sodu = $tien;
        }

        public function display () {
            echo("<br>Tài Khoản $this->stk có tên $this->ten còn $this->sodu VND!");
        }

        public function naptien ($tien) :bool {
            if ($tien > 0) {
                self::setSodu(self::getSodu()+$tien);
                return true;
            }
            else {
                echo("<br>Số tiền giao dịch phải lớn hơn 0");
                return false;
            }
        }

        public function ruttien ($tien) :bool {
            if ($tien > 0) {
                if ($tien < self::getSodu()) {
                    self::setSodu(self::getSodu()-$tien);
                    return true;
                }
                else {
                    echo("<br>Số dư trong tài khoản không đủ $tien");;
                    return false;
                }
            }
            else {
                echo("<br>Số tiền giao dịch phải lớn hơn 0");
                return false;
            }
        }

        public function daohan () {
            self::setSodu(self::getSodu() + self::getSodu()*Account::LAIXUAT);
        }
    }

    function chuyenkhoan (Account $a1, Account $a2, float $tien) {
        if ($a1->rutTien($tien) == true) {
            $a2->napTien($tien);
        }
    }

    $a1 = new Account("211765", "TONG DANG TU", 1000000);
    $a2 = new Account("012345", "NGUYEN VAN TEO", 5000000);

    $a1->display();
    $a1->rutTien(200000);
    $a1->display();
    $a1->napTien(500000);
    $a1->display();

    $a2->display();
    chuyenkhoan($a2, $a1, 6000000);
    $a1->display();
    $a2->display();
?>
</body>
</html>
