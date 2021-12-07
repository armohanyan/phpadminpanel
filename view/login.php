<?php include './includes/header.php' ?>
<link rel="stylesheet" href="../resource/css/style.css">
</head>
<style>
    body {
        background-image: url("https://images.unsplash.com/photo-1502945015378-0e284ca1a5be?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 100vh;
    }
</style>

<body>
    <div class="register">
        <div class="login">
            <div class="content">
                <div class="errors">
                    <?php
                    session_start();
                    if (array_key_exists('errors',  $_SESSION)) { ?>
                        <span><?php echo $_SESSION['errors'][0] ?></span>
                    <?php session_destroy();
                    } ?>
                </div>
                <div class="signupc">
                    <span class="content-span">Sign Up</span>
                    <p>Lorem ipsum dolor sit amet, consect adielit integer imperd.</p>
                </div>
                <div class="signinc">
                    <span class="content-span">Sign In</span>
                    <p>Lorem ipsum dolor vestibu tortor purus, id tristi libero tempus et.</p>
                </div>
            </div>

            <div class="inputs">
                <div class="signini">
                    <form action="../controllers/UserController.php" method="post">
                        <div>
                            <span class="material-icons">person</span>
                            <input type="text" name="username" placeholder="Username" />
                        </div>
                        <div>
                            <span class="material-icons">password</span>
                            <input type="password" name="password" class="pswrdin" placeholder="Your password" />
                            <span class="material-icons visin" onclick="changein()">visibility</span>
                        </div>
                        <div>
                            <input type="submit" name="submitSignIn" class="b btn" value="Sign In" />
                            <input type="button" class="btn" value="Sign Up" onclick="showsup()" />
                        </div>
                    </form>
                </div>
                <!-- Register -->
                <div class="signupi">
                    <form action="../controllers/UserController.php" method="post">
                        <div>
                            <span class="material-icons">person</span>
                            <input type="text" name="username" placeholder="Username" />
                        </div>
                        <div>
                            <span class="material-icons">email</span>
                            <input type="email" name="email" placeholder="Your email" />
                        </div>
                        <div>
                            <span class="material-icons">password</span>
                            <input type="password" name="password" class="pswrdup" placeholder="Your password" />
                            <span class="material-icons visup" onclick="changeup()">visibility</span>
                        </div>
                        <div>
                            <!-- <span class="material-icons">email</span> -->
                            <input type="number" min="10" name="age" placeholder="Your age" required/>
                        </div>  
                        <div style="border:none">
                            <input type="submit" name="submitSignUp" class="b btn" value="Sign Up"/>
                            <input type="button" class="btn" value="Sign In" onclick="showsin()" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="message" onclick="reset()">
        </div>
    </div>
</body>
<script src="../resource/js/main.js"></script>

</html>