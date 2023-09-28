<?php
class Book{
    private $id;
    private $title;
    private $author;
    private $publicationYear;
    private $imageReview;
    private $type;
    public function __construct($id, $title, $author, $publicationYear, $imageReview, $type)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->publicationYear = $publicationYear;
        $this->imageReview = $imageReview;
        $this->type = $type;
    }

    public function setID($id) {
        $this->id = $id;
    }
    public  function setTitle($title) {
        $this->title = $title;
    }
    public function setAuthor($author) {
        $this->author = $author;
    }
    public function setPublicationYear($publicationYear) {
        $this->publicationYear = $publicationYear;
    }
    public function setImageReview($imageReview) {
        $this->imageReview = $imageReview;
    }
    public function setType($type) {
        $this->type = $type;
    }
    public function getID() {
        return $this->id;
    }
    public  function getTitle() {
        return $this->title;
    }
    public function getAuthor() {
        return $this->author;
    }
    public function getPublicationYear() {
        return $this->publicationYear;
    }
    public function getImageReview() {
        return $this->imageReview;
    }
    public function getType() {
        return $this->type;
    }
}

class library{
    private $books;
    public function __construct($books) {
        $this->books = $books;
    }
    public function setBooks($books) {
        $this->books = $books;
    }
    public function getBooks(){
        return $this->books;
    }
    public function addBook($book) {
        $this->books[] = $book;
    }

    public function searchBookById($id){
        $index = -1;
        for ($i = 0; $i < count($this->books); $i++) {
            if ($this->books[$i]->$id == $id){
                return $index;
            }
        }
        return $index;
    }

    public function removeBook($bookId){
        $index = $this->searchBookById($bookId->id);
        if ($index != -1) {
            $this->books = array_slice($this->books, $index, 1);
        }
    }
    public function searchBookByTitle($title){
        $foundBooks = [];
        for ($i = 0; $i < count($this->books); $i++) {
            if ($this->books[$i]->$title == $title){
                $foundBooks[] = $this->books[$i];
            }
        }
        return $foundBooks;
    }

    public function searchBookByAuthor($author){
        $foundBooks = [];
        for ($i = 0; $i < count($this->books); $i++) {
            if ($this->books[$i]->$author == $author){
                $foundBooks[] = $this->books[$i];
            }
        }
        return $foundBooks;
    }
    public function getAllBooks(){
        return $this->books;
    }
}

class User{
    private $id;
    private $fullName;

    public function __construct($id, $fullName)
    {
        $this->id = $id;
        $this->fullName = $fullName;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setFullName($fullName){
        $this->fullName = $fullName;
    }
    public function getId(){
        return $this->id;
    }

    public function getFullName(){
        return $this->fullName;
    }
}

class Loan{
    private $user;
    private $book;
    private $dueDate;
    public function __construct($user, $book, $dueDate){
        $this->user = $user;
        $this->book = $book;
        $this->dueDate = $dueDate;
    }
    public function setUser($user){
        $this->user = $user;
    }
    public function setBook($book){
        $this->book = $book;
    }
    public function setDueDate($dueDate){
        $this->dueDate = $dueDate;
    }
    public function getUser(){
        return $this->user;
    }
    public function getBook(){
        return $this->book;
    }
    public function getDueDate(){
        return $this->dueDate;
    }
}