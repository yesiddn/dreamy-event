document.addEventListener('DOMContentLoaded', function () {

    document.querySelector('#service-form-button').addEventListener('click', function () {

        const formService = document.querySelector('#newServiceForm');

        const formData = new FormData(formService);
        formData.set('queryType', 'Insert');

        const pictures = document.querySelector("#pictures-service-files");
        const allImages = pictures.files;


        console.log(allImages);

        for (let i = 0; i < allImages.length; i++) {
            formData.append('images[]', allImages[i]);
          };





        // Realizar la solicitud fetch
        fetch('control/services.control.php', {
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