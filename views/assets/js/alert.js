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
    'event updated': {
      message: 'Evento editado correctamente.',
      color: '#ADFFC7',
    },
    'something went wrong': {
      message: 'Algo salió mal.',
      color: '#F02D3A',
    },
    'service removed from event': {
      message: 'Servicio eliminado del evento.',
      color: '#ADFFC7',
    },
    'comment-exists': {
      message: 'Gracias por tu calificación y tu comentario',
      color: '#ADFFC7',
    },
    'comment-no-exists': {
      message: 'No se ha podido agregar tu calificación y comentario',
      color: '#F02D3A',
    },
    // transaction states
    'transaction approved': {
      message: 'Se ha realizado el pago correctamente.',
      color: '#ADFFC7',
    },
    'transaction rejected': {
      message: 'El pago ha sido rechazado.',
      color: '#F02D3A',
    },
    'transaction pending': {
      message: 'El pago está pendiente.',
      color: '#ADBDFF',
    },
    'transaction error': {
      message: 'Ha ocurrido un error al realizar el pago.',
      color: '#F02D3A',
    },
    'service created': {
      message: 'El servicio se ha creado correctamente.',
      color: '#ADFFC7',
    },
    'password changed': {
      message: 'Cambio de contraseña realizado.',
      color: '#ADFFC7',
    },
    'wrong verification code': {
      message: 'codigo incorrecto, Intentalo de nuevo.',
      color: '#F02D3A',
    },
    'password mismatch Validator': {
      message: 'Las contraseñas ingresadas no coinciden.',
      color: '#F02D3A',
    },
    'service deleted':{
      message: 'Servicio eliminado correctamente.',
      color: '#ADFFC7',
    },
    'service updated': {
      message: 'Servicio editado correctamente.',
      color: '#ADFFC7',
    }
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
