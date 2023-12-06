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


    <section class="cards-container" id="cards__container">


        <div class="service__dash_card">
            <div class="event__header">
                <h3 title="tittle">Service name</h3>
                <div class="event__header__details">
                    <p>Ubicacion: <span class="highlight-text">location text</span></p>
                    <p>Direccion:<span class="highlight-text">Vereda Sirata</span></p>
                </div>
            </div>

            <div class="service__dash__customer__info">
                <div class="service__dash__profile__pic"></div>
                <p>user</p>
                <p>correo</p>
            </div>
        </div>


        <div class="service__dash_card">
            <div class="event__header">
                <h3 title="tittle">Service name</h3>
                <div class="event__header__details">
                    <p>Ubicacion: <span class="highlight-text">location text</span></p>
                    <p>Direccion:<span class="highlight-text">Vereda Sirata</span></p>
                </div>
            </div>

            <div class="service__dash__customer__info">
                <div class="service__dash__profile__pic"></div>
                <p>user</p>
                <p>correo</p>
            </div>
        </div>
    </section>


</body>

<style>
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
        position: relative;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        width: 100%;
        max-width: 400px;
        gap: 2rem;
        margin: 0 auto;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 5px 15px var(--primary);
        text-decoration: none;
        color: var(--secondary);
    }

    
</style>




</html>