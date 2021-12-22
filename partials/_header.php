<?php
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/forum">iCode</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">';
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
   echo '<li class="nav-item active">
          <a class="nav-link" href="#">Welcome '. $_SESSION['user_name'] .'<span class="sr-only">(current)</span></a>
         </li>';
  }
  echo '<li class="nav-item active">
      <a class="nav-link" href="/forum">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="about.php">About</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Top Categories
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

        $sql = "SELECT * FROM `categories`";
        $result = mysqli_query($conn , $sql);
        while($row = mysqli_fetch_assoc($result)){
          echo '<a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'] .'">'. $row['category_name'] .'</a>';
        }
     echo '</div>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="contact.php" >Contact</a>
    </li>
  </ul>
  <div class="row mr-4">
             <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
                <input class="form-control mr-sm-2" name="search"  type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        
     </form>';
   if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){        
     echo '<a href="partials/_logout.php" <button class="btn btn-success mx-1 header-btn">Logout</button></a>';
   }
   else{
     echo '<button class="btn btn-success mx-1 header-btn"  data-toggle="modal" data-target="#loginModal">Login</button>
     <button class="btn btn-success header-btn"  data-toggle="modal" data-target="#signupModal">SignUp</button>';
    }
   echo '</div>
</div>
</nav>';



include '_loginModal.php';
include '_signupModal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show my-1" role="alert">
        <strong>Success ! </strong> You account has been created. Now you can login.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
}
// display  alert if invalid SignUp details
if(isset($_GET['error']) && isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false"){
  echo '<div class="alert alert-danger alert-dismissible fade show my-1" role="alert">
      <strong>Error ! </strong> '. $_GET['error'] . '
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
}
// display  alert if invalid login details
if(isset($_GET['login']) && $_GET['login']=="false"){
  echo '<div class="alert alert-danger alert-dismissible fade show my-1" role="alert">
  <strong>Error ! </strong> Invalide credentials.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>