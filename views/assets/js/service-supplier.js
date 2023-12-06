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

function showServices(services) {
  const cardsContainer = document.getElementById('cards__container2');

  // recorrer objeto services
  for (const service in services) {
    const serviceItem = services[service];
    const card = document.createElement('a');
    card.classList.add('card2');
    card.href = `service?/${serviceItem[0].id_service}`;

    
    const options = document.createElement('button');
    options.type = 'button';
    options.classList.add('options');

    

    const img = document.createElement('img');
    img.src = serviceItem[0].url_image;
    img.alt = serviceItem[0].name_service;

    const cardContent = document.createElement('div');
    cardContent.classList.add('card__content2');

    const cardTitle = document.createElement('div');
    cardTitle.classList.add('card__title2');

    const title = document.createElement('h2');
    title.textContent = serviceItem[0].name_service;

    // falta la opción de calificación
    const rating = document.createElement('span');
    rating.textContent = `★${'¡FALTA!'}`;

    const location = document.createElement('p');
    location.textContent = serviceItem[0].location;

    const price = document.createElement('p');
    price.textContent = `$${serviceItem[0].price}`;
    price.classList.add('price2');

    cardTitle.appendChild(title);
    cardTitle.appendChild(rating);
    cardContent.appendChild(cardTitle);
    cardContent.appendChild(location);
    cardContent.appendChild(price);
    cardContent.appendChild(options);
    card.appendChild(img);
    card.appendChild(cardContent);
    cardsContainer.appendChild(card);
  }
}

if (!user) {
  getServicesSupplier('all', null);
} else {
  getServicesSupplier('all', user.id_customer);
}

