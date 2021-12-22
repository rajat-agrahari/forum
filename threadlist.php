<?php
        include 'partials/_dbconnect.php';
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="partials/style.css">
    <title>iCode- queries</title>
</head>

<body>
    <!-- Navebar header -->
    <?php include 'partials/_header.php'; ?>
   
    <?php
        $id= $_GET['catid'];  //to grab category id grom GET url
        $sql = "SELECT * FROM `categories` WHERE category_id= '$id'";
        $result = mysqli_query($conn , $sql);
        while($row = mysqli_fetch_assoc($result)){
            $catname = $row['category_name'];
            $catdesc = $row['category_description'];
        }
    ?>
     <?php
        //submit question to db
        $method = $_SERVER['REQUEST_METHOD'];
        if($method =='POST'){
            $th_title = $_POST['title'];
            $th_desc = $_POST['desc'];
            $sno = $_POST['sno'];
            
            //replace html tag
            $th_title = str_replace("<", "&lt;" , $th_title);
            $th_title = str_replace(">", "&gt;" , $th_title);
            $th_desc = str_replace("<", "&lt;" , $th_desc);
            $th_desc = str_replace(">", "&gt;" , $th_desc);
            
            //insert query
            $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
            $result = mysqli_query($conn , $sql);
            if($result){
                    echo '<div class="alert alert-success alert-dismissible fade show my-1" role="alert">
                    <strong>Posted!</strong> You question has been Post.Please wait user to response.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
            }
        }

    ?>

    <!-- Jumbotron -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname ?></h1>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <em><p>No Spam / Advertising / Self-promote in the forums.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Do not PM users asking for help.
                Remain respectful of other members at all times</p></em>
            <!-- <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> -->
        </div>
    </div>

    <!-- Ask question -->
<?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){        
        /*  to make Post  request in same page with url after ? then we use Req_uri 
          <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="POST"> */
        echo '<div class="container">
        <h2 class="py-2">Ask question</h2>
            <form action="threadlist.php?catid='.$id.'" method="POST">
                <div class="form-group">
                    <label for="title">Problem Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" required>

                </div>
                <div class="form-group">
                    <label for="desc">Ellobrate Your Concern</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea required>
                </div>
                <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>';
    }
    else{
        echo '
        <div class="container">
        <h2 class="py-2">Ask question</h2>
            <div class="alert alert-secondary" role="alert">
                You are not loggin. Please login to ask your query.
            </div>
        </div>';
    }
    ?>
    <!--Browse Ouestion -->
    <div class="container my-3 ques">
        <h2 class="my-4">Browse Questions</h2>
        <?php
        $noresult = true;
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn , $sql);
        while($row = mysqli_fetch_assoc($result)){
            $noresult = false;
            $tid= $row['thread_id'];

            $threadtitle = $row['thread_title'];
            $threaddesc = $row['thread_desc'];
            $thread_time = $row['timestamp'];
            $thread_user_id = $row['thread_user_id'];
            $timestamp = $row['timestamp'];
            $new_time = date("H:i",strtotime($timestamp));
            $new_date = date("d-m-Y",strtotime($timestamp));

            $sql2 = "SELECT * FROM `users` WHERE sno='$thread_user_id'";
            $result2 = mysqli_query($conn , $sql2);
            $row2 = mysqli_fetch_assoc($result2);

        echo '<div class="media my-3">
            <img src="images/user_icon.png" class="align-self-start mr-3 user-img" alt="...">
            <div class="media-body alert alert-secondary" role="alert">
                <h5 class="mt-0 ques-title"><a href="thread.php?threadid='. $tid .'">' . $threadtitle .'</a></h5>
                <p class="ques-desc"> '. $threaddesc .'</p>
                <p class="font-weight-bold my-0 user-name">Ask By :<em class="text-secondary"> '. $row2['user_name'] .'</em> at '.$new_time .' on '. $new_date .'</p>
            </div>
        </div>';
        }
        if($noresult){
            echo '<div class="alert alert-dark my-4" role="alert">
           <h3>No Ouestion Found</h3>
           <p>Be the first person ask question</p>
          </div>';
        }
    ?>
        
    </div>

    <?php include 'partials/_footer.php'; ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

</body>

</html>