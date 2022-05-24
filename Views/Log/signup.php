<main class="w-100 m-auto text-center " style="max-width: 330px;">
    <?php echo $response;?>

    <form action="" method="post" name="signup">
        <h1 class="h3 mb-3 fw-normal">S'inscrire</h1>

        <div class="form-floating pb-1">
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom">
            <label for="nom">Votre nom</label>
        </div>

        <div class="form-floating pb-3">
            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom">
            <label for="prenom">Votre prénom</label>
        </div>

        <div class="form-floating pb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="nom@example.com">
            <label for="email">Adresse mail</label>
        </div>


        <div class="form-floating pb-1">
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
            <label for="password">Mot de passe</label>
        </div>

        <div class="form-floating pb-3">
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Mot de passe">
            <label for="confirm_password">Confirmez le mot de passe</label>
        </div>



        <button class="w-100 btn btn-lg btn-primary" name="signup" type="submit">S'inscrire</button>

        <p class="mt-5 mb-3 text-muted">
            Vous êtes déjà inscrit ? <a href="<?= $router->getLink("signin") ?>">Cliquez ici</a>
        </p>
    </form>
</main>