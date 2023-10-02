<?php
interface shape{
    public function calArea();
    public function calPerimeter();
}
class square implements shape {
    private $side;
    public function __construct($side)
    {
        $this->side = $side;
    }
    public function calArea()
    {
        // TODO: Implement calArea() method.
        return $this->side * $this->side;
    }
    public function calPerimeter()
    {
        // TODO: Implement calPerimeter() method.
        return $this->side * 4;
    }
}

class rectangle implements shape {
    private $length;
    private $width;
    public function __construct($length, $width)
    {
        $this->length = $length;
        $this->width = $width;
    }
    public function calArea()
    {
        // TODO: Implement calArea() method.
        return $this->length * $this->width;
    }
    public function calPerimeter()
    {
        // TODO: Implement calPerimeter() method.
        return 2 * ($this->length + $this->width);
    }
}

$square = new square(7);
echo "Diện tích hình vuông = " . $square->calArea() . "<br>";
echo "Chu vi hình vuông = " . $square->calPerimeter() . "<br>";
echo "----------------------------------<br>";

$rectangle = new rectangle(4, 6);
echo "Diện tích hình chữ nhật: " . $rectangle->calArea() . "<br>";
echo "Chu vi hình chữ nhật: " . $rectangle->calPerimeter() . "<br>";
