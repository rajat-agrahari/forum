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
    <style>
        .no-result{
            min-height: 65vh;
        }
    </style>
    <link rel="stylesheet" href="partials/style.css">

    <title>Welcome to iCode- Home</title>
</head>

<body>
    <!-- Navebar header -->
    <?php include 'partials/_header.php'; ?>

    <?php $query = $_GET['search']; ?>
      
    <!-- Search result start here  -->
    <div class=" my-4" id="main-contanier">
        <div class="alert alert-primary container text-center text-dark"  role="alert">
           <h1>Search result for <em><?php echo $query ?></em></h1>
        </div>
        <?php
        $noresult=true;
        $sql = "SELECT * FROM `threads` WHERE MATCH (thread_title,thread_desc) against ('$query')";
        $result = mysqli_query($conn , $sql);
        while($row = mysqli_fetch_assoc($result)){
            $noresult=false;
            $threadtitle = $row['thread_title'];
            $threaddesc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $url = "thread.php?threadid=". $thread_id;
           echo '<div class="container">
                <h3><a href="'. $url .'" class="text-dark">'. $threadtitle .'</a></h3>
                <p>'. $threaddesc.'</p>
            </div>';
        }
        if($noresult){
           echo '<div class="container no-result">
                <div class="alert alert-dark my-4 py-5" role="alert">
                    <h2 class="text-center py-3">No search found</h2>
                    Suggestions:
                    <ul>
                    <li>Make sure that all words are spelled correctly.</li>
                    <li>Try different keywords.</li>
                    <li>Try more general keywords.</li>
                    </ul>
                </div>
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

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>