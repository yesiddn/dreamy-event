// filter-bar.js

// Esperar a que el DOM esté cargado
document.addEventListener('DOMContentLoaded', function () {

    // Realizar una solicitud AJAX
    fetch('./control/filter-bar.control.php', {
       method: 'POST',
       body: new URLSearchParams({
          'showTypeService': 'OK'
       }),
    })
    .then(response => response.json())
    .then(data => {
       // Manipular el DOM para mostrar la lista
       const serviceList = document.getElementById('serviceList');
 
       // Iterar sobre los datos y agregar elementos a la lista
       data.forEach(service => {
          const listItem = document.createElement('li');
          listItem.innerHTML = `
             <img src="${service.image_type_service}" alt="${service.name_type_service}" class="filter-bar-img">
             <span>${service.name_type_service}</span>
          `;
          serviceList.appendChild(listItem);
       });
    })
    .catch(error => console.error('Error:', error));
 
 });
 