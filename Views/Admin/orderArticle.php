<main class="col-md-9 ms-sm-auto mt-3 col-lg-10 px-md-4">

    <?= $response ?>

    <div class="row">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Ordre de base des produits</h1>
        </div>

        <form action="#" method="post" class="list-group list-group-checkable d-grid gap-2 border-0 w-auto">


            <input class="list-group-item-check pe-none" type="radio" name="value" id="value1" value="asc"
                <?php if($selectedOrder == "asc") echo "checked"; ?>
            >
            <label class="list-group-item rounded-3 py-3" for="value1">
                Nom croissant
                <span class="d-block small opacity-50">Ordonner par nom dans l'odre alphabétique croissant</span>
            </label>

            <input class="list-group-item-check pe-none" type="radio" name="value" id="value2" value="desc"
                <?php if($selectedOrder == "desc") echo "checked"; ?>>
            <label class="list-group-item rounded-3 py-3" for="value2">
                Nom décroissant
                <span class="d-block small opacity-50">Ordonner par nom dans l'odre alphabétique croissant</span>
            </label>

            <input class="list-group-item-check pe-none" type="radio" name="value" id="value3" value="ascPrice"
                <?php if($selectedOrder == "ascPrice") echo "checked"; ?>>
            <label class="list-group-item rounded-3 py-3" for="value3">
                Prix croissant
                <span class="d-block small opacity-50">Ordonner par prix dans l'ordre croissant</span>
            </label>

            <input class="list-group-item-check pe-none" type="radio" name="value" id="value4" value="descPrice"
                <?php if($selectedOrder == "descPrice") echo "checked"; ?>>
            <label class="list-group-item rounded-3 py-3" for="value4">
                Prix décroissant
                <span class="d-block small opacity-50">Ordonner par prix dans l'ordre décroissant</span>
            </label>

            <button type="submit" name="orderSave" class="btn btn-primary btn-large">Enregistrer</button>

        </form>


    </div>





</main>
