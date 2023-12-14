<li class="button-filter">
  <button class="button-filter-bar" id="filter__bar">
    <span>
      <img src="./views/assets/img/filter new.png" alt="Filters" class="filter__img" id="filter__img" height="20px" width="20px">
    </span> Filtros </button>

</li>

<div id="modal__filter" class="Modal__filter">

  <div class="modal-content">

    <header class="header-filter">

      <div class="column-filter1">
        <h4 id="title-modal-filter">Filtros</h4>
      </div>

      <div class="column-filter2">
        <button class="exit__filter" onclick="closeModal()">
          <img src="./views/assets/img/salir filtro.png" alt="Salir" height="25px" width="25px">
        </button>
      </div>

    </header>


    <section class="filter_elements">
      <div class="scroll-container">
        <h3>Ubicación</h3>

        <div class="button_places row">

          <div>
            <label>Ciudad: <input list="ciudades-colombia" name="ciudades-colombia" /></label>
            <datalist id="ciudades-colombia">
            </datalist>
          </div>

        </div>
      </div>
    </section>


    <section class="filter_elements">
      <div class="scroll-container">
        <div class="mb-3" style="display:grid;">
          <h3>Rango de precio</h3>
          <div>
            <label for="min__Price">Precio mínimo:</label>
            <input type="number" id="min__Price" min="50000" style="width: 168px;height: 38px;" placeholder="Mínimo">
          </div>
          <div>
            <label for="max__Price">Precio máximo:</label>
            <input type="number" id="max__Price" min="60000" style="width: 168px;height: 38px;" max="10000000" placeholder="Máximo">
          </div>
        </div>
      </div>
    </section>


    <section class="filter_elements">
      <div class="scroll-container">
        <div class="mb-3">
          <h3>Servicios</h3>
          <div class="checkbox-grid">
            <div class="checkbox-row">
              <input type="checkbox" id="cake__shop">
              <label for="cake__shop">Pasteleria</label>
            </div>

            <div class="checkbox-row">
              <input type="checkbox" id="logistics">
              <label for="logistics">Logística</label>
            </div>

            <div class="checkbox-row">
              <input type="checkbox" id="decor">
              <label for="decor">Decoración</label>
            </div>

            <div class="checkbox-row">
              <input type="checkbox" id="catering">
              <label for="catering">Catering</label>
            </div>

            <div class="checkbox-row">
              <input type="checkbox" id="music">
              <label for="music">Música</label>
            </div>

            <div class="checkbox-row">
              <input type="checkbox" id="photography">
              <label for="photography">Fotografia</label>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="filter_elements">
      <div class="scroll-container">
        <div class="mb-3 input__amount">
          <h3>Aforo</h3>

          <div>
            <label for="min__amount">Cantidad mínima:</label>
            <input type="number" id="min__amount" min="10" style="width: 168px;height: 38px;" placeholder="Mínimo">
          </div>

          <div>
            <label for="max__amount">Cantidad máxima:</label>
            <input type="number" id="max__amount" min="30" max="3000" style="width: 168px;height: 38px;" placeholder="Máximo">
          </div>
        </div>
      </div>
    </section>

    <div class="filter__container-button">
      <button onclick="filterByPrice()">Aplicar filtro</button>
    </div>
  </div>

  <script>
    const cities = fetch('https://www.datos.gov.co/resource/xdk5-pm3f.json?$query=SELECT%20municipio', {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        }
      }).then(response => response.json())
      .then(data => {
        const ciudades = document.getElementById('ciudades-colombia');
        data.forEach(element => {
          const option = document.createElement('option');
          option.value = element.municipio;
          ciudades.appendChild(option);
        });
      });

    document.getElementById("filter__bar").addEventListener("click", function() {
      document.getElementById("modal__filter").style.display = "flex";
      document.body.style.overflow = 'hidden';
    });

    function closeModal() {
      document.getElementById('modal__filter').style.display = 'none'
      document.body.style.overflow = 'auto';
    }
  </script>
</div>