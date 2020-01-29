<?php
namespace App\Model;

class BookModel 
{
    //book attributes
    private $id;
    private $bookName;
    private $author;
    
    /**
     * Constructor
     * @param BookModel $id
     * @param BookModel $bookName
     * @param BookModel $author
     */
    public function __construct($id, $bookName, $author)
    {
        $this->id = $id;
        $this->bookName = $bookName;
        $this->author = $author;
    }
    
    /**
     * Getter
     * @param $property
     * @return $property
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) { return $this->$property; }
    }
}