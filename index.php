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
    <title>Welcome to iCode- Home</title>
</head>

<body>
    <!-- Navebar header -->
    <?php include 'partials/_header.php'; ?>


    <!-- Slider  -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/s1.jpg" width="1600" height="500" class="d-block w-100" alt="slider-1.jpg">
            </div>
            <div class="carousel-item">
                <img src="images/s2.jpg" width="1600" height="500" class="d-block w-100" alt="slider-1.jpg">
            </div>
            <div class="carousel-item">
                <img src="images/s3.jpg" width="1600" height="500" class="d-block w-100" alt="slider-1.jpg">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>



    <!-- Category start here- Display from Database-->

    <div class="container">
        <h2 class="text-center my-4">iCode -Browse Categories</h2>
        <div class="row">
            <?php
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn , $sql);
            while($row = mysqli_fetch_assoc($result)){
                $catid = $row['category_id'];
            echo '<div class="col-md-4 my-3">
                    <div class="card" style="width: 18rem;">
                        <img src="images/card-'. $catid .'.jpg" width="288" height="228.8" class="card-img-top" alt="card-img">
                        <div class="card-body">
                            <h5 class="card-title"><a href="threadlist.php?catid=' . $catid . ' ">' . $row['category_name'] .'</a></h5>
                            <p class="card-text">'.substr($row['category_description'],0,110) .'...</p>
                            <a href="threadlist.php?catid='. $catid .'" class="btn btn-primary category-btn ">View Thread</a>
                        </div>
                    </div>
                </div>';
            }
        ?>
        </div>
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