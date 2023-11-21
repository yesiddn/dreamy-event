async function getFavoriteServices() {
  const data = new FormData();
  data.set('action', 'read');
  data.set('idCustomer', customer.id_customer);

  const url = './control/favorite.control.php';
  const method = 'POST';

  const response = await fetchData(url, method, data);

  const allServices = response.data;
  showServices(Object.groupBy(allServices, (service) => service.id_service));
}


function showServices(services) {
  const cardsContainer = document.getElementById('cards__container');

  // recorrer objeto services
  for (const service in services) {
    const serviceItem = services[service];
    const card = document.createElement('a');
    card.classList.add('card');
    card.href = `service?/${serviceItem[0].id_service}`;

    const favorite = document.createElement('button');
    favorite.type = 'button';
    favorite.classList.add('favorite');
    favorite.classList.add('favorite--active');
    favorite.addEventListener('click', (e) => {
      e.preventDefault();
      // removeFromFavorites(serviceItem, favorite);
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

    // falta la opción de calificación
    const rating = document.createElement('span');
    rating.textContent = `★${'¡FALTA!'}`;

    const location = document.createElement('p');
    location.textContent = `Ubicación: ${serviceItem[0].location}`;

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

getFavoriteServices();