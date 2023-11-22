<body>
  <header>
    <div>
      <a href="home" class="logo">
        <img src="./views/assets/svg/logo.svg" alt="Logo Dreamy Event">
      </a>

      <form action="./search.html" class="search-bar">
        <input type="text" name="search" id="search" placeholder="Buscar">
        <button type="submit"></button>
      </form>

      <nav class="nav-bar">
        <button type="button" class="hamburguer-menu">
          <span></span>
          <span id="user-profile-img"></span>
        </button>
        <ul class="inactive">
          <?php
            if (isset($_SESSION["user"])) {
              echo '
                <li><a href="profile">Mi perfil</a></li>
                <li><a href="my-favorites">Mis favoritos</a></li>
                <li><a href="log-out">Cerrar sesión</a></li>
              ';
            } else {
              echo '
                <li><a href="log-in">Iniciar sesión</a></li>
                <li><a href="sign-up">Registrarse</a></li>
              ';
            }
          ?>
        </ul>
      </nav>
    </div>

    <script defer src="./views/assets/js/nav-bar.js"></script>
  </header>
  
  <main>
