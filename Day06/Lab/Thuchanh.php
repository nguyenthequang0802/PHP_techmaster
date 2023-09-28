<?php
class Car{
    public $name;
    public $bienSo;
    public $chuSoHuu;
    public $namSX;

    public function __construct($name, $bienSo, $chuSoHuu, $namSX)
    {
        $this->name = $name;
        $this->bienSo = $bienSo;
        $this->chuSoHuu = $chuSoHuu;
        $this->namSX = $namSX;
    }
    public function showInfo(){
        echo "Ten: " . $this->name . "<br>";
        echo "Bien so xe: " . $this->bienSo . "<br>";
        echo "Chu so huu xe: " . $this->chuSoHuu . "<br>";
        echo "Nam san xuat xe: " . $this->namSX . "<br>";
        echo "<br>";
    }

    public function changeAuthor($chuMoi) {
        $this->chuSoHuu = $chuMoi;
    }
}

$car1 = new Car("Porche Cayenne", "30K-111.11", "Nguyen Van A", 2022);
$car2 = new Car("Huyndai Palisade", "30K-123.45", "Nguyen Van B", 2023);
$car3 = new Car("BMW i8", "30K-345.67", "Nguyen Van C", 2021);

$car1->showInfo();
$car2->showInfo();
$car3->showInfo();

echo "----------------------<br>";
echo "<br>";
$car2->changeAuthor("Nguyen The Quang");
$car2->showInfo();