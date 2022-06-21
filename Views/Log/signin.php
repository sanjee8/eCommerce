<main class="form-signin w-100 m-auto text-center">

    <?php echo $response; echo $notif;?>

    <form action="" method="post" name="signin">
        <h1 class="h3 mb-3 fw-normal">Se connecter</h1>

        <div class="form-floating">
            <input type="email" class="form-control" id="email" name="email" placeholder="nom@example.com">
            <label for="email">Adresse mail</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
            <label for="password">Mot de passe</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Se souvenir de moi
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="signin">Connexion</button>

        <p class="mt-5 mb-3 text-muted">
            Vous n'êtes pas encore inscrit ? <a href="<?= $router->getLink("signup") ?>">Cliquez ici</a>
        </p>
    </form>
</main>