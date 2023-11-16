// const loginFormButton = document.getElementById('log-in-form-button');
// loginFormButton.addEventListener('click', method());

/**
 * Función para hacer peticiones al controller.
 * @param {string} url Ruta del controller al que se le hará la petición.
 * @param {string} method Metodo HTTP que se usará para la petición (generalmente POST).
 * @param {JSON.stringify} data Información que se enviará al servidor en un objeto literal convertido a string con JSON.stringify.
 * @returns Array con los datos de la respuesta del servidor {status: ..., message: ..., data: ...}
 */
async function fetchData(url, method, data) {
  const response = await fetch(url, {
    method,
    body: data,
  });

  return await response.json();
}

/**
 * Función para obtener los datos del formulario de registro de usuario.
 * @returns Objeto literal con un booleano que indica si los datos del formulario son válidos y un objeto FormData con los datos del formulario.
 */
function getFormData() {
  const customerForm = document.getElementById('form');
  const customerData = new FormData(customerForm);

  return { formData: customerData, isValid: validateFormData(customerData) };
}

/**
 * Función para validar los datos de un formulario.
 * @param {FormData} formData Objeto FormData con los datos de un formulario.
 * @returns Objeto literal con un booleano que indica si los datos del formulario son válidos.
 */
function validateFormData(formData) {
  let isValid = true;

  for (const [key, value] of formData.entries()) {
    isValid = validateInputData(key) && isValid;
  }

  return isValid;
}

/**
 * Función para validar los datos de un input.
 * @param {string} inputId Id del input que se quiere validar.
 * @returns True si el input es válido, false si no lo es.
 */
function validateInputData(inputId) {
  const input = document.getElementById(inputId);
  const invalidFeedback = input.nextElementSibling;
  if (
    input.value.trim() === '' ||
    (input.validity.typeMismatch === false) === false
  ) {
    input.classList.add('is-invalid');

    // activate the invalid feedback
    invalidFeedback.classList.remove('inactive');

    return false;
  } else {
    input.classList.remove('is-invalid');
    invalidFeedback.classList.add('inactive');
    return true;
  }
}

/**
 * Función para registrar un nuevo usuario.
 * @param {string} userType Tipo de usuario que se quiere registrar (customer o supplier).
 * @returns False si los datos del formulario no son válidos para evitar que se haga la petición al servidor.
 */
async function signUpCustomer(userType) {
  const { isValid, formData } = getFormData();
  if (!isValid) {
    return false;
  }

  const url = `./control/${userType}.control.php`;
  const method = 'POST';
  formData.set('action', 'create');

  try {
    const response = await fetchData(url, method, formData);
    if (response.status === 409) {
      showAlert('user-exists');
    }

    if (response.status === 201) {
      window.location = 'home';
    }
  } catch (error) {
    console.log(error);
  }
}

/**
 * Función para loguear un usuario.
 * @returns False si los datos del formulario no son válidos para evitar que se haga la petición al servidor.
 */
async function loginUser() {
  const { isValid, formData } = getFormData();
  if (!isValid) {
    return false;
  }

  const url = `./control/login.control.php`;
  const method = 'POST';
  formData.set('action', 'login');

  try {
    const response = await fetchData(url, method, formData);

    if (response.status === 401) {
      showAlert('wrong-user');
    } else if (response.status === 404) {
      showAlert('user-not-exists');
    }

    if (response.status === 200) {
      showAlert('welcome');
      setTimeout(() => {
        window.location = 'home';
      }, 1000);
    }
  } catch (error) {
    console.error(error);
  }
}
