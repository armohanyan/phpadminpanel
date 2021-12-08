<?php include './includes/header.php' ?>

<style>
  html,

  body {
    background-image: url("https://images.unsplash.com/photo-1502945015378-0e284ca1a5be?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    height: 100vh;
  }

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;

  }

  ul {
    margin: 0;
    padding: 0;
    border: 0;
    width: 100%;
    height: auto;
    overflow: hidden;
    font-family: sans-serif;
  }

  .nav {
    display: flex;
    border: 1px solid #e5e5e5;
    padding: 1rem 4rem 1rem 4rem;
    justify-content: space-between;
    background-color: white;
    align-items: center;
    /*  podendo usar o margin para estilizar onde quiser o menu, no meu caso, quero ele sem encostar nas laterais para que possamos ver o destaque dele do restante da tela  */
  }

  .navButtons {
    display: flex;
    align-items: center;
    height: 30px;
  }

  .navButtons ul {
    display: flex;
    align-items: center;
    gap: 2.5rem;
    list-style-type: none;
  }

  .navButtons ul li:hover {
    text-decoration: underline;
  }

  nav.nav .buttonsLogin {
    display: flex;
    gap: 1rem;
    align-items: center;
  }

  nav.nav .buttonsLogin a {
    border: none;
    padding: 10px;
    border-radius: 0.3rem;
    width: 100px;
    text-decoration: none;
    background-color: #61a5c2;
    color: white;
  }
</style>

<body>
  <div class="divNav">
    <nav class="nav">
      <div class="navButtons"></div>
      <div class="buttonsLogin">
        <a href="./login.php">Sign In</a>
        <a href="./login.php">Log In</a>
      </div>
    </nav>
  </div>
</body>
<script src="../resource/js/main.js"></script>

</html>