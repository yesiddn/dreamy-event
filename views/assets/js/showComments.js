document.addEventListener('DOMContentLoaded', function () {
    // Función para cargar y mostrar comentarios
    function loadComments() {

        const idService = location.search.split('?/')[1];
      var objData = new FormData();
      objData.append("showComments", "OK");
      objData.append('idService', idService);
  
      fetch('./control/showcomments.control.php', {
        method: 'POST',
        body: objData,
      })
        .then(response => response.json())
        .then(data => {
          if (data.codigo === "200") {
            const opinionsContainer = document.getElementById('opinions-container');
            opinionsContainer.innerHTML = '';
  
            const comments = data.data;
            comments.forEach(opinion => {
              const opinionElement = document.createElement('div');
              opinionElement.classList.add('opinion');
  
              const usuarioElement = document.createElement('div');
              usuarioElement.classList.add('usuario');
              usuarioElement.textContent = `${opinion.name_customer} ${opinion.last_name_customer}`;
              opinionElement.appendChild(usuarioElement);
  
              const calificationElement = document.createElement('div');
              calificationElement.classList.add('calification');
              calificationElement.textContent = opinion.calificacion_comentario;
              opinionElement.appendChild(calificationElement);
  
              const commentElement = document.createElement('div');
              commentElement.classList.add('comment');
              commentElement.textContent = opinion.comentario;
              opinionElement.appendChild(commentElement);
  
              opinionsContainer.appendChild(opinionElement);
            });
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
  
    loadComments();
  });
  