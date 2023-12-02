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
    'user-created': {
      message: 'Usuario creado correctamente.',
      color: '#ADFFC7',
    },
    'favorite-added': {
      message: 'Servicio agregado a favoritos.',
      color: '#ADFFC7',
    },
    'supplier-created': {
      message: 'Proveedor creado correctamente.',
      color: '#ADFFC7',
    },
    'favorite-exists': {
      message: 'El servicio ya existe en favoritos.',
      color: '#ADBDFF',
    },
    'favorite-error': {
      message: 'Error al agregar servicio a favoritos.',
      color: '#F02D3A',
    },
    'favorite-removed': {
      message: 'Servicio eliminado de favoritos.',
      color: '#ADFFC7',
    },
    'Without logging in': {
      message: 'Por favor inicie sesión o cree una cuenta.',
      color: '#F02D3A',
    },
    'event created successfully': {
      message: 'Evento creado correctamente.',
      color: '#ADFFC7',
    },
    'service added to event': {
      message: 'Servicio agregado al evento.',
      color: '#ADFFC7',
    },
    'service not added to event': {
      message: 'Error al agregar servicio al evento.',
      color: '#F02D3A',
    },
    'service has already been added to the event': {
      message: 'El servicio ya ha sido agregado al evento.',
      color: '#ADBDFF',
    },
    'event deleted': {
      message: 'Evento eliminado correctamente.',
      color: '#ADFFC7',
    },
    'something went wrong': {
      message: 'Algo salió mal.',
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
