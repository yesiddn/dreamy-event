async function getEvents() {
  const data = new FormData();
  data.set('action', 'read');
  data.set('idCustomer', user.id_customer);
  const url = './control/events.control.php';
  const method = 'POST';

  const events = await fetchData(url, method, data);

  return events;
}

function showEvents(events) {
  const eventsContainer = document.querySelector('.events-list');

  events.forEach((event) => {
    // event container
    const eventContainer = document.createElement('a');
    eventContainer.classList.add('event');
    eventContainer.href = `/event?/${event.idEvent}`;

    // event header
    const eventHeader = document.createElement('div');
    eventHeader.classList.add('event__header');

    const eventName = document.createElement('h3');
    eventName.title = event.name;
    eventName.textContent = event.name;

    // event details
    const eventDetails = document.createElement('div');
    eventDetails.classList.add('event__header__details');

    // event details -> cantidad de servicios
    const eventServices = document.createElement('p');
    eventServices.textContent = 'Cantidad de servicios: ';

    const spanServices = document.createElement('span');
    spanServices.classList.add('highlight-text');
    spanServices.textContent = event.amountServices;

    eventServices.appendChild(spanServices);

    // event details -> fecha
    const eventDate = document.createElement('p');
    eventDate.textContent = 'Fecha: ';

    const spanDate = document.createElement('span');
    spanDate.classList.add('highlight-text');
    spanDate.textContent = event.date;

    eventDate.appendChild(spanDate);

    // event price
    const eventPrice = document.createElement('div');
    eventPrice.classList.add('event__price');

    const eventTotal = document.createElement('h4');
    eventTotal.textContent = 'Total: ';

    const spanTotal = document.createElement('span');
    spanTotal.classList.add('highlight-text');

    // total con toLocaleString y sin decimales
    const total = event.total.toLocaleString('es-CO', {
      style: 'currency',
      currency: 'COP',
      maximumFractionDigits: 0,
    });

    spanTotal.textContent = total;

    eventTotal.appendChild(spanTotal);

    // append childs
    eventPrice.appendChild(eventTotal);
    eventDetails.appendChild(eventServices);
    eventDetails.appendChild(eventDate);
    eventHeader.appendChild(eventName);
    eventHeader.appendChild(eventDetails);
    eventContainer.appendChild(eventHeader);
    eventContainer.appendChild(eventPrice);
    eventsContainer.appendChild(eventContainer);
  });
}

async function initEvents() {
  const events = await getEvents();
  showEvents(events.data);
}

function insertEvents(data, eventsContainer) {
  data.forEach((event) => {
    const eventContainer = document.createElement('li');
    eventContainer.textContent = event.name;

    eventContainer.addEventListener('click', (e) => {
      e.preventDefault();
      const idService = location.search.split('?/')[1];
      // addServiceToEvent(event.idEvent, idService);
      console.log(idService);
    });

    eventsContainer.appendChild(eventContainer);
  });
}

function insertCreateEvent(eventsContainer) {
  const eventContainer = document.createElement('li');
  const eventIcon = document.createElement('span');

  eventContainer.appendChild(eventIcon);  
  eventContainer.appendChild(document.createTextNode('Crear evento'));

  eventContainer.addEventListener('click', () => {
    const idService = location.search.split('?/')[1];
    window.location = `new-event?/${idService}`;
  });

  eventsContainer.appendChild(eventContainer);
}

async function showEventsInPriceCard() {
  const eventsContainer = document.querySelector(
    '.info-service__details__price-card__events'
  );

  const events = await getEvents();

  if ((events.status = 200)) {
    insertEvents(events.data, eventsContainer);
  }

  insertCreateEvent(eventsContainer);
}