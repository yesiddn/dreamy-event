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
  eventsContainer.innerHTML = '';

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
    if (event.total === null) {
      event.total = 0;
    }

    const total = event.total.toLocaleString('es-CO', {
      style: 'currency',
      currency: 'COP',
      maximumFractionDigits: 0,
    });

    spanTotal.textContent = total;

    eventTotal.appendChild(spanTotal);

    // event options
    const eventOptions = document.createElement('div');
    eventOptions.classList.add('event__options');
    eventOptions.classList.add('inactive');

    // event options -> editar
    const eventEdit = document.createElement('a');
    eventEdit.href = `/edit-event?/${event.idEvent}`;
    eventEdit.classList.add('event__options__edit');

    const eventEditIcon = document.createElement('span');
    eventEditIcon.classList.add('icon-pencil');

    eventEdit.textContent = 'Editar';
    eventEdit.appendChild(eventEditIcon);

    // event options -> eliminar
    const eventDelete = document.createElement('button');
    eventDelete.setAttribute('type', 'button');
    eventDelete.classList.add('event__options__delete');

    eventDelete.addEventListener('click', async (e) => {
      e.preventDefault();
      await deleteEvent(event.idEvent);
    });

    const eventDeleteIcon = document.createElement('span');
    eventDeleteIcon.classList.add('icon-trash');

    eventDelete.textContent = 'Eliminar';
    eventDelete.appendChild(eventDeleteIcon);

    eventOptions.appendChild(eventEdit);
    eventOptions.appendChild(eventDelete);

    // event options -> show options
    const eventOptionsShow = document.createElement('span');
    eventOptionsShow.classList.add('icon-ellipsis');

    eventOptionsShow.addEventListener('click', (e) => {
      e.preventDefault();
      eventOptions.classList.toggle('inactive');
      eventOptions.classList.toggle('active');
    });

    document.addEventListener('click', (e) => {
      if (e.target !== eventOptionsShow) {
        eventOptions.classList.remove('active');
        eventOptions.classList.add('inactive');
      }
    });

    // append childs
    eventPrice.appendChild(eventTotal);
    eventDetails.appendChild(eventServices);
    eventDetails.appendChild(eventDate);
    eventHeader.appendChild(eventName);
    eventHeader.appendChild(eventDetails);
    eventContainer.appendChild(eventHeader);
    eventContainer.appendChild(eventPrice);
    eventContainer.appendChild(eventOptionsShow);
    eventContainer.appendChild(eventOptions);
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
      addServiceToEvent(event.idEvent, idService);
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
    if (events.data[0].idEvent !== null) {
      insertEvents(events.data, eventsContainer);
    }
  }

  insertCreateEvent(eventsContainer);
}

async function addServiceToEvent(idEvent, idService) {
  const data = new FormData();
  data.set('action', 'addService');
  data.set('idEvent', idEvent);
  data.set('idService', idService);

  const url = './control/events.control.php';
  const method = 'POST';

  const response = await fetchData(url, method, data);
  if (response.status === 201) {
    showAlert('service added to event');

    const eventsContainer = document.querySelector(
      '.info-service__details__price-card__events'
    );
    eventsContainer.classList.toggle('inactive');
    eventsContainer.classList.toggle('active');
  } else {
    showAlert('service has already been added to the event');
  }
}

async function deleteEvent(idEvent) {
  const data = new FormData();
  data.set('action', 'delete');
  data.set('idEvent', idEvent);

  const url = './control/events.control.php';
  const method = 'POST';

  const response = await fetchData(url, method, data);

  if (response.status === 200) {
    showAlert('event deleted');
    initEvents();
  } else {
    showAlert('something went wrong');
  }
}