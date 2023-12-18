document.addEventListener('DOMContentLoaded', function () {
  document
    .querySelector('#service-form-button')
    .addEventListener('click', function (e) {
      e.preventDefault();
      const formService = document.querySelector('#newServiceForm');

      const formData = new FormData(formService);

      const idSupplier = getSupplierId();
      if (idSupplier) {
        formData.append('id_supplier', idSupplier);
      }

      formData.set('action', 'create');

      const pictures = document.querySelector('#pictures-service-files');
      const allImages = pictures.files;
      console.log(allImages);

      for (let i = 0; i < allImages.length; i++) {
        formData.append('images[]', allImages[i]);
      }

      // Realizar la solicitud fetch
      fetch('control/services.control.php', {
        method: 'POST',
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          showAlert('service created');
          setTimeout(() => (window.location = 'my-services'), 2000);
        })
        .catch((error) => {});
    });
});

function getSupplierId() {
  const userData = localStorage.getItem('user');
  if (userData) {
    const user = JSON.parse(userData);
    if (user && user.supplier && user.supplier.id_supplier) {
      return user.supplier.id_supplier;
    }
  } else {
    console.error('Datos del provvedor no encontrados');
    return null;
  }
}
