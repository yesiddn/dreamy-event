// const loginFormButton = document.getElementById('log-in-form-button');
// loginFormButton.addEventListener('click', method());

var tabla = null;
ShowServices(); 

ShowServices();
async function fetchData(url, method, data) {
  const response = await fetch(url, {
    method,
    body: data,
  });

  return await response.json();
}

function getFormData() {
  const customerForm = document.getElementById('form');
  const customerData = new FormData(customerForm);

  return validateFormData(customerData);
}

function validateFormData(formData) {
  let isValid = true;

  for (const [key, value] of formData.entries()) {
    isValid = validateInputData(key) && isValid;
  }

  return { isValid, formData };
}

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
      localStorage.setItem('customer', JSON.stringify(response.data));

      showAlert('user-created');
      setTimeout(() => {
        window.location = 'home';
      }, 1000);
    }
  } catch (error) {
    console.log(error);
  }
}

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
      localStorage.setItem('customer', JSON.stringify(response.data));

      showAlert('welcome');
      setTimeout(() => {
        window.location = 'home';
      }, 1000);
    }
  } catch (error) {
    console.error(error);
  }
}





function ShowServices() {

  // se crea la peticion para consultar la informacion
  var objData = new FormData();
  objData.append("ShowServices", "OK");

  fetch('../../control/info-service.control.php', {
      method: 'POST',
      body: objData
      // este es para capturar el error
  }).then(response => response.json()).catch(error => {
      console.log('error: ', error);
      // este  captura la respuesta si es positiva
  }).then(response => {
      NameService(response)
  });

}


function NameService(response) {
  
}