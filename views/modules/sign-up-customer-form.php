<section class="form-section" id="signup-section">
  <div class="form__container">
    <h2>Registrase</h2>

    <div class="square"></div>

    <form class="form" id="form">
      <label for="name" class="form__input">
        <!-- <span>Nombre:</span> -->
        <input id="name" type="text" name="name" placeholder="Nombre" onkeyup="validateInputData('name')">
        <!-- mensaje de error -->
        <span class="inactive">Ingrese un valor valido.</span>
      </label>

      <label for="last-name" class="form__input">
        <!-- <span>Last name:</span> -->
        <input id="last-name" type="text" name="last-name" placeholder="Last name" onkeyup="validateInputData('last-name')">
        <span class="inactive">Ingrese un valor valido.</span>
      </label>

      <label for="email" class="form__input">
        <!-- <span>Email:</span>  -->
        <input id="email" type="email" name="email" placeholder="Email" onkeyup="validateInputData('email')">
        <span class="inactive">Ingrese un valor valido.</span>
      </label>

      <label for="phone" class="form__input">
        <!-- <span>Telefono:</span>  -->
        <input id="phone" type="number" name="phone" placeholder="Telefono" onkeyup="validateInputData('phone')">
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

      <!-- password -->
      <label for="pass" class="form__input">
        <!-- <span>Password:</span> -->
        <input id="pass" type="password" name="pass" placeholder="Password" onkeyup="validateInputData('pass')">
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
  const customerFormButton = document.getElementById('form-button');
  customerFormButton.addEventListener('click', () => signUp('customer'));
</script>