let eye3 = document.getElementById("eye3");
let password3 = document.getElementById("password3");

eye3.onclick = function () {
    if (password3.type == "password") {
        password3.type = "text";
        this.classList.toggle("bi-eye");

    } else {
        password3.type = "password";
        this.classList.toggle("bi-eye");
    }
}