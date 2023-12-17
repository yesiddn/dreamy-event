async function getServices(category, idCustomer) {
  const data = new FormData();
  data.set('action', 'read');
  data.set('category', category);
  data.set('idCustomer', idCustomer);

  const url = './control/services.control.php';
  const method = 'POST';

  const services = await fetchData(url, method, data);

  const allServices = services.data;
  showServices(Object.groupBy(allServices, (service) => service.id_service));
}

async function getReservedServices(idSupplier) {
  const data = new FormData();
  data.set('action', 'read reserved services');
  data.set('idSupplier', idSupplier);

  const url = './control/services.control.php';
  const method = 'POST';

  const services = await fetchData(url, method, data);

  showReservedServices(services.data);
}

function showServices(services) {
  const cardsContainer = document.getElementById('cards__container');
  cardsContainer.innerHTML = '';

  for (const service in services) {
    const serviceItem = services[service];
    const card = document.createElement('a');
    card.classList.add('card');
    card.href = `service?/${serviceItem[0].id_service}`;

    const favorite = document.createElement('button');
    favorite.type = 'button';
    favorite.classList.add('favorite');

    if (serviceItem[0].is_favorite) {
      favorite.classList.add('favorite--active');
    }

    favorite.addEventListener('click', (e) => {
      e.preventDefault();
      if (favorite.classList.contains('favorite--active')) {
        removeFromFavorites(serviceItem[0].id_service, favorite);
      } else {
        addFavoriteService(serviceItem[0].id_service, favorite);
      }
    });

    const img = document.createElement('img');
    img.src = serviceItem[0].url_image;
    img.alt = serviceItem[0].name_service;

    const cardContent = document.createElement('div');
    cardContent.classList.add('card__content');

    const cardTitle = document.createElement('div');
    cardTitle.classList.add('card__title');

    const title = document.createElement('h2');
    title.textContent = serviceItem[0].name_service;

    const rating = document.createElement('span');
    rating.textContent = `★${serviceItem[0].rating}`;

    const location = document.createElement('p');
    location.textContent = serviceItem[0].location;

    const price = document.createElement('p');
    price.textContent = `$${serviceItem[0].price}`;

    cardTitle.appendChild(title);
    cardTitle.appendChild(rating);
    cardContent.appendChild(cardTitle);
    cardContent.appendChild(location);
    cardContent.appendChild(price);
    card.appendChild(favorite);
    card.appendChild(img);
    card.appendChild(cardContent);
    cardsContainer.appendChild(card);
  }
}

function showReservedServices(services) {
  console.log(services.length);
  if (services.length === 0) {
    return;
  }

  const reservedServicesContainer = document.querySelector('.reserved-services');
  reservedServicesContainer.innerHTML = '';

  // title
  const title = document.createElement('h2');
  title.textContent = 'Servicios Pendientes';

  // services container
  const servicesContainer = document.createElement('div');
  servicesContainer.classList.add('services-container');

  for (const service of services) {
    const serviceCard = document.createElement('div');
    serviceCard.classList.add('service__dash__card');

    const serviceDetails = document.createElement('div');
    serviceDetails.classList.add('service__dash__card__details');

    // event header
    const eventHeader = document.createElement('div');
    eventHeader.classList.add('service__header');

    // service name
    const serviceTitle = document.createElement('h3');
    serviceTitle.title = service.name_service;
    serviceTitle.textContent = service.name_service;

    // service details
    const eventHeaderDetails = document.createElement('div');
    eventHeaderDetails.classList.add('service__header__details');

    const eventDate = document.createElement('p');
    eventDate.textContent = 'Fecha:';
    const eventDateSpan = document.createElement('span');
    eventDateSpan.classList.add('highlight-text');
    eventDateSpan.textContent = service.date;
    eventDate.appendChild(eventDateSpan);

    const eventAddress = document.createElement('p');
    eventAddress.textContent = 'Direccion:';
    const eventAddressSpan = document.createElement('span');
    eventAddressSpan.classList.add('highlight-text');
    eventAddressSpan.textContent = service.address;
    eventAddress.appendChild(eventAddressSpan);

    const eventLocation = document.createElement('p');
    eventLocation.textContent = 'Ubicacion:';
    const eventLocationSpan = document.createElement('span');
    eventLocationSpan.classList.add('highlight-text');
    eventLocationSpan.textContent = `${service.city} | ${service.country}`;
    eventLocation.appendChild(eventLocationSpan);

    eventHeaderDetails.appendChild(eventDate);
    eventHeaderDetails.appendChild(eventAddress);
    eventHeaderDetails.appendChild(eventLocation);

    eventHeader.appendChild(serviceTitle);
    eventHeader.appendChild(eventHeaderDetails);

    // customer info
    const customerInfo = document.createElement('div');
    customerInfo.classList.add('service__dash__customer__info');

    const customerProfilePic = document.createElement('img');
    customerProfilePic.classList.add('service__dash__profile__pic');
    customerProfilePic.src = service.img_profile_customer;
    customerProfilePic.alt = service.name_customer;

    const customerInfoDetails = document.createElement('div');
    customerInfoDetails.classList.add('service__dash__customer__info__details');

    const customerName = document.createElement('p');
    customerName.title = `${service.name_customer} ${service.last_name_customer}`;
    customerName.textContent = `${service.name_customer} ${service.last_name_customer}`;

    const customerEmail = document.createElement('p');
    customerEmail.title = service.email_user;
    customerEmail.textContent = service.email_user;

    customerInfo.appendChild(customerProfilePic);
    customerInfoDetails.appendChild(customerName);
    customerInfoDetails.appendChild(customerEmail);
    customerInfo.appendChild(customerInfoDetails);

    // buttons
    const buttonContainer = document.createElement('div');
    buttonContainer.classList.add('button-container');

    const contactButton = document.createElement('a');
    contactButton.href = `https://api.whatsapp.com/send?phone=${service.phone_customer}`;
    contactButton.id = 'dash-customer-contact';
    contactButton.target = '_blank';
    contactButton.textContent = 'Contactar';

    const completeButton = document.createElement('button');
    completeButton.id = 'dash-customer-complete';
    completeButton.textContent = 'Completar';

    buttonContainer.appendChild(contactButton);
    buttonContainer.appendChild(completeButton);

    serviceDetails.appendChild(eventHeader);
    serviceDetails.appendChild(customerInfo);

    serviceCard.appendChild(serviceDetails);
    serviceCard.appendChild(buttonContainer);

    servicesContainer.appendChild(serviceCard);
  }

  reservedServicesContainer.appendChild(title);
  reservedServicesContainer.appendChild(servicesContainer);
}

if (!user && window.location.pathname.split('/')[2] != 'my-services') {
  getServices('all', null);
} else if (window.location.pathname.split('/')[2] != 'my-services') {
  getServices('all', user.id_customer);
}

if (window.location.pathname.split('/')[2] === 'my-services') {
  getReservedServices(user.supplier.id_supplier);
}
