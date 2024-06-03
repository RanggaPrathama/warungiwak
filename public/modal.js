// Get the modals
var loginModal = document.getElementById("loginModal");
var registerModal = document.getElementById("registerModal");

// Get the buttons that open the modals
var registerLink = document.getElementById("registerLink");
var registerLinkFromLogin = document.getElementById("registerLinkFromLogin");
var loginLinkFromRegister = document.getElementById("loginLinkFromRegister");

// Get the <span> elements that close the modals
var spans = document.getElementsByClassName("close");

// When the user clicks the "Register" link, open the login modal
registerLink.onclick = function() {
    loginModal.style.display = "block";
}

// When the user clicks the "Don't have an account? Register" link, open the register modal
registerLinkFromLogin.onclick = function() {
    loginModal.style.display = "none";
    registerModal.style.display = "block";
}

// When the user clicks the "Already have an account? Login" link, open the login modal
loginLinkFromRegister.onclick = function() {
    registerModal.style.display = "none";
    loginModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
for (var i = 0; i < spans.length; i++) {
    spans[i].onclick = function() {
        loginModal.style.display = "none";
        registerModal.style.display = "none";
    }
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == loginModal) {
        loginModal.style.display = "none";
    }
    if (event.target == registerModal) {
        registerModal.style.display = "none";
    }
}
