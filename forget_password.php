<?php
    include "connection.php"; 
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["send"])){
            $username=$_POST["username"];
            $email=$_POST["email"];   
            $password=$_POST["password"];  
            $c_password=$_POST["c_password"];   

            $in = "select * from `users` where `username` = '$username' && `email` = '$email'";
            $res=$conn->query($in);
            $row = mysqli_fetch_array($res);
            if ($res->num_rows==1) {
                if($password != $c_password){
                    echo '<script type="text/javascript"> window.onload = function(){
                            swal({
                                title: "The new password does not match!",
                                icon: "warning",
                                });
                            }
                        </script>';
                }else{
                    $sql2 = "UPDATE `users` SET `password`='$password' WHERE `username`='$username'";
                    $conn->query($sql2);
                    echo '<script type="text/javascript"> window.onload = function(){
                            swal({
                                title: "The password has been updated successfully!",
                                icon: "success",
                                });
                            }
                        </script>';
                    $username = "";
                    $email = "";
                    $password = "";
                    $c_password = "";
                }
                
            }else{
                echo '<script type="text/javascript"> window.onload = function(){
                                                        swal({
                                                            title: "Username or email is incorrect!",
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
<!--start forget_password section-->
<section class="register">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-12">
                <div class="image">
                    <img src="imgs/bg_main.jpg" alt="main_bg" class="img-fluid">
                    <div class="welcome">
                        <h2>Welcome to <span>smartbike</span></h2>
                        <p>Please enter your username and email for reset password.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-12">
                <div class="form">
                    <h1>smartbike</h1>
                    <p>Please enter your username and email for reset password</p>
                    <form method="POST" action="<?php echo($_SERVER['PHP_SELF']) ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" name="username" value="<?php if(isset($username)){echo $username;}else{echo "";} ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail2">Email</label>
                            <input type="email" name="email" value="<?php if(isset($email)){echo $email;}else{echo "";} ?>" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <label for="myPassword">New Password</label>
                            <input type="password" name="password" data-valid="not-valid" class="form-control" id="myPassword" required>
                            <i class="fas fa-eye show" data-class="myPassword"></i>
                            <i class="fas fa-eye-slash hide" data-class="myPassword"></i>
                        </div>
                        <div id="errors"></div>
                        <div class="form-group">
                            <label for="myConfirmPassword">Confirm new Password</label>
                            <input type="password" name="c_password" data-valid="not-valid" class="form-control" id="myConfirmPassword" required>
                            <i class="fas fa-eye show" data-class="myConfirmPassword"></i>
                            <i class="fas fa-eye-slash hide" data-class="myConfirmPassword"></i>
                        </div>
                        <button type="submit" name="send" id="send" class="btn btn-primary" disabled>Reset password</button>
                    </form>
                    <div class="links">
                        <a href="index.php">Login</a>
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
<!--end forget_password section-->


<script src="js/jquery-3.6.3.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/swiper-bundle.min.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="js/check_password_security.js"></script>

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

    /*TODO: call check password security */
    $("#myPassword").passwordValidation(
        { confirmField: "#myConfirmPassword" },
        function (element, valid, match, failedCases) {
            $("#errors").html("<pre>" + failedCases.join("\n") + "</pre>");
            if (valid){
                $(element).css("border", "2px solid green");
                $("#myPassword").attr("data-valid","valid");
            } 
            if (!valid){
                $(element).css("border", "2px solid red");
                $("#myPassword").attr("data-valid","not-valid");
            } 
            if (valid && match){
                $("#myConfirmPassword").css("border", "2px solid green");
                $("#myConfirmPassword").attr("data-valid","valid");
            }
            if (!valid || !match){
                $("#myConfirmPassword").css("border", "2px solid red");
                $("#myConfirmPassword").attr("data-valid","not-valid");
            }
        }
    );

    $("input").on("input",function(){
        if($("#myPassword").attr("data-valid") == "valid" && $("#myConfirmPassword").attr("data-valid") == "valid" ){
            $("#send").prop('disabled', false);
        }else{
            $("#send").prop('disabled', true);
        }
    });
</script>
<script src="js/app.js"></script>
</body>

</html>