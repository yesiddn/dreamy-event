document.addEventListener('DOMContentLoaded', function () {



    document.querySelector('#service-form-button').addEventListener('click', function () {

        let nameService = document.querySelector('#name-service').value;
        let serviceDescript = document.querySelector('#description-service').value;
        let priceService = document.querySelector('#price-service').value;
        let locationService = document.querySelector('#location-service').value;
        let cityService = document.querySelector('#city-service').value;
        let countryService = document.querySelector('#country-service').value;
        let peopleAmountService = document.querySelector('#peopleAmount-service').value;
        let characteristicsSservice = document.querySelector('#characteristics-service').value;

        // Crear un objeto FormData y agregar las variables
        var formData = new FormData();
        formData.append('nameService', nameService);
        formData.append('descriptionService', serviceDescript);
        formData.append('price', priceService);
        formData.append('location', locationService);
        formData.append('city', cityService);
        formData.append('country', countryService);
        formData.append('amountPeople', peopleAmountService);
        formData.append('characteristics', characteristicsSservice);
        formData.append('queryType','Insert');

        // Realizar la solicitud fetch
        fetch('../../control/services.control.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                // Manejar la respuesta del servidor (data)
            })
            .catch(error => {
                // Manejar errores
            });
    });




})