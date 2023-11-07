function showAlertPassword() {
  var alert = document.getElementById("alert");
  var alertText = alert.querySelector("p");

  alertText.textContent = "Error: La contraseña no coincide.";

  alert.style.backgroundColor = "red";

  alert.style.display = "flex";
}

function closeAlert() {
  var alert = document.getElementById("alert");
  alert.style.display = "none";
}

function showAlertUser() {
  var alert = document.getElementById("alert");
  var alertText = alert.querySelector("p");

  alertText.textContent = "Advertencia: El usuario ya existe";

  alert.style.backgroundColor = "yellow";

  alert.style.display = "flex";
}

function showAlertWrongUser() {

  var alert = document.getElementById("alert");
  var alertText = alert.querySelector("p");

  alertText.textContent = "Error: Usuario incorrecto"

  alert.style.backgroundColor = "red";

  alert.style.display = "flex";
}

function showAlertWrongPassword() {

  var alert = document.getElementById("alert");
  var alertText = alert.querySelector("p");

  alertText.textContent = "Error: La contraseña es incorrecta"

  alert.style.backgroundColor = "red";

  alert.style.display = "flex";
}

