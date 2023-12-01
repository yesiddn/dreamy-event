<section class="form-section">

  <div class="form__container">
    <h2>Crear <span class="primary">Evento</span></h2>

    <div class="square"></div>

    <form class="form" id="form" method="post">

      <!-- name event  -->
      <label for="event-name" class="form__input">
        Nombre del evento:
        <input id="event-name" type="text" name="event-name" placeholder="Nombre del evento" onkeyup="validateInputData('event-name')">

        <span class="inactive">Ingrese un valor valido.</span>
      </label>

      <!-- date event  -->
      <label for="event-date" class="form__input">
        Fecha/Hora:
        <input id="event-date" type="datetime-local" name="event-date" placeholder="Fecha" onchange="validateInputData('event-date')">

        <span class="inactive">Ingrese un valor valido.</span>
      </label>

      <!-- type event -->
      <label for="event-type" class="form__input">
        Tipo de evento:

        <select name="event-type" id="event-type" onchange="validateInputData('event-type')">
          <option value="" hidden>Seleccione un tipo de evento</option>

          <option value="1">Boda</option>

          <option value="2">Fiesta de cumpleaños</option>

          <option value="3">Baby showers</option>

          <option value="4">Conferencia/Seminario</option>

          <option value="5">Quince años</option>

          <option value="6">Reunión corporativa</option>

          <option value="7">Feria/Exposición</option>

          <option value="8">Celebración familiar</option>

          <option value="9">Bautizo</option>

          <option value="10">Comunión</option>

          <option value="11">Confirmación</option>

          <option value="12">Graduación</option>
        </select>

        <span class="inactive">Ingrese un valor valido.</span>
      </label>

      <button type="submit" id="form-button">Crear</button>
    </form>
  </div>
</section>

<script src="./views/assets/js/events.js"></script>
<script defer src="./views/assets/js/event.js"></script>
<!-- <script>
    const newEventFormButton = document.getElementById('form-button');
    newEventFormButton.addEventListener('click', () => createUser('event'));
  </script> -->