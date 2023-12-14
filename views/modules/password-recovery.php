<section class="form-section">
    <div class="form__container">
        <h2>Restablecer contraseña</h2>
        <div class="square"></div>

        <form class="form" id="form">
            <p>Introduce la dirección de correo electrónico que usaste para registrarte.</p>
            <label id="emailLabel" for="email" class="form__input">
                <!-- <span>Email:</span>  -->
                <input id="email" type="email" name="email" placeholder="Email">
                <span class="inactive">Ingrese un valor valido.</span>
            </label>

            <button type="button" id="generate-code">Enviar</button>
        </form>
    </div>
</section>


<script>
    const resetFormButton = document.getElementById('generate-code');
    const emailInpt = document.querySelector('#email');
    let newBtn;

    resetFormButton.addEventListener('click', async () => {
        const newInputCode = await generateCode();
        if (newInputCode) {
            alert('boton 1 cliqueado');
            hola();
        }
    });


    function hola() {
    resetFormButton.parentNode.removeChild(resetFormButton);

    var codeValButton = document.createElement('button');
    codeValButton.type = 'button';
    codeValButton.id = 'alejo';
    codeValButton.textContent = 'Confirmar';

    const form = document.getElementById('form');
    form.appendChild(codeValButton);

    emailInpt.disabled = true;

    var newIptCodeLabel = document.createElement('label');
    newIptCodeLabel.setAttribute('for', 'nuevoEmail');
    newIptCodeLabel.className = 'form__input';

    var inputCode = document.createElement('input');
    inputCode.id = 'inputCode';
    inputCode.type = 'number';
    inputCode.name = 'recovery-code';
    inputCode.placeholder = 'Codigo';

    newIptCodeLabel.appendChild(inputCode);

    form.insertBefore(newIptCodeLabel, codeValButton);

    inputCode.addEventListener('input', function(event) {
        var inputValue = event.target.value;
        event.target.value = inputValue.replace(/[^0-9]/g, '').substring(0, 6);
    });
}


document.addEventListener('click', function(event) {
    if (event.target.id === 'alejo') {
        alert('¡Botón "alejo" clickeado fuera de la función hola!');
        validationCode();
    }
});

</script>