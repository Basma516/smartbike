<?php
include "connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["send"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        session_start();
        $in = "select * from `users` where `username` = '$username' COLLATE utf8mb4_bin && `password` = '$password' COLLATE utf8mb4_bin";
        $res = $conn->query($in);
        $row = mysqli_fetch_array($res);
        if ($res->num_rows == 1) {
            header("Location: profile.php");
            $_SESSION["username"] = $row["username"];
        } else {
            echo '<script type="text/javascript"> window.onload = function(){
                                                        swal({
                                                            title: "Username or password is incorrect!",
                                                            text: "Please try again",
                                                            icon: "error",
                                                            });
                                                        }
                    </script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>smart bike</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!--start main section-->
    <section class="main_swiper">
        <!-- start swiper section-->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="imgs/bg_1.jpg" alt="bg_1" />
                </div>
                <div class="swiper-slide">
                    <img src="imgs/bg_2.jpg" alt="bg_2" />
                </div>
                <div class="swiper-slide">
                    <img src="imgs/bg_3.jpg" alt="bg_3" />
                </div>
                <div class="swiper-slide">
                    <img src="imgs/bg_4.jpg" alt="bg_4" />
                </div>
                <div class="swiper-slide">
                    <img src="imgs/bg_5.jpg" alt="bg_5" />
                </div>
            </div>
        </div>
        <!-- end swiper section-->

    </section>
    <!--end main section-->
    <!--start login section-->
    <section class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12">
                    <div class="image">
                        <img src="imgs/bg_main.jpg" alt="main_bg" class="img-fluid">
                        <div class="welcome">
                            <h2>Welcome to <span>smartbike</span></h2>
                            <p>Please enter your account info for login.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-12">
                    <div class="form">
                        <h1>smartbike</h1>
                        <p>Please enter your account info for login.</p>
                        <form method="POST" action="<?php echo ($_SERVER['PHP_SELF']) ?>">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" name="username" value="<?php if (isset($username)) {
                                                                                echo $username;
                                                                            } else {
                                                                                echo "";
                                                                            } ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" value="<?php if (isset($password)) {
                                                                                    echo $password;
                                                                                } else {
                                                                                    echo "";
                                                                                } ?>" class="form-control" id="exampleInputPassword1" required>
                                <i class="fas fa-eye show" data-class="exampleInputPassword1"></i>
                                <i class="fas fa-eye-slash hide" data-class="exampleInputPassword1"></i>
                            </div>
                            <button type="submit" name="send" class="btn btn-primary">Sign in</button>
                        </form>
                        <div class="links">
                            <a href="forget_password.php">Forgot Password?</a>
                            <span>.</span>
                            <a href="register.php">Create an account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--strat footer section-->
        <p class="footer">Smartbike system &copy; 2022</p>
        <!--end footer section-->
    </section>
    <!--end login section-->


    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/sweetalert.min.js"></script>

    <script src="https://kit.fontawesome.com/cbef0f2c90.js" crossorigin="anonymous"></script>
    <script>
        /*TODO: main_swiper */
        let swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            effect: "fade",
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            loop: "true",
        });
    </script>
    <script src="js/app.js"></script>
</body>

</html>