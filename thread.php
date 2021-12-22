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
    <title>iCode- query-reply</title>
</head>

<body>
    <!-- Navebar header -->
    <?php include 'partials/_header.php'; ?>

    <!-- display thread -->
    <?php
        $id= $_GET['threadid'];
        $sql = "SELECT * FROM `threads` WHERE thread_id='$id'";
        $result = mysqli_query($conn , $sql);
        while($row = mysqli_fetch_assoc($result)){
            $threadtitle = $row['thread_title'];
            $threaddesc = $row['thread_desc'];
            $post_by = $row['thread_user_id'];

            //query  the user table to find the name of question by
            $sql2 = "SELECT * FROM `users` WHERE sno='$post_by'";
            $result2 = mysqli_query($conn , $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $posted_by = $row2['user_name'];
        }
    ?>

    <!-- Insert comment in db -->
    <?php
        //submit comment to db
        $method = $_SERVER['REQUEST_METHOD'];
        if($method =='POST'){
            $comment = $_POST['comment'];
            $comment = str_replace("<", "&lt;" , $comment);
            $comment = str_replace(">", "&gt;" , $comment);
            $sno = $_POST['sno'];

            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_time`, `comment_by`) VALUES ('$comment', '$id', current_timestamp(), '$sno')";
            $result = mysqli_query($conn , $sql);
            if($result){
                    echo '<div class="alert alert-success alert-dismissible fade show my-1" role="alert">
                    <strong>Posted!</strong> Your comment Posted.
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
            <h1 class="display-4"><?php echo $threadtitle ?></h1>
            <p class="lead"><?php echo $threaddesc ?></p>
            <hr class="my-4">
            <em><p>No Spam / Advertising / Self-promote in the forums.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Do not PM users asking for help.
                Remain respectful of other members at all times</p></em>
            <p>Posted by: <b><em><?php echo $posted_by ?></em></b></p>
        </div>
    </div>

    <!-- Comment list -->

    <div class="container my-3 ques">
        <h2 class="my-4">Discussion</h2>
    <?php
        $noresult = true;
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $result = mysqli_query($conn , $sql);
        while($row = mysqli_fetch_assoc($result)){
            $noresult = false;
            $comment_content = $row['comment_content'];
            $comment_by = $row['comment_by'];
            $timestamp = $row['comment_time'];
            $new_time = date("H:i d-m-Y",strtotime($timestamp));
            $new_date = date("d-m-Y",strtotime($timestamp));

            $sql2 = "SELECT * FROM `users` WHERE sno='$comment_by'";
            $result2 = mysqli_query($conn , $sql2);
            $row2 = mysqli_fetch_assoc($result2);

        echo '<div class="media my-3">
            <img src="images/user_icon.png" class="align-self-start mr-3 user-img" alt="...">
            <div class="media-body">
                <p class="font-weight-bold my-0">'. $row2['user_name'] .' <i class="float-time">'. $new_time .'</i></p>
                <p> '. $comment_content .'</p>
            </div>
        </div>';
        }
        if($noresult){
            echo '<div class="alert alert-dark" role="alert">
           <h3>No Comment Found</h3>
           <p>Be the first person post comment</p>
          </div>';
        }
    ?>
    </div>

    <!-- comment form -->
<?php
        /* to make Post  request in same page with url after ? then we use Req_uri
         <form action="<?php $_SERVER['REQUEST_URI'] ?>" method="POST"> */
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){        
    echo '<div class="container my-5">
        <h2 class="py-2">Post a Comment</h2>
        <form action="thread.php?threadid='.$id.'" method="POST">
            <div class="form-group">
                <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Type a comment"></textarea>
            </div>
            <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
            <button type="submit" class="btn btn-success">Post Comment</button>
        </form>
    </div>';
    }
    else{
        echo '
        <div class="container my-5">
        <h2 class="py-2">Post a Comment</h2>
            <div class="alert alert-secondary" role="alert">
                You are not loggin. Please login to post comment.
            </div>
        </div>';
    }

?>
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
