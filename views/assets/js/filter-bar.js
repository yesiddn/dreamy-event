document.addEventListener('DOMContentLoaded', function () {
  const data = new FormData();
  data.append('showTypeService', 'OK');
  
  fetch('./control/filter-bar.control.php', {
    method: 'POST',
    body: data,
  })
    .then((response) => response.json())
    .then((data) => {
      const serviceList = document.getElementById('serviceList');

      data.forEach((service) => {
        const listItem = document.createElement('li');
        listItem.innerHTML = `
          <img src="${service.image_type_service}" alt="${service.name_type_service}" class="filter-bar-img">
          <span class="line"></span>
          <span>${service.name_type_service}</span>
        `;
        
        listItem.addEventListener('click', () => filterServiceByType(service.id_type_service));
        serviceList.appendChild(listItem);
      });
    })
    .catch((error) => console.error('Error:', error));
});

async function filterServiceByType(idTypeService) {
  const data = await getServiceByType(idTypeService);

  showServices(Object.groupBy(data, (service) => service.id_service));
}

async function getServiceByType(idTypeService) {
  const data = new FormData();
  data.set('action', 'read by type');
  if (user) {
    data.set('idCustomer', user.id_customer);
  } else {
    data.set('idCustomer', null);
  }

  data.set('idTypeService', idTypeService);

  const url = './control/services.control.php';
  const method = 'POST';

  const services = await fetchData(url, method, data);

  return services.data;
}