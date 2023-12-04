<section class="info-service">
  <!-- <div class="info-service__gallery">
    4 images
    <img
      src="https://images.unsplash.com/photo-1696388790726-68161096266e?auto=format&fit=crop&q=80&w=2070&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
      alt="">
  </div>

  <div class="info-service__details">
    <div>
      <div class="info-service__details__header">
        <div class="info-service__details__header__title">
          <h2>Habitación con vista a las montañas</h2>
          <p>Oslo, Noruega</p>
        </div>

        <div class="info-service__details__header__rating">
          <p>4.5⭐</p>
        </div>
      </div>

      <div class="info-service__details__body">
        <p>
          Descripcion del servicio.
        </p>
      </div>
    </div>

    <div class="info-service__details__price-card">
      <span>1000€ / 24h</span>
      <button>Reservar</button>
    </div>
  </div> -->
  <script defer src="./views/assets/js/events.js"></script>
</section>

<section class="comments__container">
  <form class="commentForm">
    <div class="comments__content">
      <textarea name="comment-textarea" id="comment-textarea" cols="60" rows="10" placeholder="Comparte detalles de tu experiencia en este lugar"></textarea>
      <div class="stars">
        <input type="radio" id="star5" name="stars" value="5">
        <label for="star5"></label>
        <input type="radio" id="star4" name="stars" value="4">
        <label for="star4"></label>
        <input type="radio" id="star3" name="stars" value="3">
        <label for="star3"></label>
        <input type="radio" id="star2" name="stars" value="2">
        <label for="star2"></label>
        <input type="radio" id="star1" name="stars" value="1">
        <label for="star1"></label>
      </div>
      <h3>Calificación del servicio</h3>
    </div>
    <div class="button__container">
      <button type="submit">Agregar</button>
    </div>
  </form>
</section>

<section class="opinions">
  <h2>Opiniones de Usuarios</h2>
  <div class="opinions-container" id="opinions-container">

  </div>

  <script src='views/assets/js/comments.js'></script>
  <script src='views/assets/js/showComments.js'></script>
</section>