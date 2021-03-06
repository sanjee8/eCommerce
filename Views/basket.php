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
                                    <div>
                                        <p class="mb-1">Votre panier</p>
                                        <p class="mb-0">Vous avez <?= $basket["amount"] ?> articles dans votre panier</p>
                                        <?= $response ?>
                                    </div>
                                </div>
                                <?php
                                $i = 0;

                                    foreach ($products as $product) {
                                ?>
                                <div class="card mb-3" id="product_<?= $i ?>">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-row align-items-center">
                                                <div>
                                                    <img
                                                        src="<?= $product->image ?>"
                                                        class="img-fluid rounded-3" alt="Shopping item" style="width: 65px;">
                                                </div>
                                                <div class="ms-3">
                                                    <h5><?= $product->name ?></h5>
                                                    <p class="small mb-0"><?= $product->category ?></p>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center">
                                                <div style="width: 50px;">
                                                    <h5 class="fw-normal mb-0">1</h5>
                                                </div>
                                                <div style="width: 80px;">
                                                    <h5 class="mb-0"><?= $product->price ?>???</h5>
                                                </div>
                                                <a class="btn" href="<?= $router->getLink("basketDel", ["productId" => $i]) ?>" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                        $i++;
                                    }
                                    ?>


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



                                        <form action="<?= $router->getLink("order") ?>" method="post" class="mt-4">
                                            <div class="form-outline form-white mb-4">
                                                <input type="text" id="typeName" class="form-control form-control-lg" size="17"
                                                       placeholder="Cardholder's Name" />
                                                <label class="form-label" for="typeName">Cardholder's Name</label>
                                            </div>

                                            <div class="form-outline form-white mb-4">
                                                <input type="text" id="cardNumber" name="cardNumber" class="form-control form-control-lg" size="17"
                                                       placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                                                <label class="form-label" for="typeText">Card Number</label>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="form-outline form-white">
                                                        <input type="text" id="typeExp" name="typeExp" class="form-control form-control-lg"
                                                               placeholder="MM/YYYY" size="7" minlength="7" maxlength="7" />
                                                        <label class="form-label" for="typeExp">Expiration</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-outline form-white">
                                                        <input type="text" id="codeBack" name="codeBack" class="form-control form-control-lg"
                                                               placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                                                        <label class="form-label" for="typeText">Cvv</label>
                                                    </div>
                                                </div>
                                            </div>



                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between">
                                            <p class="mb-2">Sub total</p>
                                            <p class="mb-2"><?= $basket['price'] ?> ???</p>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <p class="mb-2">Frais de livraison</p>
                                            <p class="mb-2">5,00 ???</p>
                                        </div>

                                        <div class="d-flex justify-content-between mb-4">
                                            <p class="mb-2">Total</p>
                                            <p class="mb-2"><?= $basket['final'] ?> ???</p>
                                        </div>

                                        <div class="d-grid gap-2 ">

                                            <button type="submit" name="paymentOrder" class="btn btn-info btn-block btn-lg">
                                                <div class="d-flex justify-content-between">
                                                    <span><?= $basket['final'] ?> ???</span>
                                                    <span>Payer <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                </div>
                                            </button>
                                        </div>

                                        </form>


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