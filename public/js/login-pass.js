let eye1 = document.getElementById("eye1");
let password1 = document.getElementById("password1");

eye1.onclick = function () {
    if (password1.type == "password") {
        password1.type = "text";
        this.classList.toggle("bi-eye");

    } else {
        password1.type = "password";
        this.classList.toggle("bi-eye");
    }
}