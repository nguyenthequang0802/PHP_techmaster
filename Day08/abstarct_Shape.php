<?php
abstract class shape{
    protected $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
    abstract public function calculateArea();
}
class Circle extends shape {
    private $radius;
    public function __construct($name, $radius)
    {
        parent::__construct($name);
        $this->radius = $radius;
    }
    public function calculateArea()
    {
        // TODO: Implement calculateArea() method.
        return 3.14 * 2 * $this->radius;
    }
}
class square extends shape {
    private $side;
    public function __construct($name, $side)
    {
        parent::__construct($name);
        $this->side = $side;
    }
    public function calculateArea()
    {
        // TODO: Implement calculateArea() method.
        return $this->side * $this->side;
    }
}

$circle = new Circle("circle", 5);
echo "Diện tích hình tròn: " . $circle->calculateArea() . "<br>";

$square = new square("square", 7);
echo "Diện tích hình vuông: " . $square->calculateArea() . "<br>";
