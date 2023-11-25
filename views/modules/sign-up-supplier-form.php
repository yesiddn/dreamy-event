<section class="form-section">
  <div class="form__container">
    <h2>Registrarse como <span class="primary">proveedor</span></h2>

    <div class="square"></div>

    <form class="form" id="form">
      <label for="name" class="form__input">
        <!-- <span>Nombre:</span> -->
        <input id="name" type="text" name="name" placeholder="Nombre de proveedor" onkeyup="validateInputData('name')">
        <!-- mensaje de error -->
        <span class="inactive">Ingrese un valor valido.</span>
      </label>

      <label for="email" class="form__input">
        <!-- <span>Email:</span>  -->
        <input id="email" type="email" name="email" placeholder="Email de contacto" onkeyup="validateInputData('email')">
        <span class="inactive">Ingrese un valor valido.</span>
      </label>

      <label for="phone" class="form__input">
        <!-- <span>Telefono:</span>  -->
        <input id="phone" type="number" name="phone" placeholder="Telefono de contacto" onkeyup="validateInputData('phone')">
        <span class="inactive">Ingrese un valor valido.</span>
      </label>

      <label for="rut" class="form__input">
        <!-- <span>Telefono:</span>  -->
        <input id="rut" type="number" name="rut" placeholder="RUT" onkeyup="validateInputData('rut')">
        <span class="inactive">Ingrese un valor valido.</span>
      </label>

      <!-- city -->
      <label for="city" class="form__input">
        <!-- <span>Ciudad:</span>  -->
        <input id="city" type="text" name="city" placeholder="Ciudad" onkeyup="validateInputData('city')">
        <span class="inactive">Ingrese un valor valido.</span>
      </label>

      <!-- country -->
      <label for="country" class="form__input">
        <!-- <span>Pais:</span>  -->
        <input id="country" type="text" name="country" placeholder="Pais" onkeyup="validateInputData('country')">
        <span class="inactive">Ingrese un valor valido.</span>
      </label>

      <!-- img -->
      <label for="img" class="form__input">
        Foto de perfil:
        <input id="img" type="file" name="img" placeholder="Imagen" onchange="validateInputData('img')" accept="image/*">
        <span class="inactive">Seleccione un tipo de archivo correcto.</span>
      </label>

      <button type="button" id="form-button">Registrase</button>
    </form>
  </div>
</section>

<script>
  const supplierFormButton = document.getElementById('form-button');
  supplierFormButton.addEventListener('click', () => signUp('supplier'));
</script>