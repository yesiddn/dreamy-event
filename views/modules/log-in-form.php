<section class="form-section inactive" id="login-section">

  <div class="form__container">
    <h2>Bienvenido a <span class="primary">Dreamy Event</span></h2>

    <div class="square"></div>

    <form class="form" id="form">
      <label for="email" class="form__input">
        <!-- <span>Email:</span>  -->
        <input id="email" type="email" name="email" placeholder="Email" onkeyup="validateInputData('email')">
        <span class="inactive">Ingrese un valor valido.</span>
      </label>

      <!-- password -->
      <label for="pass" class="form__input">
        <!-- <span>Password:</span> -->
        <input id="pass" type="password" name="pass" placeholder="Password" onkeyup="validateInputData('pass')">
        <span class="inactive">Ingrese un valor valido.</span>
      </label>

      <button type="button" id="log-in-form-button">Entrar</button>
    </form>
  </div>
</section>

<script>
  const loginFormButton = document.getElementById('log-in-form-button');
  loginFormButton.addEventListener('click', () => loginUser());
</script>