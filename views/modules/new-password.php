<section class="form-section">
    <div class="form__container">
        <h2>Nueva contraseña</h2>
        <div class="square"></div>

        <form class="form" id="form">

            <label for="pass" class="form__input">
                <input id="pass" type="password" name="pass" placeholder="Nueva contraseña">
            </label>

            <label for="pass2" class="form__input"> <!-- Cambié el id a "pass2" -->
                <input id="pass2" type="password" name="pass2" placeholder="Confirma tu contraseña">
            </label>

            <button type="button" id="setNewPassword">Guardar</button>
        </form>
    </div>
</section>


<script>
    const setNewPasswordButton = document.getElementById('setNewPassword');
    setNewPasswordButton.addEventListener('click', NewPassword);

    function NewPassword() {
        const newPass1 = document.getElementById('pass').value;
        const newPass2 = document.getElementById('pass2').value;

        if (newPass1 === newPass2) {
            setNewPassword(newPass1);

        } else {
            showAlert('password mismatch Validator');
        }
    }
</script>