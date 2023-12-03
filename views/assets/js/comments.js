document.addEventListener('DOMContentLoaded', function () {
    const commentForm = document.querySelector('.commentForm');
  
    commentForm.addEventListener('submit', function (event) {
        event.preventDefault();
  
      const commentTextarea = document.getElementById('comment-textarea');
      const stars = document.querySelector('input[name="stars"]:checked');
      const idService = location.search.split('?/')[1];
  
      const formData = new FormData();
      formData.append('action', 'create');
      formData.append('comment', commentTextarea.value);
      formData.append('ratingComment', stars ? stars.value : ''); 
      formData.append('idCustomer', customer.id_customer);
      formData.append('idService', idService);
  
      fetch('./control/comments.control.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        console.log(data);
        showAlert('comment-exists');
      })
      .catch(error => {
        console.error('Error:', error);
        showAlert('comment-no-exists');
      });
    });
  });
  