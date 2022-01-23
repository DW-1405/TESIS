$(document).ready(function() {
    // limpiar();
    // function limpiar() {
    //     document.login.username.value = "";
    //     document.login.password.value = "";
    // }
    const user = document.querySelector("#name");
    const pass = document.querySelector("#password");

    $(user).blur(function(e) {
        e.preventDefault();
        if (user.value == "") {
            $("#user").removeClass("valid");
        } else {
            $("#user").addClass("valid");
        }
    });

    $(pass).blur(function(e) {
        e.preventDefault();
        if (pass.value == "") {
            $("#pass").removeClass("valid");
        } else {
            $("#pass").addClass("valid");
        }
    });
});
