const customerFormButton = document.getElementById('customerFormButton');

customerFormButton.addEventListener('click', createCustomer);

async function fetchData(url, method, data) {
  const response = await fetch(url, {
    method,
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data),
  });
}

function getFormCustomerData() {
  const customerForm = document.getElementById('customerForm');
  const customerData = new FormData(customerForm);

  return validateFormData(customerData);
}

function validateFormData(formData) {
  let isValid = true;
  
  for (const [key, value] of formData.entries()) {
    isValid = validateInputData(key) && isValid;
  }

  return {isValid, formData};
}

function validateInputData(inputId) {
  const input = document.getElementById(inputId);
  const invalidFeedback = input.nextElementSibling;
  if (input.value.trim() === '' || input.validity.valida === false) {
    input.classList.add('is-invalid');

    // activate the invalid feedback
    invalidFeedback.classList.remove('inactive');
    // invalidFeedback.style.display = 'block';

    return false;
  } else {
    input.classList.remove('is-invalid');
    invalidFeedback.classList.add('inactive');
    return true;
  }
}

function createCustomer() {
  const { isValid, formData } = getFormCustomerData();
  if (!isValid) {
    return false;
  }
  
  const url = 'control/customer.control.php';
  const method = 'POST';
  const data = {
    action: 'create',
    formData
  };

  const response = fetchData(url, method, data);
}