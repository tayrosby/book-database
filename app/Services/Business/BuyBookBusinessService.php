<?php

namespace App\Services\Business;

use App\Services\Data\BuyBookDataService;
use App\Services\Utility\Connection;
use App\Model\BookModel;
use App\Services\Utility\MyLogger;

class BuyBookBusinessService
{
    /**
     * passes the model to the data service to insert a book
     * @param BookModel $book
     * @return boolean
     */
    public function addBook($book)
    {
        MyLogger::info("Entering BuyBookBusinessService.addBook");
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new BuyBookDataService($conn);
        
        //sends the model to the create function in the data service
        $success = $service->addBookToList($book);
        
        //closes the connection
        $conn = null;
        
        //if it is successful return true
        if ($success == 1) { return true; }
        //else return false
        else { return false; }
        
        MyLogger::info("Exiting BuyBookBusinessService.addBook");
    }
    
    /**
     * passes the model to the data service to delete a book
     * @param BookModel $id
     * @return boolean
     */
    public function deleteBook($id)
    {
        MyLogger::info("Entering BuyBookBusinessService.deleteBook");
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new BuyBookDataService($conn);
        
        //sends the model to the delete function in the data service
        $success = $service->removeBookFromList($id);
        
        //closes the connection
        $conn = null;
        
        //if it is successful return true
        if ($success == 1) { return true; }
        
        //else return false
        else { return false; }
        
        MyLogger::info("Exiting BuyBookBusinessService.deleteBook");
    }
    
    /**
     * passes the model to the data service to edit a list
     * @param BookModel $book
     * @return boolean
     */
    public function updateList($book)
    {
        MyLogger::info("Entering BuyBookBusinessService.updateList");
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //calls the data service
        $service = new BuyBookDataService($conn);
        
        //sends the model to the edit function in the data service
        $success = $service->editList($book);
        
        //closes the connection
        $conn = null;
        
        //if it is successful return true
        if ($success == 1) { return true; }
        
        //else return false
        else { return false; }
        
        MyLogger::info("Exiting BuyBookBusinessService.updateList");
    }
    
    /**
     * finds all of the books in the database
     * @return array
     */
    public function findAllBooks()
    {
        MyLogger::info("Entering BuyBookBusinessService.findAllBooks");
        //creates a connection
        $db = new Connection();
        $conn = $db->open();
        
        //creates an array of education
        $books = Array();
        
        //calls the data service
        $service = new BuyBookDataService($conn);
        
        //calls the find all method in the data service
        $books = $service->findAllBooks();
        
        //closes the connection
        $conn = null;
        
        //return the array
        return $books;
        
        MyLogger::info("Exiting BuyBookBusinessService.findAllBooks");
    }
}
