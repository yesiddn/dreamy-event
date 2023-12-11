<section class="form-section">
    <div class="form__container">
        <h2>Restablecer contraseña</h2>
        <div class="square"></div>

        <form class="form" id="form">
            <p>Introduce la dirección de correo electrónico que usaste para registrarte.</p>
            <label id="emailLabel" for="email" class="form__input">
                <!-- <span>Email:</span>  -->
                <input id="email" type="email" name="email" placeholder="Email" onkeyup="validateInputData('email')">
                <span class="inactive">Ingrese un valor valido.</span>
            </label>
            
            <button type="button" id="generate-code">Enviar</button>
        </form>
    </div>
</section>


<script>
    const loginFormButton = document.getElementById('generate-code');
    loginFormButton.addEventListener('click', () => generateCode());

</script>