/*TODO: show and hide side_menu in dashboard */
$(".collapse_btn").on("click", function () {
    $(".side_menu").toggleClass("show");
});

$(".side_menu a li").on("click", function () {
    $(".side_menu a li").removeClass("active");
    $(this).addClass("active");
});

/*TODO: menu_stat section */
$(".main_stat").hide();
$($(".stat .menu a.active").attr("data-class")).fadeIn();

$(".stat .menu a").on("click", function () {
    $(".stat .menu a").removeClass("active");
    $(this).addClass("active");
    $(".main_stat").hide();
    $($(".stat .menu a.active").attr("data-class")).fadeIn();
});

/*TODO: show profile_info_menu */
$(".profile_info").on("click", function () {
    $(".profile_info_menu").toggleClass("show");
});

$(".profile").on("click", function () {
    $(".profile_info_menu").removeClass("show");
});

$(".profile_info_menu ul a li").on("click", function () {
    localStorage.setItem("profile_menu_active", $(this).attr("data-class"));
});

/*TODO: profile_info menu */
localStorage.getItem("profile_menu_active");
if (localStorage.getItem("profile_menu_active") == "") {
    localStorage.setItem("profile_menu_active", ".my_profile");
}
$(localStorage.getItem("profile_menu_active")).addClass("active");

$(".info_sections").hide();
$($(".profile_menu ul li.active").attr("data-class")).fadeIn();

$(".profile_menu ul li").on("click", function () {
    $(this).addClass("active").siblings().removeClass("active");
    $(".info_sections").hide();
    $($(".profile_menu ul li.active").attr("data-class")).fadeIn();
    localStorage.setItem("profile_menu_active", $(this).attr("data-class"));
});

/*TODO: height & weight range  */
$('input[type="range"]').each(function() {
    $($(this).attr("data-class")).text($(this).val() + $(this).attr("data-measurment"));
});
    
$('input[type="range"]').on("input", function () {
    $($(this).attr("data-class")).text($(this).val() + $(this).attr("data-measurment"));
});

/*TODO: profile gender */
$(".my_profile .gender ul li").on("click", function () {
    $(this).addClass("active").siblings().removeClass("active");
    $("#gender").val($(this).attr("data-class"));
});
if ($("#gender").val() != "") {
    $("." + $("#gender").val()).addClass("active");
} 

/*TODO: profile image */
function myAvatar() {
    const file = document.querySelector("#image").files[0];
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function () {
        localStorage.setItem("image", reader.result);
        document
        .getElementById("imagePreview")
        .setAttribute("src", localStorage.getItem("image"));
    };
}

/*TODO: show & hide password */
let showBtn = document.querySelectorAll(".show"),
hideBtn = document.querySelectorAll(".hide");

showBtn.forEach((ele) => {
ele.onclick = function () {
    document.getElementById(this.dataset.class).setAttribute("type", "text");
    this.setAttribute("style", "display:none");
    this.nextElementSibling.setAttribute("style", "display:block");
};
});

hideBtn.forEach((ele) => {
ele.onclick = function () {
    document
    .getElementById(this.dataset.class)
    .setAttribute("type", "password");
    this.setAttribute("style", "display:none");
    this.previousElementSibling.setAttribute("style", "display:block");
};
});

/*TODO: dark mode */
const checkbox = document.getElementById("dark_checkbox");

let lightMode = localStorage.getItem("light");

const enableLight = () => {
    document.body.classList.add("light");
    document.getElementById("dark_checkbox").checked = true;
    document.getElementById("dark_paragraph").innerHTML = "Dark mode";
    localStorage.setItem("light", "enabled");
};

const disableLight = () => {
    document.body.classList.remove("light");
    document.getElementById("dark_checkbox").checked = false;
    document.getElementById("dark_paragraph").innerHTML = "Light mode";
    localStorage.setItem("light", "disabled");
};

if (lightMode == "enabled") {
    enableLight();
}

checkbox.addEventListener("change", () => {
    document.body.classList.toggle("light");

    lightMode = localStorage.getItem("light");

    if (lightMode !== "enabled") {
    enableLight();
    } else {
    disableLight();
    }
});