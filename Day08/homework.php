<?php
interface Borrowable{
    // viết code định nghĩa 2 method  borrow() và returnItem()
    public function borrow();
    public function returnItem();
}

Class Book implements Borrowable{
    private $title;
    private $author;
    private $isBrrowed;

    // viết hàm khởi tạo class
    public function __construct($title, $author){
        $this->title = $title;
        $this->author = $author;
        $this->isBrrowed = false;
    }
    // function borrow()
    public function borrow()
    {
        // TODO: Implement borrow() method.
        if (!$this->isBrrowed){
            $this->isBrrowed = true;
            echo "Sách " . $this->title . " của " .$this->author . " đã được cho mượn!<br>";
        } else {
            echo "Sách " . $this->title . " của " . $this->author . "đã cho mượn, không còn trong thư viện";
        }
    }
    // Nếu sách chưa được mượn thì thực hiện cho mượn và trả ra thông báo sách $title của $author đã được mượn
    // Nếu không thì trả về thông báo "sách đã được mượn từ trước, ko thể mượn"

    // function returnItem()
    // viết code trả sách và trả về thông báo trả sách thành công
    public function returnItem()
    {
        // TODO: Implement borrow() method.
        if (!$this->isBrrowed){
            $this->isBrrowed = false;
            echo "Sách " . $this->title . " của " .$this->author . " đã trả thành công!<br>";
        } else {
            echo "Sách " . $this->title . " của " . $this->author . " chưa được trả!";
        }
    }
}

Class Paper implements Borrowable{
    private $title;
    private $date;
    private $isBorrowed;
    // Viết code còn lại giống Book
    public function __construct($title, $author){
        $this->title = $title;
        $this->author = $author;
        $this->isBrrowed = false;
    }
    public function borrow()
    {
        // TODO: Implement borrow() method.
        if (!$this->isBrrowed){
            $this->isBrrowed = true;
            echo "Báo " . $this->title . " của " .$this->author . " đã được cho mượn!<br>";
        } else {
            echo "Báo " . $this->title . " của " . $this->author . "đã cho mượn, không còn trong thư viện";
        }
    }
    public function returnItem()
    {
        // TODO: Implement borrow() method.
        if ($this->isBrrowed){
            $this->isBrrowed = false;
            echo "Báo " . $this->title . " của " .$this->author . " đã trả thành công!<br>";
        } else {
            echo "Báo " . $this->title . " của " . $this->author . " chưa được trả!";
        }
    }
}

$book = new Book("Tiếng Việt lớp 5", "NXB Giáo Dục");
$book->borrow(true);
$book->returnItem(false);
echo "<br>";
$paper = new Paper("Hà Nội mới", "ABC");
$paper->borrow(true);
$paper->returnItem(true);