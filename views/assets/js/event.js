const form = document.getElementById('form');

form.addEventListener('submit', function (event) {
  event.preventDefault();
  createEvent();
});

function createEvent() {
  const nameEvent = document.getElementById('event-name').value;
  const dateEvent = document.getElementById('event-date').value;
  const address = document.getElementById('event-address').value;
  const city = document.getElementById('event-city').value;
  const country = document.getElementById('event-country').value;
  const typeEvent = document.getElementById('event-type').value;

  if (user) {
    const formData = new FormData();
    formData.append('action', 'create');
    formData.append('event-name', nameEvent);
    formData.append('event-date', dateEvent);
    formData.append('event-address', address);
    formData.append('event-city', city);
    formData.append('event-country', country);
    formData.append('event-type', typeEvent);
    formData.append('idCustomer', user.id_customer);

    fetch('control/event.control.php', {
      method: 'POST',
      body: formData,
    })
      .then((response) => response.json())
      .then((response) => {
        if (response.codigo === '200') {
          showAlert('event created successfully');

          if (location.search.includes('?/')) {
            addServiceToEvent(
              response.data.idEvent,
              location.search.split('?/')[1]
            );
            setTimeout(() => {
              window.location.href = `service?/${location.search.split('?/')[1]}`;
            }, 2000);
          } else {
            window.location.href = 'my-events';
          }
        }
      })
      .catch((error) => {
        console.error('Error:', error);
      });
  } else {
    showAlert('Without logging in');
  }
}
