<section class="form-section">
    <div class="form__container">
        <h2>Restablecer contraseña</h2>
        <div class="square"></div>

        <form class="form" id="form">
            <p>Introduce la dirección de correo electrónico que usaste para registrarte.</p>
            <label id="emailLabel" for="email" class="form__input">
                <!-- <span>Email:</span>  -->
                <input id="email" type="email" name="email" placeholder="Email" onkeyup="validateInputData('email')" disabeld>
                <span class="inactive">Ingrese un valor valido.</span>
            </label>

            <button type="button" id="generate-code">Enviar</button>
        </form>
    </div>
</section>


<script>
    const loginFormButton = document.getElementById('generate-code');
    const emailInpt = document.querySelector('#email');
    let newBtn;

    loginFormButton.addEventListener('click', async () => {

        const newInputCode = await generateCode();
        if (newInputCode) {
            hola();
        };
    });



    function hola() {

        /* contenido dinamico con un nuevo input para el codigo */ 
        emailInpt.disabled = true;


        var nuevoLabel = document.createElement('label');
        nuevoLabel.setAttribute('for', 'nuevoEmail');
        nuevoLabel.className = 'form__input';

    
        var inputCode = document.createElement('input');
        inputCode.id = 'nuevoEmail';
        inputCode.type = 'number';
        inputCode.name = 'recovery-code';
        inputCode.placeholder = 'Codigo';

        nuevoLabel.appendChild(inputCode);

        const form = document.getElementById('form');
        let button = document.getElementById('generate-code');

        form.insertBefore(nuevoLabel, button);

        inputCode.addEventListener('input', function(event) {
            var inputValue = event.target.value;
            event.target.value = inputValue.replace(/[^0-9]/g, '').substring(0, 6);
        })


        button.id = 'alejo';
        newBtn.addEventListener('click', function() {

            alert('Nuevo evento con el botón alejo');
        });



 
    };
</script>