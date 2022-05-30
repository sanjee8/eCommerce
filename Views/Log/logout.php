<section class="bg-gray">
    <div class="container form-container pt-5">
        <div class="row justify-content-between justify-content-md-center pt-5">

            <div class="col-md-8 flex-md-first align-self-center mb-5 text-center">
                <div class="mb-5">
                    <h1 class="text-uppercase mb-3 mt-0" style="font-size: 50px"><i class="fa fa-circle-o-notch fa-spin"></i> Déconnexion en cours ..</h1>
                    <p class="text-under-forms text-uppercase">
                        Vous allez bientôt être redirigé vers la page d'accueil. <br />
                        Si vous n'êtes pas redirigé au bout de 5 secondes, <a href="<?= $link ?>">cliquez ici</a>.
                    </p>
                </div>

                <script type="text/javascript">
                    setTimeout(function(e) {
                        window.location.replace("<?= $link ?>");
                    }, 2000);
                </script>


            </div>
        </div>
    </div>
</section>