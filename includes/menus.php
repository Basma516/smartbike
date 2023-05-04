<?php
    include "connection.php";

    /*user info */
    $user_info = "select * from `users` where `username` = '".$_SESSION["username"]."'";
    $info_res=$conn->query($user_info);
    $row = mysqli_fetch_array($info_res);
?>
<!--start navbar section-->
<section class="navbar">
    <div class="collapse_btn d-block d-lg-none">
        <img src="imgs/menu_btn.png" width="30" height="30" alt="menu_btn" class="img-fluid">
    </div>
    <h2>smartbike</h2>
    <div class="profile_info">
        <h6 class="d-none d-md-block"><?php echo $row['username'] ?></h6>
        <img src="imgs/profile_imgs/<?php echo $row['image'] ?>" alt="avatar" class="img-fluid">

        <div class="profile_info_menu">
            <ul class="list-unstyled">
                <a href="profile_info.php">
                    <li data-class=".my_profile">My profile</li>
                </a>
                <a href="profile_info.php">
                    <li data-class=".cng_password">Change password</li>
                </a>
                <a href="profile_info.php">
                    <li data-class=".cng_email">Change email</li>
                </a>
                <li class="dark_mode">
                    <div class="main_dark_mode">
                        <input type="checkbox" class="checkbox" id="dark_checkbox">
                        <label for="dark_checkbox" class="label">
                            <i class="fas fa-moon"></i>
                            <i class='fas fa-sun'></i>
                            <div class='ball'></div>
                        </label>
                        <p id="dark_paragraph">Light mode</p>
                    </div>
                </li>
                <a href="logout.php">
                    <li>Log out</li>
                </a>
            </ul>
        </div>
    </div>
</section>
<!--end navbar section-->
<!--start side_menu section-->
<section class="side_menu">
        <ul class="list-unstyled">
            <a href="profile.php">
                <li class="active">
                    <i class="fa-solid fa-gauge"></i>
                    <h6>dashboard</h6>
                </li>
            </a>
            <a href="#">
                <li>
                    <i class="fa-solid fa-map-location-dot"></i>
                    <h6>Activites</h6>
                </li>
            </a>
            <a href="#">
                <li>
                    <i class="fa-solid fa-person-biking"></i>
                    <h6>My Bikes</h6>
                </li>
            </a>
            <a href="#">
                <li>
                    <i class="fa-solid fa-lightbulb"></i>
                    <h6>Help</h6>
                </li>
            </a>
        </ul>
    </section>
    <!--end side_menu section-->
