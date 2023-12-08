async function getEventInfo() {
  const data = new FormData();
  data.set('action', 'read event');
  data.set('idEvent', window.location.search.split('?/')[1]);

  const url = './control/events.control.php';
  const method = 'POST';

  const event = await fetchData(url, method, data);

  return event.data;
}

async function getEventResumen() {
  const data = new FormData();
  data.set('action', 'read event resumen');
  data.set('idEvent', window.location.search.split('?/')[1]);

  const url = './control/events.control.php';
  const method = 'POST';

  const services = await fetchData(url, method, data);

  return services.data;
}

async function showEventInfo() {
  const data = await getEventInfo();

  const header = document.querySelector('.resume-event__header');
  header.innerHTML = '';

  const title = document.createElement('h2');
  title.textContent = data.name;

  const details = document.createElement('div');
  details.classList.add('resume-event__header__details');

  const date = document.createElement('p');
  date.textContent = 'Fecha de evento: ';

  const spanDate = document.createElement('span');
  spanDate.textContent = data.date;

  const location = document.createElement('p');
  location.textContent = 'Lugar: ';

  const spanLocation = document.createElement('span');
  spanLocation.textContent = `${data.address} | ${data.city}`;
  
  date.appendChild(spanDate);
  location.appendChild(spanLocation);
  details.appendChild(date);
  details.appendChild(location);
  header.appendChild(title);
  header.appendChild(details);
}

async function showEventResumen() {
  const data = await getEventResumen();
  if (data === null) return;
  
  const services = data.services
  const checkoutData = data.checkoutData

  const resumeEventBody = document.querySelector('.resume-event__body');
  resumeEventBody.innerHTML = '';

  const titleBody = document.createElement('h3');
  titleBody.textContent = 'Resume';

  services.forEach((service) => {
    const resumeEventService = document.createElement('div');
    resumeEventService.classList.add('resume-event__body__service');

    const title = document.createElement('h4');
    title.textContent = service.name_service;

    const price = document.createElement('p');
    price.textContent = `$${service.price}`;

    resumeEventService.appendChild(title);
    resumeEventService.appendChild(price);
    resumeEventBody.appendChild(resumeEventService);
  });

  const resumeEventTotal = document.createElement('div');
  resumeEventTotal.classList.add('resume-event__body__total');

  const title = document.createElement('h3');
  title.textContent = 'Total:';

  const price = document.createElement('p');
  const total = services.reduce((acc, service) => acc + Number(service.price), 0);
  price.textContent = `$${total}`;

  resumeEventTotal.appendChild(title);
  resumeEventTotal.appendChild(price);
  resumeEventBody.appendChild(titleBody);
  resumeEventBody.appendChild(resumeEventTotal);

  // form checkout
  const form = document.createElement('form');
  form.action = 'https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/';
  form.method = 'POST';
  form.id = 'form-checkout';

  // recorrer objeto checkoutData
  for (const key in checkoutData) {
    if (Object.hasOwnProperty.call(checkoutData, key)) {
      const input = document.createElement('input');
      input.type = 'hidden';
      input.name = key;
      input.value = checkoutData[key];

      form.appendChild(input);
    }
  }

  const button = document.createElement('button');
  button.type = 'submit';
  button.classList.add('resume-event__body__button');
  button.id = 'reserve';
  button.textContent = 'Reservar servicios';

  form.appendChild(button);
  resumeEventBody.appendChild(form);
  // resumeEventBody.appendChild(button);
}

async function getServicesByEventId(eventId) {
  const data = new FormData();
  data.set('action', 'read event services');
  data.set('eventId', eventId);

  const url = './control/services.control.php';
  const method = 'POST';

  const services = await fetchData(url, method, data);

  showEventServices(services.data);
}

function showEventServices(services) {
  const cardsContainer = document.getElementById('cards__container');
  cardsContainer.innerHTML = '';

  services.forEach((service) => {
    const card = document.createElement('a');
    card.classList.add('card');
    card.href = `service?/${service.id_service}`;

    const img = document.createElement('img');
    img.src = service.url_image;
    img.alt = service.name_service;

    const cardContent = document.createElement('div');
    cardContent.classList.add('card__content');

    const cardTitle = document.createElement('div');
    cardTitle.classList.add('card__title');

    const title = document.createElement('h2');
    title.textContent = service.name_service;

    const location = document.createElement('p');
    location.textContent = service.location;

    const price = document.createElement('p');
    price.textContent = `$${service.price}`;

    const deleteServiceFromEvent = document.createElement('button');
    deleteServiceFromEvent.type = 'button';
    deleteServiceFromEvent.classList.add('delete-service');

    deleteServiceFromEvent.addEventListener('click', (e) => {
      e.preventDefault();
      removeServiceFromEvent(
        window.location.search.split('?/')[1],
        service.id_service
      );
    });

    cardTitle.appendChild(title);
    cardContent.appendChild(cardTitle);
    cardContent.appendChild(location);
    cardContent.appendChild(price);
    card.appendChild(img);
    card.appendChild(cardContent);
    card.appendChild(deleteServiceFromEvent);
    cardsContainer.appendChild(card);
  });
}

async function removeServiceFromEvent(idEvent, idService) {
  const data = new FormData();
  data.set('action', 'delete event service');
  data.set('idEvent', idEvent);
  data.set('idService', idService);

  const url = './control/events.control.php';
  const method = 'POST';

  const response = await fetchData(url, method, data);

  if (response.status === 200) {
    showAlert('service removed from event');
    showEventInfo();
    showEventResumen();
    getServicesByEventId(window.location.search.split('?/')[1]);
  }
}

showEventInfo();
showEventResumen();
getServicesByEventId(window.location.search.split('?/')[1]);
