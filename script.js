function TogglePasswordVisibility() {
    var x = document.getElementById("LoginPassword");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }