<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>Document</title>
</head>

<body>

    <section class="supplier__page__tittle">
        <h1>Servicios Pendientes</h1>
    </section>


    <section class="cards-container" id="cards__container">
        <div class="service__dash_card">
            <div class="event__header">
                <h3 title="tittle">Service name</h3>
                <div class="event__header__details">
                    <p>Fecha:<span class="highlight-text">10/12/2023</span></p>
                    <p>Ubicacion: <span class="highlight-text">location text</span></p>
                    <p>Direccion:<span class="highlight-text">Vereda Sirata</span></p>

                </div>
            </div>
            <div class="service__dash__customer__info">
                <div class="service__dash__profile__pic"></div>
                <p>user name</p>
                <p>correo@mail.com</p>
            </div>
            <div class="button-container">
                <!-- Aquí puedes agregar tu botonera -->
                <button>Contactar</button>
                <button>Completar</button>
                <!-- Agrega tantos botones como necesites -->
            </div>
        </div>

        <div class="service__dash_card">
            <div class="event__header">
                <h3 title="tittle">Service name</h3>
                <div class="event__header__details">
                    <p>Fecha:<span class="highlight-text">10/12/2023</span></p>
                    <p>Ubicacion: <span class="highlight-text">location text</span></p>
                    <p>Direccion:<span class="highlight-text">Vereda Sirata</span></p>

                </div>
            </div>
            <div class="service__dash__customer__info">
                <div class="service__dash__profile__pic"></div>
                <p>user name</p>
                <p>correo@mail.com</p>
            </div>
            <div class="button-container">
                <!-- Aquí puedes agregar tu botonera -->
                <button>Contactar</button>
                <button>Completar</button>
                <!-- Agrega tantos botones como necesites -->
            </div>
        </div>
    </section>


</body>

<style>
    .supplier__page__tittle {
        padding: 20px;
        text-align: center;
        margin: auto;
    }

    .event__header {
        width: 100%;
    }

    .service__dash__profile__pic {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-image: url('https://img.freepik.com/premium-photo/woman-front-laptop_950558-7349.jpg');
        background-size: cover;
    }

    .service__dash__customer__info {
        display: flex;
        flex-direction: column;
        align-items: center;
        row-gap: 5px;
    }

    .service__dash_card {
        display: grid;
        grid-template-columns: 5fr 3fr;
        grid-template-rows: 4fr 1fr;
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 15px var(--primary);
        text-decoration: none;
        color: var(--secondary);
    }

    .button-container {
        grid-area: 2 / 1 / 3 / 3;
        display: flex;
        justify-content: space-around;
    }

    .button-container button {
        margin-top: 7px;
        padding: 5px 15px 5px 15px;
        background-color: var(--primary);
        color: var(--white);
        text-decoration: none;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }
</style>




</html>