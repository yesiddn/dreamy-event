
document.addEventListener("DOMContentLoaded", function (){
  fetchServices();
});


function fetchServices(){

  fetch('control/services.control.php')
  .then(response => {
    if (!response.ok) {
      throw new Error('Error al obtener datos del servidor');
    }
    return response.json();
  })

  .then(data => {
    if (data.codigo === "200") {
      displayServices(data.data);
    } else {
      console.error('Error al obtener servicios:', data.mensaje);
    }
  })

  .catch(error => console.error('Error al obtener servicios:', error.message));
}

function displayServices(services){
  const cardsContainer = document.getElementById('cards__container');

  services.forEach(service => {
    const card = document.createElement('a');
    card.href = "#";
    card.classList.add('card');


    // falta la opción de calificación

    card.innerHTML= `<img src="./views/assets/img/img2.jpeg" alt="${service.name_service}">
    <div class="card__content">
      <div class="card__title">
        <h2>${service.name_service}</h2>
        <span>★${'¡FALTA!'}</span>
      </div>
      <p>Ubicación: <span>${service.location}</span></p>
      <p>$${service.price}</p>
    </div>`;

    cardsContainer.appendChild(card);

  });
}  