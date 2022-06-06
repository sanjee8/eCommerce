<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">Mes commandes</h1>
</div>

<main>

    <div class="row">

        <div class="accordion accordion-flush" id="ordersHistory">
            <?php
            $i = 0;
            foreach ($orders as $order) { ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-order<?= $i; ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-orderContent<?= $order->id ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                        Commande N°<?= $order->id ?>
                    </button>
                </h2>
                <div id="flush-orderContent<?= $order->id ?>" class="accordion-collapse collapse" aria-labelledby="flush-order<?= $i; ?>" data-bs-parent="#ordersHistory">
                    <div class="accordion-body">
                        <div class="list-group w-auto">

                            <?php foreach ($productsOf[$order->id] as $product) {  ?>
                            <a class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                                <img src="<?= $product->image ?>" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
                                <div class="d-flex gap-2 w-100 justify-content-between">
                                    <div>
                                        <h6 class="mb-0"><?= $product->name ?></h6>
                                        <p class="mb-0 opacity-75"><?= $product->category ?></p>
                                    </div>
                                    <small class="opacity-50 text-nowrap"><?= $product->paid ?>€</small>
                                </div>
                            </a>
                            <?php } ?>
                        </div>

                    </div>
                </div>
            </div>
            <?php
                $i++;
            }
            ?>

        </div>

    </div>

</main>