<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\BookModel;
use App\Services\Business\OwnedBookBusinessService;
use Exception;

class OwnedBookController extends Controller
{
    /**
     * adds book information to the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function addBook(Request $request)
    {
        try {
            //takes information from the user
            $author = $request->input('author');
            $bookName = $request->input('bookName');
            $id = $request->input('id');
            
            //creates a book object
            $book = new BookModel($id, $bookName, $author);
            
            //calls the business service
            $service = new OwnedBookBusinessService();
            
            //passes the model to the add method in the business service
            $success = $service->addBook($book);
            
            //fail or succeed return to the profile page
            if($success)
            {
                return view("ownedbook");
            }
            else
            {
                return view("ownedbook");
            }
            
        }
        
        catch (Exception $e){
            //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
            //log the exception and display exception view
            $data = ['errorMSG' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    /**
     * edit book information in the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function editBook(Request $request)
    {
        try {           
            //takes information from the user
            $author = $request->input('author');
            $bookName = $request->input('bookName');
            $id = $request->input('id');
            
            //creates a book object
            $book = new BookModel($id, $bookName, $author);
            
            //calls the business service
            $service = new OwnedBookBusinessService();
            
            //passes the model to the edit method in the business service
            $success = $service->updateList($book);
            
            //fail or succeed return to the profile page
            if($success)
            {
                return view("ownedbook");
            }
            else
            {
                return view("ownedbook");
            }
        }
        
        catch (Exception $e){
            //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
            //log the exception and display exception view
            $data = ['errorMSG' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    /**
     * finds all the books in the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function findAllBooks(Request $request)
    {
        try {
            //calls the business service
            $service = new OwnedBookBusinessService();
            
            //calls the find all method in the business service
            $success = $service->findAllBooks();
            
            if($success)
            {
                return view("ownedbook");
            }
            else
            {
                return view("ownedbook");
            }
            
            // Puts the users in an associative array
            //$data = ['obooks' => $obooks];
            
           // return view("ownedbook")->with($data);
            
          
        }
        catch (Exception $e){
            //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
            //log the exception and display exception view
            $data = ['errorMSG' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
    
    /**
     * delete book information in the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deleteBook(Request $request)
    {
        try {
            $id = $request->input('id');
            
            //calls the business service
            $service = new OwnedBookBusinessService();
            
            //passes the model to the delete method in the business service
            $success = $service->deleteBook($id);
            
            //fail or succeed return to the profile page
            if($success)
            {
                return view("ownedbook");
            }
            else
            {
                return view("ownedbook");
            }
        }
        catch (Exception $e){
            //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
            //log the exception and display exception view
            $data = ['errorMSG' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
}