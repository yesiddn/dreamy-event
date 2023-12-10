document.addEventListener('DOMContentLoaded', function () {
  const searchForm = document.getElementById('searchForm');

  searchForm.addEventListener('submit', function (event) {
      event.preventDefault();

      const userId = user && user.id_customer ? user.id_customer : null;

      const searchInput = document.getElementById('search');
      const searchValue = searchInput.value.trim();

      if (!searchValue) {
          console.log('Ingresa algo para buscar');
          return;
      }

      const searchData = new FormData();
      searchData.set('search', searchValue);
      searchData.set('idCustomer', userId);

      fetch('./control/search.control.php', {
          method: 'POST',
          body: searchData,
      })
      .then((response) => response.json())
      .then((services) => {
          const allServices = services.data;
          displaySearchResults(Object.groupBy(allServices, (service) => service.name_service));
      })
      .catch((error) => {
          console.error('Error:', error);
      });
  });

  function displaySearchResults(services) {
      const searchResultsContainer = document.getElementById('searchResults');
      searchResultsContainer.innerHTML = '';

      const cardsContainer = document.getElementById('cards__container');

      for (const serviceName in services) {
          const serviceItems = services[serviceName];

          serviceItems.forEach((serviceItem) => {
              const card = document.createElement('a');
              card.classList.add('card');
              card.href = `service?/${serviceItem.id_service}`;

              const favorite = document.createElement('button');
              favorite.type = 'button';
              favorite.classList.add('favorite');

              if (serviceItem.is_favorite) {
                  favorite.classList.add('favorite--active');
              }

              favorite.addEventListener('click', (e) => {
                  e.preventDefault();
                  if (favorite.classList.contains('favorite--active')) {
                      removeFromFavorites(serviceItem.id_service, favorite);
                  } else {
                      addFavoriteService(serviceItem.id_service, favorite);
                  }
              });

              const img = document.createElement('img');
              img.src = serviceItem.url_image;
              img.alt = serviceItem.name_service;

              const cardContent = document.createElement('div');
              cardContent.classList.add('card__content');

              const cardTitle = document.createElement('div');
              cardTitle.classList.add('card__title');

              const title = document.createElement('h2');
              title.textContent = serviceItem.name_service;

              const rating = document.createElement('span');
              rating.textContent = `★${serviceItem.rating}`;

              const location = document.createElement('p');
              location.textContent = serviceItem.location;

              const price = document.createElement('p');
              price.textContent = `$${serviceItem.price}`;

              cardTitle.appendChild(title);
              cardTitle.appendChild(rating);
              cardContent.appendChild(cardTitle);
              cardContent.appendChild(location);
              cardContent.appendChild(price);
              card.appendChild(favorite);
              card.appendChild(img);
              card.appendChild(cardContent);
              cardsContainer.appendChild(card);
          });
      }
  }
});
