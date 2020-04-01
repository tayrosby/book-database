<?php

namespace App\Services\Data;
use PDOException;
use App\Model\BookModel;
use \PDO;
use App\Services\Utility\DatabaseException;
use App\Services\Utility\MyLogger;

class OwnedBookDataService
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
            MyLogger::info("Entering OwnedBookDataService.addBookToList");
            // Taking user info from user
            $bookName = $book->bookName;
            $author = $book->author;
            
            // Create SQL statement using prepare()
            $stmt = $this->conn->prepare("INSERT INTO OWNED (ID, BOOK_NAME, AUTHOR) VALUES (NULL, :bookName, :author)");
            $stmt->bindParam(':bookName', $bookName);
            $stmt->bindParam(':author', $author);
            
            $stmt->execute();
            // Save the row count
            $count = $stmt->rowCount();
            // Close the statement
            $stmt = null;
            // Return the number of rows that were affected
            return $count;
            MyLogger::info("Exit OwnedBookDataService.addBookToList");
        }
        catch(PDOException $e)
        {
            MyLogger::error("Exception OwnedBookDataService.addBookToList: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
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
            MyLogger::info("Entering OwnedBookDataService.editList");
            //takes information from the user
            $id = $book->id;
            $bookName = $book->bookName;
            $author = $book->author;
            
            //prepares a sql statement
            $stmt = $this->conn->prepare("UPDATE `OWNED` SET `BOOK_NAME` = :bookName, `AUTHOR` = :author WHERE `OWNED`.`ID` = :id");
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
            MyLogger::info("Exit OwnedBookDataService.editList");
        }
        catch(PDOException $e)
        {
            MyLogger::error("Exception OwnedBookDataService.editList: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
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
            MyLogger::info("Entering OwnedBookDataService.removeBookFromList");
            //prepares a sql statement
            $stmt = $this->conn->prepare("DELETE FROM `OWNED` WHERE `OWNED`.`ID` = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            //saves the row count
            $count = $stmt->rowCount();
            
            //closes the connection
            $stmt = null;
            
            //returns the row count
            
            return $count;
            MyLogger::info("Exit OwnedBookDataService.removeBookFromList");
        }
        catch(PDOException $e)
        {
            MyLogger::error("Exception OwnedBookDataService.removeBookFromList: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
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
            MyLogger::info("Entering OwnedBookDataService.findAllBooks");
            //prepares a sql statement
            $stmt = $this->conn->prepare("SELECT * FROM `OWNED`");
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
            MyLogger::info("Exit OwnedBookDataService.findAllBooks");
            
        }
        catch(PDOException $e)
        {
            MyLogger::error("Exception OwnedBookDataService.findAllBooks: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}
