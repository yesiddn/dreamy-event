async function getEventInfo() {
  const data = new FormData();
  data.set('action', 'read event');
  data.set('idEvent', window.location.search.split('?/')[1].split('&')[0]);

  const url = './control/events.control.php';
  const method = 'POST';

  const event = await fetchData(url, method, data);

  return event.data;
}

async function getEventResumen() {
  const data = new FormData();
  data.set('action', 'read event resumen');
  data.set('idEvent', window.location.search.split('?/')[1].split('&')[0]);

  const url = './control/events.control.php';
  const method = 'POST';

  const services = await fetchData(url, method, data);

  return services.data;
}

async function showEventInfo(data) {
  const eventDetails = document.querySelector('.event-details');
  eventDetails.innerHTML = '';

  const resumeEvent = document.createElement('section');
  resumeEvent.classList.add('resume-event');

  const header = document.createElement('div');
  header.classList.add('resume-event__header');

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
  resumeEvent.appendChild(header);
  eventDetails.appendChild(resumeEvent);
}

async function showEventResumen(transactionState) {
  const data = await getEventResumen();

  const resumeEvent = document.querySelector('.resume-event');

  const resumeEventBody = document.createElement('div');
  resumeEventBody.classList.add('resume-event__body');
  
  if (data === null) {
    const resumeEventService = document.createElement('div');
    resumeEventService.classList.add('resume-event__body__service');
    
    const title = document.createElement('h4');
    title.textContent = 'No hay servicios agregados';
    
    const button = document.createElement('a');
    button.href = 'home';
    button.classList.add('resume-event__body__button');
    button.textContent = 'Ver servicios';

    resumeEventService.appendChild(title);
    resumeEventService.appendChild(button);
    resumeEventBody.appendChild(resumeEventService);
    resumeEvent.appendChild(resumeEventBody);

    return;
  }
  
  const services = data.services;
  const checkoutData = data.checkoutData;
  
  const titleBody = document.createElement('h3');
  titleBody.textContent = 'Resume';

  resumeEventBody.appendChild(titleBody);

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
  const total = services.reduce(
    (acc, service) => acc + Number(service.price),
    0
  );
  price.textContent = `$${total}`;

  resumeEventTotal.appendChild(title);
  resumeEventTotal.appendChild(price);
  resumeEventBody.appendChild(resumeEventTotal);

  if (transactionState === 2) {
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
  } else if (transactionState === 4) {
    const message = document.createElement('h4');
    message.textContent = 'Nuestros proveedores se pondrán en contacto contigo para coordinar los detalles de tu evento.';
    message.classList.add('resume-event__body__message');
    resumeEventBody.appendChild(message);
  }

  resumeEvent.appendChild(resumeEventBody);
}

async function getServicesByEventId(eventId) {
  const data = new FormData();
  data.set('action', 'read event services');
  data.set('eventId', eventId);

  const url = './control/services.control.php';
  const method = 'POST';

  const services = await fetchData(url, method, data);

  return services.data;
}

function showEventServices(services) {
  const eventDetails = document.querySelector('.event-details');
  
  const cardsContainer = document.createElement('section');
  cardsContainer.classList.add('cards-container');

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
        window.location.search.split('?/')[1].split('&')[0],
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
    eventDetails.appendChild(cardsContainer);
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
    showUserInterface(window.location.search.split('?/')[1].split('&'));
  }
}

async function updateCheckoutState(idEvent) {
  const data = new FormData();
  data.set('action', 'update checkout state');
  data.set('idEvent', idEvent);

  const url = './control/events.control.php';
  const method = 'POST';

  const response = await fetchData(url, method, data);

  if (response.status === 200) {
    showAlert('transaction approved');
  }
}

async function showUserInterface(infoEvent) {
  const data = await getEventInfo();
  if (data === null) showAlert('something went wrong');
  
  showEventInfo(data);
  showEventResumen(data.transactionState);
  const services = await getServicesByEventId(infoEvent[0]);
  showEventServices(services);
}

const infoEvent = window.location.search.split('?/')[1].split('&');

if (infoEvent.length > 1) {
  const transactionStateIndex = infoEvent.findIndex((item) =>
    item.includes('transactionState')
  );
  const transactionState = infoEvent[transactionStateIndex].split('=')[1];

  if (transactionState === '4') {
    updateCheckoutState(window.location.search.split('?/')[1].split('&')[0]);
  } else if (transactionState === '6') {
    showAlert('transaction rejected');
  } else if (transactionState === '7') {
    showAlert('transaction pending');
  } else if (transactionState === '104') {
    showAlert('transaction error');
  }
}

showUserInterface(infoEvent);
