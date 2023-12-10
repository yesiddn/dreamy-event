
  <section class="form-section">

    <div class="form__container">
      <h2>Registrar <span class="primary">servicio</span></h2>

      <div class="square"></div>

      <form class="form" id="newServiceForm" method="post">

        <!-- name -->
        <label for="name-service" class="form__input">
          Nombre Servicio:
          <input id="name-service" type="text" name="name-service" placeholder="Nombre Servicio"
            onkeyup="validateInputData('name-service')">
          <!-- mensaje de error -->
          <span class="inactive">Ingrese un valor valido.</span>
        </label>

        <!-- description -->
        <label for="description-service" class="form__input">
          Descripción:
          <textarea class="txtArea" id="description-service" name="description-service" cols="3" rows="5"></textarea>
          <!-- mensaje de error -->
          <span class="inactive">Ingrese un valor valido.</span>
        </label>

        <!-- price -->
        <label for="price-service" class="form__input">
          Precio:
          <input id="price-service" type="number" name="price-service" placeholder="Precio"  onkeyup="validateInputData('price-service')">
          <span class="inactive">Ingrese un valor valido.</span>
        </label>

        <!-- location -->
        <label for="location-service" class="form__input">
          Ubicación:
          <input id="location-service" type="text" name="location-service" placeholder="Ubicación" onkeyup="validateInputData('location-service')">
          <span class="inactive">Ingrese un valor valido.</span>
        </label>

        <!-- city -->
        <label for="city-service" class="form__input">
          Ciudad:
          <input id="city-service" type="text" name="city-service" placeholder="Ciudad" onkeyup="validateInputData('city-service')">
          <span class="inactive">Ingrese un valor valido.</span>
        </label>

        <!-- country -->
        <label for="country-service" class="form__input">
          País:
          <input id="country-service" type="text" name="country-service" placeholder="País" onkeyup="validateInputData('country-service')">
          <span class="inactive">Ingrese un valor valido.</span>
        </label>


        <!-- people amount -->
        <label for="peopleAmount-service" class="form__input">
        Cantidad de personas:
          <input id="peopleAmount-service" type="number" name="peopleAmount-service" placeholder="Cantidad de personas" onkeyup="validateInputData('peopleAmount-service')">
          <span class="inactive">Ingrese un valor valido.</span>
        </label>

        <!-- characteristics -->
        <label for="characteristics-service" class="form__input">
          Características:
          <textarea class="txtArea" name="characteristics-service" id="characteristics-service" cols="3" rows="5" onkeyup="validateInputData('characteristics-service')"></textarea>
          <!-- mensaje de error -->
          <span class="inactive">Ingrese un valor valido.</span>
        </label>


        <!-- file -->
        <label for="pictures-service-files" class="form__input">
          Sube una o varias imagenes:
          <input type="file" id="pictures-service-files" multiple>
          <!-- mensaje de error -->
          <span class="inactive">Ingrese un valor valido.</span>
        </label>

        <!-- service type -->
        <label for="type-service" class="form__input">
          Tipo de servicio:
          <select name="type-service" id="type-service" onchange="validateInputData('type-service')">
            <option value="" hidden>Seleccione un tipo de servicio</option>

            <option value="1">Alojamiento</option>

            <option value="2">Decoracion</option>

            <option value="3">Musica</option>

            <option value="4">Catering</option>

            <option value="5">Comida</option>

            <option value="6">Logística</option>

            <option value="7">Audiovisual</option>

            <option value="8">Marketing</option>
          </select>

          <span class="inactive">Ingrese un valor valido.</span>
        </label>

        <button type="submit" id="service-form-button">Registrar</button>
      </form>
    </div>
    <script defer src="./views/assets/js/create-service.js"></script>
  </section>



