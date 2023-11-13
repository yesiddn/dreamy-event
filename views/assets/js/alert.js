function showAlert(typeAlert) {
  const alerts = {
    'user-exists': {
      message: 'El usuario ya existe.',
      color: '#ADBDFF',
    },
    'user-not-exists': {
      message: 'El usuario no existe.',
      color: '#F02D3A',
    },
    'wrong-user': {
      message: 'Usuario o contraseña incorrecto.',
      color: '#F02D3A',
    },
    welcome: {
      message: 'Bienvenido a la plataforma.',
      // color verde claro hexadecimal
      color: '#ADFFC7',
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