const customerFormButton = document.getElementById('customer-form-button');
const supplierFormButton = document.getElementById('supplier-form-button');

customerFormButton.addEventListener('click', createUser('customer'));
supplierFormButton.addEventListener('click', createSupplier('supplier'));

async function fetchData(url, method, data) {
  const response = await fetch(url, {
    method,
    body: data,
  });

  return await response.json();
}

function getFormData() {
  const customerForm = document.getElementById('sign-up-form');
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

async function createUser(userType) {
  const { isValid, formData } = getFormData();
  if (!isValid) {
    return false;
  }

  const url = `../../control/${userType}.control.php`;
  const method = 'POST';
  formData.set('action', 'create');

  try {
    const response = await fetchData(url, method, formData);
    console.log(response);
  } catch (error) {
    console.log(error); 
  }
}
