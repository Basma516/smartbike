<?php
    include "connection.php";
    session_start();

    /*user info */
    $user_info = "select * from `users` where `username` = '".$_SESSION["username"]."'";
    $info_res=$conn->query($user_info);
    $row = mysqli_fetch_array($info_res);

    /*update user_profile_info */
    if (isset($_POST['u_profile'])) {
        $id = $_POST['id'];

        if(isset($_POST['birthdate'])){
            $birthdate = $_POST['birthdate'];
        }else{
            $birthdate = "";
        }

        $phone = $_POST['phone'];

        if(isset($_POST['height'])){
            $height = $_POST['height'];
        }else{
            $height = "0";
        }

        if(isset($_POST['weight'])){
            $weight = $_POST['weight'];
        }else{
            $weight = "0";
        }

        if(isset($_POST['gender'])){
            $gender = $_POST['gender'];
        }else{
            $gender = "";
        }

        if($_FILES["image"]["size"]>0){
            if($_FILES["image"]["error"] == 4){
                echo
                "<script> alert('الصورة غير موجودة, من فضلك حاول مرة اخري'); </script>"
                ;
            }else{
                $fileName = $_FILES["image"]["name"];
                $fileSize = $_FILES["image"]["size"];
                $tmpName = $_FILES["image"]["tmp_name"];

                $validImageExtension = ['jpg', 'jpeg', 'png'];
                $imageExtension = explode('.', $fileName);
                $imageExtension = strtolower(end($imageExtension));

                if ( !in_array($imageExtension, $validImageExtension) ){
                    echo
                    "
                    <script>
                        alert('Invalid Image Extension');
                    </script>
                    ";
                }else{
                    $newImageName = uniqid();
                    $newImageName .= '.' . $imageExtension;

                    move_uploaded_file($tmpName, 'imgs/profile_imgs/' . $newImageName);
                }
            }
        }elseif(isset($_POST['current_image'])){
            $newImageName = $_POST['current_image'];
        }else{
            $newImageName = "avatar.png";
        }

        $old_image = $row["image"];
        $image_path = 'imgs/profile_imgs/'. $old_image;
        if (file_exists($image_path) && $old_image != "avatar.png") {
            unlink($image_path);
        }
        
        $sql2 = "UPDATE `users` SET `birthdate`='$birthdate', `phone`='$phone', `height`='$height', `weight`='$weight', `gender`='$gender', `image`='$newImageName' WHERE id=$id";
        $conn->query($sql2);
        echo '<script type="text/javascript"> window.onload = function(){
                swal({
                    title: "Your data updated successfully!",
                    icon: "success",
                    });
                }
            </script>';
    }

    /*Update user_password*/
    if (isset($_POST['u_password'])) {
        $id = $_POST['id'];
        $c_password = $_POST['c_password'];
        $n_password=$_POST["n_password"];
        $cn_password = $_POST['cn_password'];

        if($c_password != $row['password']){
            echo '<script type="text/javascript"> window.onload = function(){
                swal({
                    title: "Your password is incorrect!",
                    icon: "error",
                    });
                }
            </script>';
        }elseif($n_password != $cn_password){
            echo '<script type="text/javascript"> window.onload = function(){
                swal({
                    title: "The new password does not match!",
                    icon: "warning",
                    });
                }
            </script>';
        }else{
            $sql2 = "UPDATE `users` SET `password`='$n_password' WHERE id=$id";
            $conn->query($sql2);
            echo '<script type="text/javascript"> window.onload = function(){
                    swal({
                        title: "The password has been updated successfully!",
                        icon: "success",
                        });
                    }
                </script>';
            $c_password = '';
            $n_password = '';
            $cn_password = '';
        }
    }

    /*update user_email */
    if (isset($_POST['u_email'])) {
        $id = $_POST['id'];
        $c_password = $_POST['c_password'];
        $n_email = $_POST['n_email'];

        if($c_password != $row['password']){
            echo '<script type="text/javascript"> window.onload = function(){
                swal({
                    title: "Your password is incorrect!",
                    icon: "error",
                    });
                }
            </script>';
        }else{
            $sql2 = "UPDATE `users` SET `email`='$n_email' WHERE id=$id";
            $conn->query($sql2);
            echo '<script type="text/javascript"> window.onload = function(){
                    swal({
                        title: "The email has been updated successfully!",
                        icon: "success",
                        });
                    }
                </script>';
            $c_password = '';
            $n_email = '';
        }
    }

    /*delete user_account */
    if (isset($_POST['dlt_account'])) {
        $id = $_POST['id'];
        $c_password = $_POST['c_password'];

        if($c_password != $row['password']){
            echo '<script type="text/javascript"> window.onload = function(){
                swal({
                    title: "Your password is incorrect!",
                    icon: "error",
                    });
                }
            </script>';
        }else{
            $sql3 = "DELETE FROM users WHERE `id`=$id;
                set @autoid :=0; 
                update users set id = @autoid := (@autoid+1);
                alter table users Auto_Increment = 1;";
            $conn->multi_query($sql3);
            echo '<script type="text/javascript"> window.onload = function(){
                    swal({
                        title: "The account has been deleted successfully!",
                        icon: "success",
                        }).then(()=>{
                        location.href="index.php";
                        exit;
                    });
                    }
                </script>';
            $c_password = '';
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
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!--start navbar & sidebar section-->
    <?php include ('includes/menus.php'); ?>
    <!--end navbar & sidebar section-->

    <!--start profile_info section-->
    <section class="profile">
        <!--start welcome section-->
        <div class="welcome">
            <h2>My profile</h2>
        </div>
        <!--end welcome section-->
        <!--start profile_menu section-->
        <section class="profile_menu">
            <ul class="list-unstyled">
                <li class="my_profile" data-class=".my_profile">My profile</li>
                <li class="cng_password" data-class=".cng_password">Change password</li>
                <li class="cng_email" data-class=".cng_email">Change email</li>
                <li class="dlt_account" data-class=".dlt_account">Delete account</li>
            </ul>
        </section>
        <!--end profile_menu section-->
        <!--start info_sections section-->
        <!--start my_profile section-->
        <section class="info_sections my_profile">
            <form method="POST" action="<?php echo($_SERVER['PHP_SELF']) ?>" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="main_avatar">
                            <h5>Avatar</h5>
                            <div class="avatar">
                                <img src="imgs/profile_imgs/<?php echo $row['image'] ?>" id="imagePreview" alt="avatar" class="img-fluid">
                                <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" onchange="myAvatar()">
                                <label for="image"><i class="fa-solid fa-pencil"></i></label>
                                <input type="hidden" name="current_image" value="<?php echo $row['image'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <div class="main_details">
                            <h5>Profile details</h5>
                            <div class="form-group">
                                <label for="exampleInput1">Username</label>
                                <input type="text" value="<?php echo $row['username'] ?>" class="form-control" id="exampleInput1" required disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInput2">Birthdate</label>
                                <input type="date" name="birthdate" value="<?php echo $row['birthdate'] ?>" class="form-control" id="exampleInput2">
                            </div>
                            <div class="form-group">
                                <label for="exampleInput3">Phone</label>
                                <input type="text" name="phone" maxlength="11" value="<?php echo $row['phone'] ?>" class="form-control" id="exampleInput3" required>
                            </div>
                            <div class="form-group hw">
                                <h6>Height</h6>
                                <input type="range" name="height" min="0" max="250" value="<?php echo $row['height'] ?>" data-measurment="cm" data-class=".heightRange">
                                <span class="heightRange"></span>
                            </div>
                            <div class="form-group hw">
                                <h6>Weight</h6>
                                <input type="range" name="weight" min="0" max="250" value="<?php echo $row['weight'] ?>" data-measurment="kg" data-class=".weightRange">
                                <span class="weightRange"></span>
                            </div>
                            <div class="form-group gender">
                                <h6>Gender</h6>
                                <ul class="list-unstyled">
                                    <li class="male" data-class="male">Male</li>
                                    <li class="female" data-class="female">Female</li>
                                </ul>  
                                <input type="hidden" name="gender" id="gender" value="<?php echo $row['gender'] ?>">
                            </div>
                            <button type="submit" name="u_profile" class="btn btn-info">Update profile</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <!--end my_profile section-->
        <!--start cng_password section-->
        <section class="info_sections cng_password">
            <form method="POST" action="<?php echo($_SERVER['PHP_SELF']) ?>">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <h5>Change password</h5>
                <div class="form-group">
                    <label for="exampleInputPassword1">Current password</label>
                    <input type="password" name="c_password" value="<?php if(isset($c_password)){echo $c_password;}else{echo "";} ?>" class="form-control" id="exampleInputPassword1" required>
                    <i class="fas fa-eye show" data-class="exampleInputPassword1"></i>
                    <i class="fas fa-eye-slash hide" data-class="exampleInputPassword1"></i>
                </div>
                <div class="form-group">
                    <label for="myPassword">New password</label>
                    <input type="password" name="n_password" data-valid="not-valid" class="form-control" id="myPassword" required>
                    <i class="fas fa-eye show" data-class="myPassword"></i>
                    <i class="fas fa-eye-slash hide" data-class="myPassword"></i>
                </div>
                <div id="errors"></div>
                <div class="form-group">
                    <label for="myConfirmPassword">Confirm new password</label>
                    <input type="password" name="cn_password" data-valid="not-valid" class="form-control" id="myConfirmPassword" required>
                    <i class="fas fa-eye show" data-class="myConfirmPassword"></i>
                    <i class="fas fa-eye-slash hide" data-class="myConfirmPassword"></i>
                </div>
                <button type="submit" name="u_password" id="send" class="btn btn-info" disabled>Update password</button>
            </form>
        </section>
        <!--end cng_password section-->
        <!--start cng_email section-->
        <section class="info_sections cng_email">
            <form method="POST" action="<?php echo($_SERVER['PHP_SELF']) ?>">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <h5>Change email</h5>
                <div class="form-group">
                    <label>Current email</label>
                    <input type="email" value="<?php echo $row['email'] ?>" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword2">Current password</label>
                    <input type="password" name="c_password" value="<?php if(isset($c_password)){echo $c_password;}else{echo "";} ?>" class="form-control" id="exampleInputPassword4" required>
                    <i class="fas fa-eye show" data-class="exampleInputPassword4"></i>
                    <i class="fas fa-eye-slash hide" data-class="exampleInputPassword4"></i>
                </div>
                <div class="form-group">
                    <label>New email</label>
                    <input type="email" name="n_email" value="<?php if(isset($n_email)){echo $n_email;}else{echo "";} ?>" class="form-control" id="" required>
                </div>
                <button type="submit" name="u_email" class="btn btn-info">Update email</button>
            </form>
        </section>
        <!--end cng_email section-->
        <!--start dlt_account section-->
        <section class="info_sections dlt_account">
            <form method="POST" action="<?php echo($_SERVER['PHP_SELF']) ?>">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <h5>Delete account</h5>
                <p>You will no longer have access to the data.</p>
                <div class="form-group">
                    <label for="exampleInputPassword5">Current password</label>
                    <input type="password" name="c_password" value="<?php if(isset($c_password)){echo $c_password;}else{echo "";} ?>" class="form-control" id="exampleInputPassword5" required>
                    <i class="fas fa-eye show" data-class="exampleInputPassword5"></i>
                    <i class="fas fa-eye-slash hide" data-class="exampleInputPassword5"></i>
                </div>
                <button type="submit" name="dlt_account" class="btn btn-danger">Delete your account</button>
            </form>
        </section>
        <!--end dlt_account section-->
        <!--end info_sections section-->
        <!--strat footer section-->
            <p class="footer">Smartbike system &copy; 2022</p>
        <!--end footer section-->
    </section>
    <!--end profile_info section-->

<script src="js/jquery-3.6.3.min.js"></script>

<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/sweetalert.min.js"></script>

<script src="js/check_password_security.js"></script>

<script src="https://kit.fontawesome.com/cbef0f2c90.js" crossorigin="anonymous"></script>
<script>
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