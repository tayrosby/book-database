<?php

namespace App\Services\Data;
use PDOException;
use App\Model\BookModel;
use \PDO;

class BuyBookDataService 
{
    //attribute for the connection
    private $conn;
    
    /**
     * constructor
     * @param $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    
    /**
     * Create Method
     * @param BookModel $book
     * @return $count - row count
     */
    public function addBookToList(BookModel $book)
    {   
        try
        {
            // Taking user info from user
            $bookName = $book->bookName;
            $author = $book->author;
            
            // Create SQL statement using prepare()
            $stmt = $this->conn->prepare("INSERT INTO NEED_TO_BUY (ID, BOOK_NAME, AUTHOR) VALUES (NULL, :bookName, :author)");
            $stmt->bindParam(':bookName', $bookName);
            $stmt->bindParam(':author', $author);
            
            $stmt->execute();
            // Save the row count
            $count = $stmt->rowCount();
            // Close the statement
            $stmt = null;
            // Return the number of rows that were affected
            return $count;
        }
        catch(PDOException $e)
        {
           // throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * update method
     * @param BookModel $book
     * @return $count - row count
     */
    public function editList(BookModel $book)
    {
        
        try
        {
            //takes information from the user
            $id = $book->id;
            $bookName = $book->bookName;
            $author = $book->author;
            
            //prepares a sql statement
            $stmt = $this->conn->prepare("UPDATE `NEED_TO_BUY` SET `BOOK_NAME` = :bookName, `AUTHOR` = :author WHERE `NEED_TO_BUY`.`ID` = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':bookName', $bookName);
            $stmt->bindParam(':author', $author);
            $stmt->execute();
            
            //saves the row count
            $count = $stmt->rowCount();
            
            //closes the statement
            $stmt = null;
            
            //returns the row count
            return $count;
        }
        catch(PDOException $e)
        {
           // throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * delete method
     * @param BookModel $id
     * @return $count - row count
     */
    public function removeBookFromList($id)
    {     
        try
        {
            //prepares a sql statement
            $stmt = $this->conn->prepare("DELETE FROM `NEED_TO_BUY` WHERE `NEED_TO_BUY`.`ID` = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            //saves the row count
            $count = $stmt->rowCount();
            
            //closes the connection
            $stmt = null;
            
            //returns the row count

            return $count;
        }
        catch(PDOException $e)
        {
           // throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    /**
     * read method
     * @return array
     */
    public function findAllBooks()
    {     
        try
        {
            //prepares a sql statement
            $stmt = $this->conn->prepare("SELECT * FROM `NEED_TO_BUY`");
            $stmt->execute();
            
            //creates an array of education
            $books = [];
            
            //fetched the education and pushes it onto an array
            while($book = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                array_push($books, $book);
            }
            
            //closes the connection
            $stmt = null;
            
            //returns the education
            return $books;
            
        }
        catch(PDOException $e)
        {
           // throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}