<section class="h-100 h-custom" >
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card">
                    <div class="card-body p-4">

                        <div class="row">

                            <div class="col-lg-7">
                                <h5 class="mb-3"><a href="<?= $router->getLink("home") ?>" class="text-body"><i
                                                class="fas fa-long-arrow-alt-left me-2"></i>Continuer mes achats</a></h5>
                                <hr>

                                <div class="d-flex justify-content-between align-items-center mb-4">

                                    <div class="h-100 p-5 text-white bg-success p-2 text-white bg-opacity-75 rounded-3">
                                        <h2>Merci pour votre commande !</h2>
                                        <p>
                                            Votre commande a été passé avec succès ! Votre commande sera livré dans les meilleus délais.
                                        </p>
                                    </div>

                                </div>

                            </div>

                            <div class="col-lg-5">

                                <div class="card bg-primary text-white rounded-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <h5 class="mb-0">Card details</h5>

                                            <div>

                                                <a href="#!" type="submit" class="text-white"><i
                                                            class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                                                <a href="#!" type="submit" class="text-white"><i
                                                            class="fab fa-cc-visa fa-2x me-2"></i></a>
                                                <a href="#!" type="submit" class="text-white"><i
                                                            class="fab fa-cc-amex fa-2x me-2"></i></a>
                                                <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>
                                            </div>

                                        </div>


                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between">
                                            <p class="mb-2">Sub total</p>
                                            <p class="mb-2"><?= $basket['price'] ?> €</p>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <p class="mb-2">Frais de livraison</p>
                                            <p class="mb-2">5,00 €</p>
                                        </div>

                                        <div class="d-flex justify-content-between mb-4">
                                            <p class="mb-2">Total</p>
                                            <p class="mb-2"><?= $basket['final'] ?> €</p>
                                        </div>

                                        <div class="d-grid gap-2 ">

                                            <button type="button" class="btn btn-info btn-block btn-lg disabled">
                                                <div class="d-flex justify-content-between">
                                                    <span><?= $basket['final'] ?> €</span>
                                                    <span>Payé <i class="fas fa-check ms-2"></i></span>
                                                </div>
                                            </button>
                                        </div>


                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>