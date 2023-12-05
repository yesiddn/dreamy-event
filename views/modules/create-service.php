
  <section class="form-section">

    <div class="form__container">
      <h2>Registrar nuevo <span class="primary">servicio</span></h2>

      <div class="square"></div>

      <form class="form" id="newServiceForm">

        <!-- name -->
        <label for="name_company" class="form__input">
          <input id="name-service" type="text" name="name-service" placeholder="Nombre Servicio"
            onkeyup="validateInputData('name-company')">
          <!-- mensaje de error -->
          <span class="inactive">Ingrese un valor valido.</span>
        </label>

        <!-- description -->
        <label for="description-service" class="form__input">
          Descripcion:
          <textarea class="txtArea" id="description-service" name="description-service" cols="3" rows="5"></textarea>
          <!-- mensaje de error -->
          <span class="inactive">Ingrese un valor valido.</span>
        </label>

        <!-- price -->
        <label for="price-service" class="form__input">
          <input id="price-service" type="number" name="price-service" placeholder="Precio">
          <span class="inactive">Ingrese un valor valido.</span>
        </label>

        <!-- location -->
        <label for="location-service" class="form__input">
          <input id="location-service" type="text" name="location-service" placeholder="Ubicacion">
          <!-- mensaje de error -->
          <span class="inactive">Ingrese un valor valido.</span>
        </label>

        <!-- city -->
        <label for="city-service" class="form__input">
          <input id="city-service" type="text" name="city-service" placeholder="Ciudad">
          <span class="inactive">Ingrese un valor valido.</span>
        </label>

        <!-- country -->
        <label for="country-service" class="form__input">
          <input id="country-service" type="text" name="country-service" placeholder="Pais">
          <span class="inactive">Ingrese un valor valido.</span>
        </label>


        <!-- people amount -->
        <label for="peopleAmount-service" class="form__input">
          <input id="peopleAmount-service" type="number" name="peopleAmount-service" placeholder="Cantidad de personas">
          <span class="inactive">Ingrese un valor valido.</span>
        </label>

        <!-- characteristics -->
        <label for="characteristics-service" class="form__input">
          Caracteriticas:
          <textarea class="txtArea" name="characteristics-description" id="characteristics-service" cols="3" rows="5"></textarea>
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
          Tipo de evento:
          <select name="type-service" id="type-service" onchange="validateInputData('event-type')">
            <option value="" hidden>Seleccione un tipo de servicio</option>

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





        <button type="button" id="service-form-button">Registrase</button>
      </form>
    </div>
  </section>

  <script src="../assets/js/create-service.js"></script>

