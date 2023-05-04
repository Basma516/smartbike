<?php
    include "connection.php";
    session_start();

    /*user info */
    $user_info = "select * from `users` where `username` = '".$_SESSION["username"]."'";
    $info_res=$conn->query($user_info);
    $row = mysqli_fetch_array($info_res);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>smart bike</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!--start navbar & sidebar section-->
    <?php include ('includes/menus.php'); ?>
    <!--end navbar & sidebar section-->

    <!--start dashboard section-->
    <section class="profile">
        <!--start welcome section-->
        <div class="welcome">
            <h2>Hello <?php echo $row['username'] ?></h2>
        </div>
        <!--end welcome section-->
        <!--start stat section-->
        <section class="stat">
            <!--start menu section-->
            <div class="menu">
                <div class="row text-center">
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <a href="#">
                            <i class="fa-solid fa-map-location-dot"></i>
                            <h6>Activites</h6>
                            <span>0</span>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <a href="#main_stat1" class="active" data-class=".time">
                            <i class="fa-solid fa-stopwatch"></i>
                            <h6>Ride Time</h6>
                            <span>0 s</span>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <a href="#main_stat2" data-class=".distance">
                            <i class="fa-solid fa-map"></i>
                            <h6>Ride Distance</h6>
                            <span>0 Km</span>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <a href="#main_stat3" data-class=".ascent">
                            <i class="fa-solid fa-chart-line"></i>
                            <h6>Total ascent</h6>
                            <span>0 m</span>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <a href="#main_stat4" data-class=".descent">
                            <i class="fa-solid fa-chart-line rotate"></i>
                            <h6>Total descent</h6>
                            <span>0 m</span>
                        </a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <a href="#main_stat5" data-class=".calories">
                            <i class="fa-solid fa-apple-whole"></i>
                            <h6>Total calories</h6>
                            <span>0 cal</span>
                        </a>
                    </div>
                </div>
            </div>
            <!--end menu section-->
            <!--start main_stat sections-->
            <!--start sction1-->
            <div class="main_stat time" id="main_stat1">
                <div class="row text-center">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <h5>Ride Time</h5>
                        <div class="total">
                            <h6>Just you</h6>
                            <span>0 s</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="level-1">
                            <h5>Level 1</h5>
                            <img src="imgs/level-1.png" width="70" height="70" alt="level-1" class="img-fluid">
                            <h6>Ride time</h6>
                            <span>0 s</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="level-2">
                            <h5>Level 2</h5>
                            <img src="imgs/level-2.png" width="70" height="70" alt="level-2" class="img-fluid">
                            <h6>Ride time</h6>
                            <span>0 s</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="level-3">
                            <h5>Level 3</h5>
                            <img src="imgs/level-3.png" width="70" height="70" alt="level-3" class="img-fluid">
                            <h6>Ride time</h6>
                            <span>0 s</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--end section1-->
            <!--start sction2-->
            <div class="main_stat distance" id="main_stat2">
                <div class="row text-center">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <h5>Ride Distance</h5>
                        <div class="total">
                            <h6>Just you</h6>
                            <span>0 Km</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="level-1">
                            <h5>Level 1</h5>
                            <img src="imgs/level-1.png" width="70" height="70" alt="level-1" class="img-fluid">
                            <h6>Ride distance</h6>
                            <span>0 Km</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="level-2">
                            <h5>Level 2</h5>
                            <img src="imgs/level-2.png" width="70" height="70" alt="level-2" class="img-fluid">
                            <h6>Ride distance</h6>
                            <span>0 Km</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="level-3">
                            <h5>Level 3</h5>
                            <img src="imgs/level-3.png" width="70" height="70" alt="level-3" class="img-fluid">
                            <h6>Ride distance</h6>
                            <span>0 Km</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--end section2-->
            <!--start sction3-->
            <div class="main_stat ascent" id="main_stat3">
                <div class="row text-center">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <h5>Total Ascent</h5>
                        <div class="total">
                            <h6>Just you</h6>
                            <span>0 m</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="level-1">
                            <h5>Level 1</h5>
                            <img src="imgs/level-1.png" width="70" height="70" alt="level-1" class="img-fluid">
                            <h6>Total ascent</h6>
                            <span>0 m</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="level-2">
                            <h5>Level 2</h5>
                            <img src="imgs/level-2.png" width="70" height="70" alt="level-2" class="img-fluid">
                            <h6>Total ascent</h6>
                            <span>0 m</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="level-3">
                            <h5>Level 3</h5>
                            <img src="imgs/level-3.png" width="70" height="70" alt="level-3" class="img-fluid">
                            <h6>Total ascent</h6>
                            <span>0 m</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--end section3-->
            <!--start sction4-->
            <div class="main_stat descent" id="main_stat4">
                <div class="row text-center">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <h5>Total Descent</h5>
                        <div class="total">
                            <h6>Just you</h6>
                            <span>0 m</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="level-1">
                            <h5>Level 1</h5>
                            <img src="imgs/level-1.png" width="70" height="70" alt="level-1" class="img-fluid">
                            <h6>Total descent</h6>
                            <span>0 m</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="level-2">
                            <h5>Level 2</h5>
                            <img src="imgs/level-2.png" width="70" height="70" alt="level-2" class="img-fluid">
                            <h6>Total descent</h6>
                            <span>0 m</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="level-3">
                            <h5>Level 3</h5>
                            <img src="imgs/level-3.png" width="70" height="70" alt="level-3" class="img-fluid">
                            <h6>Total descent</h6>
                            <span>0 m</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--end section4-->
            <!--start sction5-->
            <div class="main_stat calories" id="main_stat5">
                <div class="row text-center">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <h5>Total Calories</h5>
                        <div class="total">
                            <h6>Just you</h6>
                            <span>0 cal</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="level-1">
                            <h5>Level 1</h5>
                            <img src="imgs/level-1.png" width="70" height="70" alt="level-1" class="img-fluid">
                            <h6>Total calories</h6>
                            <span>0 cal</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="level-2">
                            <h5>Level 2</h5>
                            <img src="imgs/level-2.png" width="70" height="70" alt="level-2" class="img-fluid">
                            <h6>Total calories</h6>
                            <span>0 cal</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="level-3">
                            <h5>Level 3</h5>
                            <img src="imgs/level-3.png" width="70" height="70" alt="level-3" class="img-fluid">
                            <h6>Total calories</h6>
                            <span>0 cal</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--end section5-->
            <!--end main_stat sections-->
        </section>
        <!--end stat section-->
        <!--start mine section-->
        <section class="mine">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <h5>My eBikes</h5>
                    <div class="mybikes">
                        <h6>No eBikes found.</h6>
                    </div>
                </div>
                <div class="col-lg-6 col-md-8 col-sm-6">
                    <h5>My last activities</h5>
                    <div class="myactivities">
                        <h6>No activities found.</h6>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <h5>Last location</h5>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3438.946638769978!2d31.184963085060655!3d30.46594948173091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14f7df5765eddc2f%3A0x5ccbd9b79314b7ec!2z2YPZhNmK2Kkg2KfZhNmH2YbYr9iz2Kkg2KzYp9mF2LnYqSDYqNmG2YfYpyDYqNio2YbZh9in!5e0!3m2!1sar!2seg!4v1670957215532!5m2!1sar!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>
        <!--end mine section-->
        <!--strat footer section-->
            <p class="footer">Smartbike system &copy; 2022</p>
        <!--end footer section-->
    </section>
    <!--end dashboard section-->

<script src="js/jquery-3.6.3.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/sweetalert.min.js"></script>

<script src="https://kit.fontawesome.com/cbef0f2c90.js" crossorigin="anonymous"></script>
<script src="js/app.js"></script>
</body>

</html>