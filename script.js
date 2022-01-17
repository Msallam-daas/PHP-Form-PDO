document.getElementById("RegisterForm").addEventListener("submit", (event) => {
  let passsword = document.getElementById("pass");
  let confirmPassword = document.getElementById("confirmPass");
  let Error = document.getElementById("ErrMsg");
  if (passsword.value.length < 6) {
    event.preventDefault();
    Error.innerHTML = "Passwords at least 6 characters ";
  }
  if (passsword.value.length != confirmPassword.value.length) {
    event.preventDefault();
    Error.innerHTML += "<br> passwords do not match!";
  }
});
