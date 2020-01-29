@php
use App\Services\Business\BuyBookBusinessService;
@endphp

@extends('layouts.maintemplate')
@section('title', 'Book Database | Books You Want to Buy')

@php
$bbs = new BuyBookBusinessService();
$bbook = $bbs->findAllBooks();
@endphp

<style>
h4 {
	text-align:left;
}
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}
/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}
/* Add a background color when the inputs get focus */
input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}
/* Set a style for all buttons */
button {
  background-color: #D3D3D3;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 50%;
  opacity: 0.9;
}
button:hover {
  opacity:1;
}
/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #EC340D;
}
/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}
/* Add padding to container elements */
.container {
  padding: 16px;
}
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: #474e5d;
  padding-top: 50px;
}
/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}
/* Style the horizontal ruler */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}
 
/* The Close Button (x) */
.close {
  position: absolute;
  right: 35px;
  top: 15px;
  font-size: 40px;
  font-weight: bold;
  color: #f1f1f1;
}
.close:hover,
.close:focus {
  color: #f44336;
  cursor: pointer;
}
/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}
/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>

@section('content')

<table class="table table-dark">
    <thead>
    <h4>Books You Want to Buy</h4>
        <tr>
            <th> ID</th>
            <th> Book Name</th>
            <th> Author</th>
        </tr>
    </thead>
    <tbody>
          @for ($i = 0; $i < count($bbook); $i++)
          <tr>
              <td> {{ $bbook[$i]['ID'] }} </td>
              <td> {{ $bbook[$i]['BOOK_NAME'] }} </td>
              <td> {{ $bbook[$i]['AUTHOR'] }} </td>
          
           <td> <!-- Button to open the modal -->
<button onclick="document.getElementById('id01').style.display='block'">Add</button>    <!-- The Modal (contains the Sign Up form) -->
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="add_buy" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />

    <div class="container">
      <h1>Add Book</h1>
      <hr>
      <input type="hidden" name = "user_id" value = "{{ $bbook[$i]['ID'] }}">
      <label for="position"><b>Book</b></label>
      <input type="text" placeholder="Enter Book" name="bookName" required>
      <input type="text" placeholder="Enter author" name="author" required>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Add</button>
      </div>
    </div>
  </form>
</div>
</td>
              <td> <!-- Button to open the modal -->
<button onclick="document.getElementById('id02').style.display='block'">Edit</button>

<!-- The Modal (contains the Sign Up form) -->
<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="edit_buy" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
    <div class="container">
      <h1>Edit Book</h1>
      <hr>
      <input type="hidden" name = "id" value = "{{ $bbook[$i]['ID'] }}">
      
       <label for="position"><b>Book</b></label>
      <input type="text" placeholder="Enter Book" name="bookName"  value="{{ $bbook[$i]['BOOK_NAME'] }} " required>
      <input type="text" placeholder="Enter Author" name="author"  value=" {{ $bbook[$i]['AUTHOR'] }} " required>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Edit</button>
      </div>
    </div>
  </form>
</div>
</td>

<td>
<button onclick="document.getElementById('id07').style.display='block'">Delete</button>
<div id="id07" class="modal">
  <span onclick="document.getElementById('id07').style.display='none'" class="close" title="Close Modal">x</span>
  <form class="modal-content" action="delete_buy" method="post">
  <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />
    <div class="container">
      <h1>Delete Book</h1>
      <input type="hidden" name = "id" value = "{{ $bbook[$i]['ID'] }}">
      <hr>   
 	<p>Are you sure you want to delete?</p>
      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id07').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Delete</button>
      </div>
    </div>
  </form>
</div>
</td>
          </tr>
         @endfor
   </tbody>
</table>

<script>
// Get the modal
var modal = document.getElementById('id01');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
@endsection