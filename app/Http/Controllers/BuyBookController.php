<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\BookModel;
use App\Services\Business\BuyBookBusinessService;
use Exception;
use App\Services\Utility\MyLogger;

class BuyBookController extends Controller
{
    
    /**
     * adds book information to the database
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function addBook(Request $request)
    {
        try {
            MyLogger::info("Entering BuyBookController::addBook");
            //takes information from the user
            $author = $request->input('author');
            $bookName = $request->input('bookName');
            $id = $request->input('id');
            
            //creates a book object
            $book = new BookModel($id, $bookName, $author);
            
            //calls the business service
            $service = new BuyBookBusinessService();
            
            //passes the model to the add method in the business service
            $success = $service->addBook($book);
            
            //fail or succeed return to the profile page
            if($success)
            {
                return view('buybook');
                MyLogger::info("Exit BuyBookController::addBook passing");
            }
            else
            {
                return view('buybook');
                MyLogger::info("Exit BuyBookController::addBook failing");
            }
            
        }
        
        catch (Exception $e){
            //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
            //log the exception and display exception view
            MyLogger::error("Exception BuyBookController::addBook : ", array("message" => $e->getMessage()));
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
            MyLogger::info("Entering BuyBookController::editBook");
            //takes information from the user
            $author = $request->input('author');
            $bookName = $request->input('bookName');
            $id = $request->input('id');
            
            //creates a book object
            $book = new BookModel($id, $bookName, $author);
            
            //calls the business service
            $service = new BuyBookBusinessService();
            
            //passes the model to the edit method in the business service
            $success = $service->updateList($book);
            
            //fail or succeed return to the profile page
            if($success)
            {
                return view("buybook");
                MyLogger::info("Exit BuyBookController::editBook passing");
            }
            else
            {
                return view("buybook");
                MyLogger::info("Exit BuyBookController::editBook failing");
            }
        }
        
        catch (Exception $e){
            //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
            //log the exception and display exception view
            MyLogger::error("Exception BuyBookController::editBook : ", array("message" => $e->getMessage()));
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
            MyLogger::info("Entering BuyBookController::findAllBooks");
            //calls the business service
            $service = new BuyBookBusinessService();
            
            //calls the find all method in the business service
            $success = $service->findAllBooks();
            
            //fail or succeed return to the profile page
            if($success)
            {
                return view("buybook");
                MyLogger::info("Exit BuyBookController::findAllBooks passing");
            }
            else
            {
                return view("buybook");
                MyLogger::info("Exit BuyBookController::findAllBooks failing");
            }
            

        }
        catch (Exception $e){
            //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
            //log the exception and display exception view
            MyLogger::error("Exception BuyBookController::findAllBooks : ", array("message" => $e->getMessage()));
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
            MyLogger::info("Entering BuyBookController::deleteBook");
            //takes information from the user
            $id = $request->input('id');
            
            
            //calls the business service
            $service = new BuyBookBusinessService();
            
            //passes the model to the delete method in the business service
            $success = $service->deleteBook($id);
            
            //fail or succeed return to the buy page
            if($success)
            {
                return view("buybook");
                MyLogger::info("Exit BuyBookController::deleteBook passing");
            }
            else
            {
                return view("buybook");
                MyLogger::info("Exit BuyBookController::deleteBook failing");
            }
        }
        catch (Exception $e){
            //Best practice: catch all exceptions, log the exception, and display the common error page (or use global exception handling
            //log the exception and display exception view
            MyLogger::error("Exception BuyBookController::deleteBook : ", array("message" => $e->getMessage()));
            $data = ['errorMSG' => $e->getMessage()];
            return view('exception')->with($data);
        }
    }
}
