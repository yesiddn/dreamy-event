async function getServicesSupplier(category, idSupplier) {
  const data = new FormData();
  data.set('action', 'reads');
  data.set('category', category);
  data.set('idSupplier', idSupplier);

  const url = './control/services.control.php';
  const method = 'POST';

  const services = await fetchData(url, method, data);

  const allServices = services.data;
  showServices(Object.groupBy(allServices, (service) => service.id_service));
}

async function getServiceById(idService) {
  const data = new FormData();
  data.set('action', 'read by id');
  data.set('idService', idService);

  const url = './control/services.control.php';
  const method = 'POST';

  const service = await fetchData(url, method, data);

  return service;
}

function showServices(services) {
  const cardsContainer = document.getElementById('cards__container2');
  // cardsContainer.innerHTML = '';

  for (const service in services) {
    const serviceItem = services[service];
    const card = document.createElement('a');
    card.classList.add('card');
    card.href = `service?/${serviceItem[0].id_service}`;

    // service options
    const options = document.createElement('div');
    options.classList.add('service__options');
    options.classList.add('inactive');

    // service options -> editar
    const serviceEdit = document.createElement('a');
    serviceEdit.href = `edit-service?/${serviceItem[0].id_service}`;
    serviceEdit.classList.add('service__options__edit');

    const serviceEditIcon = document.createElement('span');
    serviceEditIcon.classList.add('icon-pencil');

    serviceEdit.textContent = 'Editar';
    serviceEdit.appendChild(serviceEditIcon);

    // service options -> eliminar
    const serviceDelete = document.createElement('button');
    serviceDelete.setAttribute('type', 'button');
    serviceDelete.classList.add('service__options__delete');

    serviceDelete.addEventListener('click', async (e) => {
      e.preventDefault();
      await deleteService(serviceItem[0].id_service);
    });

    const serviceDeleteIcon = document.createElement('span');
    serviceDeleteIcon.classList.add('icon-trash');

    serviceDelete.textContent = 'Eliminar';
    serviceDelete.appendChild(serviceDeleteIcon);

    options.appendChild(serviceEdit);
    options.appendChild(serviceDelete);

    // event options -> show options
    const serviceOptionsShow = document.createElement('span');
    serviceOptionsShow.classList.add('icon-ellipsis');
    serviceOptionsShow.classList.add('icon-ellipsis--bg-white');

    serviceOptionsShow.addEventListener('click', (e) => {
      e.preventDefault();
      options.classList.toggle('inactive');
      options.classList.toggle('active');
    });

    document.addEventListener('click', (e) => {
      if (e.target !== serviceOptionsShow) {
        options.classList.remove('active');
        options.classList.add('inactive');
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
    card.appendChild(serviceOptionsShow);
    card.appendChild(options);
    card.appendChild(img);
    card.appendChild(cardContent);
    cardsContainer.appendChild(card);
  }
}

if (!user && (window.location.pathname.split('/')[2] === 'my-services')) {
  getServicesSupplier('all', null);
} else if (user && (window.location.pathname.split('/')[2] === 'my-services')) {
  getServicesSupplier('all', user.supplier.id_supplier);
}


async function initServices() {
  const services = await getServicesSupplier();
  showServices(services.data);
}

async function editService() {
  const idService = location.search.split('?/')[1];
  const form = document.querySelector('#form');
  
  const data = new FormData(form);
  data.set('action', 'update');
  data.set('idService', idService);

  const url = './control/services.control.php';
  const method = 'POST';

  const response = await fetchData(url, method, data);

  if (response.status === 200) {
    showAlert('service updated');
    window.location = 'my-services';
  } else {
    showAlert('something went wrong');
  }

}

async function ServiceForm(idService) {
    
  const service = await getServiceById(idService);

  const nameServices = document.querySelector('#name-service');
  const description = document.querySelector('#description-service');
  const price = document.querySelector('#price-service');
  const location = document.querySelector('#location-service');
  const city = document.querySelector('#city-service');
  const country = document.querySelector('#country-service');
  const amountPeople = document.querySelector('#peopleAmount-service');
  const characteristics = document.querySelector('#characteristics-service');
  const typeService = document.querySelector('#type-service');


  nameServices.value = service.data.nameService;
  description.value = service.data.description;
  price.value = service.data.price;
  location.value = service.data.location;
  city.value = service.data.city;
  country.value = service.data.country;
  amountPeople.value = service.data.amount;
  characteristics.value = service.data.characteristics;
  typeService.value = service.data.id_type_service;
}

if (window.location.pathname.split('/')[2] === 'edit-service') {
  const idService = location.search.split('?/')[1];
  ServiceForm(idService);
}


async function deleteService(idService) {
  const data = new FormData();
  data.set('action', 'delete');
  data.set('idService', idService);

  const url = './control/services.control.php';
  const method = 'POST';

  const response = await fetchData(url, method, data);

  if (response.status === 200) {
    showAlert('service deleted');
    window.location = 'my-services';
  } else {
    showAlert('something went wrong');
  }
}