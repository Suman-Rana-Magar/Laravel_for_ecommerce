let eye2 = document.getElementById("eye2");
let password2 = document.getElementById("password2");

eye2.onclick = function () {
    if (password2.type == "password") {
        password2.type = "text";
        this.classList.toggle("bi-eye");

    } else {
        password2.type = "password";
        this.classList.toggle("bi-eye");
    }
}