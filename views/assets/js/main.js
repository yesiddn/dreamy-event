// const loginFormButton = document.getElementById('log-in-form-button');
// loginFormButton.addEventListener('click', method());

async function fetchData(url, method, data) {
  try {
    const response = await fetch(url, {
      method,
      body: data,
    });
  
    return await response.json();
  } catch (error) {
    return error;
  }
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

async function signUp(userType) {
  const { isValid, formData } = getFormData();
  if (!isValid) {
    return false;
  }

  const url = `./control/${userType}.control.php`;
  const method = 'POST';
  formData.set('action', 'create');

  if (userType === 'supplier') {
    formData.set('id_user', user.user.id_user);
  }

  try {
    const response = await fetchData(url, method, formData);
    if (response.status === 409) {
      showAlert('user-exists');
    }

    if (response.status === 201) {
      if (response.data.id_customer) {
        localStorage.setItem('user', JSON.stringify(response.data));
        showAlert('user-created');
      } else if (response.data.id_supplier) {
        localStorage.setItem('supplier', JSON.stringify(response.data));
        showAlert('supplier-created');
      }

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
      localStorage.setItem('user', JSON.stringify(response.data));
      showAlert('welcome');
      setTimeout(() => {
        window.location = 'home';
      }, 1000);
    }
  } catch (error) {
    console.error(error);
  }
}

async function getInfoService(idService) {
  const data = new FormData();
  data.set('action', 'read');
  data.set('idService', idService);

  const url = `./control/info-service.control.php`;
  const method = 'POST';

  try {
    const response = await fetchData(url, method, data);
    if (response.status === 200) {
      showInfoService(response.data);
    }
  } catch (error) {
    console.error(error);
  }
}

function showInfoService(data) {
  // gallery
  const infoServiceGallery = document.createElement('div');
  infoServiceGallery.classList.add('info-service__gallery');

  for (let i = 0; i < 4; i++) {
    const infoServiceGalleryImg = document.createElement('img');
    infoServiceGalleryImg.src = data.images[i].url_image;
    infoServiceGalleryImg.alt = '';

    infoServiceGallery.appendChild(infoServiceGalleryImg);
  }

  // details
  const infoServiceDetails = document.createElement('div');
  infoServiceDetails.classList.add('info-service__details');

  // sub container
  const infoServiceDetailsSubContainer = document.createElement('div');

  // header
  const infoServiceDetailsHeader = document.createElement('div');
  infoServiceDetailsHeader.classList.add('info-service__details__header');

  const infoServiceDetailsHeaderTitle = document.createElement('div');
  infoServiceDetailsHeaderTitle.classList.add(
    'info-service__details__header__title'
  );

  const infoServiceDetailsHeaderTitleH2 = document.createElement('h2');
  infoServiceDetailsHeaderTitleH2.textContent = data.name_service;

  const infoServiceDetailsHeaderTitleP = document.createElement('p');
  infoServiceDetailsHeaderTitleP.textContent = `${data.location} | ${data.city} - ${data.country}`;

  infoServiceDetailsHeaderTitle.appendChild(infoServiceDetailsHeaderTitleH2);
  infoServiceDetailsHeaderTitle.appendChild(infoServiceDetailsHeaderTitleP);

  // rating
  const infoServiceDetailsHeaderRating = document.createElement('div');
  infoServiceDetailsHeaderRating.classList.add(
    'info-service__details__header__rating'
  );

  const infoServiceDetailsHeaderRatingP = document.createElement('p');
  infoServiceDetailsHeaderRatingP.textContent = `★${data.rating}`;

  infoServiceDetailsHeaderRating.appendChild(infoServiceDetailsHeaderRatingP);

  infoServiceDetailsHeader.appendChild(infoServiceDetailsHeaderTitle);
  infoServiceDetailsHeader.appendChild(infoServiceDetailsHeaderRating);

  // body
  const infoServiceDetailsBody = document.createElement('div');
  infoServiceDetailsBody.classList.add('info-service__details__body');

  const infoServiceDetailsBodyP = document.createElement('p');
  infoServiceDetailsBodyP.textContent = data.description_service;

  infoServiceDetailsBody.appendChild(infoServiceDetailsBodyP);

  infoServiceDetailsSubContainer.appendChild(infoServiceDetailsHeader);
  infoServiceDetailsSubContainer.appendChild(infoServiceDetailsBody);

  // price card
  const infoServiceDetailsPriceCard = document.createElement('div');
  infoServiceDetailsPriceCard.classList.add(
    'info-service__details__price-card'
  );

  const infoServiceDetailsPriceCardP = document.createElement('p');
  infoServiceDetailsPriceCardP.textContent = `${data.price}€ / 24h`;

  const infoServiceDetailsPriceCardButton = document.createElement('button');
  infoServiceDetailsPriceCardButton.textContent = 'Agregar a un evento';

  const infoServiceDetailsPriceCardButtonIcon = document.createElement('span');

  infoServiceDetailsPriceCardButton.appendChild(
    infoServiceDetailsPriceCardButtonIcon
  );

  const infoServiceDetailsPriceCardEvents = document.createElement('ul');
  infoServiceDetailsPriceCardEvents.classList.add(
    'info-service__details__price-card__events'
  );
  infoServiceDetailsPriceCardEvents.classList.add('inactive');

  infoServiceDetailsPriceCard.appendChild(infoServiceDetailsPriceCardP);
  infoServiceDetailsPriceCard.appendChild(infoServiceDetailsPriceCardButton);
  infoServiceDetailsPriceCard.appendChild(infoServiceDetailsPriceCardEvents);

  infoServiceDetailsPriceCardButton.addEventListener('click', (e) => {
    if (
      e.target === infoServiceDetailsPriceCardButton ||
      infoServiceDetailsPriceCardButton.contains(e.target)
    ) {
      infoServiceDetailsPriceCardEvents.classList.toggle('inactive');
      infoServiceDetailsPriceCardEvents.classList.toggle('active');
    }
  });

  document.addEventListener('click', (e) => {
    const isClickInsideMenu =
      infoServiceDetailsPriceCardEvents.contains(e.target) ||
      e.target === infoServiceDetailsPriceCardButton ||
      infoServiceDetailsPriceCardButton.contains(e.target);

    if (!isClickInsideMenu) {
      infoServiceDetailsPriceCardEvents.classList.add('inactive');
      infoServiceDetailsPriceCardEvents.classList.remove('active');
    }
  });

  infoServiceDetails.appendChild(infoServiceDetailsSubContainer);
  infoServiceDetails.appendChild(infoServiceDetailsPriceCard);

  const infoService = document.querySelector('.info-service');
  infoService.appendChild(infoServiceGallery);
  infoService.appendChild(infoServiceDetails);

  showEventsInPriceCard();
}

if (location.pathname.includes('/service')) {
  const serviceId = location.search.split('?/')[1];
  getInfoService(serviceId);
}
