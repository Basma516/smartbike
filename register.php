<?php
    include "connection.php";
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        if(isset($_POST["send"])){
            $username=$_POST["username"];
            $email=$_POST["email"];
            $phone=$_POST["phone"];
            $password=$_POST["password"];
            $cpassword=$_POST["cpassword"];
            
            $in = "select * from users where username = '$username'";
        }
        $res=$conn->query($in);

        if($res->num_rows==1){
            echo '<script type="text/javascript"> window.onload = function(){
                    swal({
                        title: "Username has already been used!",
                        text: "please enter a new username",
                        icon: "warning",
                        });
                    }
                </script>';
        }elseif($password != $cpassword){
            echo '<script type="text/javascript"> window.onload = function(){
                    swal({
                        title: "The password does not match!",
                        icon: "warning",
                        });
                    }
                </script>';
        }else{
            $log="insert into users(username,email,phone,password,birthdate,height,weight,gender,image) values('$username','$email','$phone','$password','','0','0','','avatar.png');
                set @autoid :=0; 
                update users set id = @autoid := (@autoid+1);
                alter table users Auto_Increment = 1;";
            $conn->multi_query($log);
            
            echo '<script type="text/javascript"> window.onload = function(){
                    swal({
                        title: "Your account has been successfully created!",
                        text: "You can now login",
                        icon: "success",
                        }).then(()=>{
                            location.href="index.php";
                            exit;
                        });
                    }
                    </script>';  
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
    <section class="register">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12">
                    <div class="image">
                        <img src="imgs/bg_main.jpg" alt="main_bg" class="img-fluid">
                        <div class="welcome">
                            <h2>Welcome to <span>smartbike</span></h2>
                            <p>Please enter your account info for Register.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-12">
                    <div class="form">
                        <h1>smartbike</h1>
                        <p>Please enter your account info for Register.</p>
                        <form method="POST" action="<?php echo($_SERVER['PHP_SELF']) ?>">
                            <div class="form-group">
                                <label for="myUsername">Username</label>
                                <input type="text" name="username" data-valid="not-valid" class="form-control" id="myUsername" required>
                            </div>
                            <div id="username_error"></div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" value="<?php if(isset($email)){echo $email;}else{echo "";} ?>" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone Number</label>
                                <input type="tel" name="phone" value="<?php if(isset($phone)){echo $phone;}else{echo "";} ?>" maxlength="11" class="form-control" id="exampleInputTel1" required>
                            </div>
                            <div class="form-group">
                                <label for="myPassword">Password</label>
                                <input type="password" name="password" data-valid="not-valid" class="form-control" id="myPassword" required>
                                <i class="fas fa-eye show" data-class="myPassword"></i>
                                <i class="fas fa-eye-slash hide" data-class="myPassword"></i>
                            </div>
                            <div id="errors"></div>
                            <div class="form-group">
                                <label for="myConfirmPassword">Confirm Password</label>
                                <input type="password" name="cpassword" data-valid="not-valid" class="form-control" id="myConfirmPassword" required>
                                <i class="fas fa-eye show" data-class="myConfirmPassword"></i>
                                <i class="fas fa-eye-slash hide" data-class="myConfirmPassword"></i>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                <label class="form-check-label" for="exampleCheck1">I declare that I'm 16 years old or older</label>
                            </div>
                            <button type="submit" name="send" id="send" class="btn btn-primary" disabled >Register</button>
                        </form>
                        <div class="links">
                            <a href="index.php">Sign in</a>
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
    /*TODO: username validation */
    $("#myUsername").usernameValidation(
        function (element, valid, match, failedCases) {
            $("#username_error").html("<pre>" + failedCases.join("\n") + "</pre>");
            if (valid){
                $(element).css("border", "2px solid green");
                $("#myUsername").attr("data-valid","valid");
            } 
            if (!valid){
                $(element).css("border", "2px solid red");
                $("#myUsername").attr("data-valid","not-valid");
            } 
        }
    );
    $("#myUsername").on({
        keydown: function(e) {
            if (e.which === 32)
            return false;
        },
        change: function() {
            this.value = this.value.replace(/\s/g, "");
        }
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
        if($("#myUsername").attr("data-valid") == "valid" && $("#myPassword").attr("data-valid") == "valid" && $("#myConfirmPassword").attr("data-valid") == "valid" ){
            $("#send").prop('disabled', false);
        }else{
            $("#send").prop('disabled', true);
        }
    });
</script>
    <script src="js/app.js"></script>
</body>

</html>