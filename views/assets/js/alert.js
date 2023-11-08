function showAlert(typeAlert) {
  const alerts = {
    'user-exists': {
      message: 'El usuario ya existe.',
      color: '#ADBDFF',
    },
    'wrong-user': {
      message: 'Usuario o contraseña incorrecto.',
      color: '#F02D3A',
    },
  };

  let alert = document.getElementById('alert');
  let alertText = alert.querySelector('#alert p');

  alertText.textContent = alerts[typeAlert].message;
  alert.style.backgroundColor = alerts[typeAlert].color;
  alert.style.display = 'flex';
}

function closeAlert() {
  let alert = document.getElementById('alert');
  alert.style.display = 'none';
}