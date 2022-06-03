<div class="pricing-header p-3 pb-md-4 mx-auto text-center">
    <h1 class="display-4 fw-normal">Nos articles</h1>
</div>


<div class="pb-3">
    <div class="d-flex flex-row-reverse">
        <div class="dropdown">
            <button class="btn btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Tirer l'affichage dans l'ordre <i class="fa fa-solid fa-chevron-down"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="<?= $links[0]; ?>">Trier dans l'ordre croissant</a></li>
                <li><a class="dropdown-item" href="<?= $links[1]; ?>">Trier dans l'ordre décroissant</a></li>
            </ul>
        </div>
    </div>
</div>
<main>

    <div class="row">

        <div class="col-3">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-1 text-center">
                    <h4 class="my-0 fw-normal">FILTRES</h4>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <a href="<?= $router->getLink("home"); ?>" class="btn btn-sm btn-success">Réinitialiser le filtre</a>
                    </div>

                    <div class="form-check form-switch py-2">
                        <input class="form-check-input" type="checkbox" checked role="switch" id="categories_toggle">
                        <label class="form-check-label" for="categories_toggle">Afficher les catégories</label>
                    </div>

                    <div id="filter-categories">
                        <?php foreach ($categories as $category) { ?>
                        <div class="form-check form-check-inline">
                            <a class="btn btn-light btn-sm inline" href="<?= $router->getLink("productsCat", ["catName" => $category->name,"catId" => $category->id]) ?>">» <?= $category->name ?></a>
                        </div>
                        <?php } ?>
                    </div>


                    <div class="form-check form-switch py-2 pt-4">
                        <input class="form-check-input" type="checkbox" checked role="switch" id="showPrices">
                        <label class="form-check-label" for="showPrices">Afficher les tranches</label>
                    </div>

                    <div id="filter-prices">

                        <label for="minPrice" class="form-label">Prix minimum</label>
                        <input type="range" class="form-range" id="minPrice">

                        <label for="maxPrice" class="form-label">Prix maximum</label>
                        <input type="range" class="form-range" id="maxPrice">

                    </div>

                </div>
            </div>
        </div>

        <div class="col-9">

            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                <?php foreach ($products as $product ) { ?>
                <div class="col">
                    <div id="product_<?= $product->id ?>_content" class="card mb-4 shadow-sm">
                        <div class="card-header py-3 bg-white">
                            <img name="image_product" width="100%" src="<?= $product->image ?>" alt="">
                        </div>
                        <div class="card-body row">
                            <div class="col-12">
                                <h4 class="text-uppercase" name="name_product" style="font-size: medium"><?= $product->name ?></h4>
                            </div>
                            <div class="col-7">
                                <h4 name="price_product" class="card-title pricing-card-title text-danger">
                                    <?= $product->price ?> €
                                </h4>

                            </div>
                            <div class="col-5 pt-0">
                                <button type="button" name="buy_product" id="product_<?= $product->id ?>" class="w-100 btn btn-sm btn-outline-primary">Acheter</button>
                            </div>
                        </div>
                    </div>

                </div>

                <?php } ?>

            </div>

            <div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">

                        <?php
                        if($buttons[0] > 0) {
                            ?>
                            <li class="page-item <?php if($buttons[1] == 0) echo "disabled"; ?>">
                                <a class="page-link" href="<?= $buttons[4] ?>">Précédent</a>
                            </li>
                            <?php
                            $i = 0;
                            while ($i <= $buttons[0]) {
                                $pageArray = $buttons[2];
                                $pageArray['page'] = $i;
                                if(isset($router->getParam()['minPrice'])) {
                                    $linkPage = $router->getLink("productsPricePage", $pageArray);
                                } else {
                                    $linkPage = $router->getLink("productsCatPage", $pageArray);
                                }
                                ?>
                                <li class="page-item"><a class="page-link" href="<?= $linkPage; ?>"><?=$i+1 ?></a></li>
                                <?php
                                $i++;
                            }
                            ?>
                            <li class="page-item <?php if($buttons[1] == $buttons[0]) echo "disabled"; ?>">
                                <a class="page-link" href="<?= $buttons[3] ?>">Suivant</a>
                            </li>
                            <?php
                        } else {
                            ?>
                            <li class="page-item disabled">
                                <a class="page-link">Précédent</a>
                            </li>
                            <li class="page-item disabled">
                                <a class="page-link">Suivant</a>
                            </li>
                            <?php
                        }
                        ?>


                    </ul>
                </nav>


            </div>
        </div>

    </div>


</main>