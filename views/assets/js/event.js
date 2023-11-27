const form = document.getElementById('form');

form.addEventListener('submit', function (event) {
  event.preventDefault();
  createEvent();
});

function createEvent() {
  const nameEvent = document.getElementById('event-name').value;
  const dateEvent = document.getElementById('event-date').value;
  const typeEvent = document.getElementById('event-type').value;

  if (user) {
    const formData = new FormData();
    formData.append('action', 'create');
    formData.append('event-name', nameEvent);
    formData.append('event-date', dateEvent);
    formData.append('event-type', typeEvent);
    formData.append('idCustomer', user.id_customer);

    fetch('control/event.control.php', {
      method: 'POST',
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.codigo === '200') {
          document.getElementById('event-name').value = '';
          document.getElementById('event-date').value = '';
          document.getElementById('event-type').value = '';
        }
      })
      .catch((error) => {
        console.error('Error:', error);
      });
  } else {
    showAlert('Without logging in');
  }
}
