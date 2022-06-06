<main class="col-md-9 ms-sm-auto mt-3 col-lg-10 px-md-4">

    <?= $response ?>

    <div class="row">

        <div class="col-md-6">

            <table class="table table-dark table-hover">
                <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Image</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Description</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $product) { ?>
                <tr>
                    <th><?= $product->name ?></th>
                    <td><?= $product->category ?></td>
                    <td><img src="<?= $product->image ?>" width="50px" alt=""></td>
                    <td><?= $product->price ?>€</td>
                    <td><?= $product->description ?></td>
                    <td><?= $product->amount ?></td>
                    <td>
                        <form action="#" method="post">
                            <input type="text" hidden value="<?= $product->id ?>" name="productId">
                            <button type="submit" name="deleteProduct" class="btn text-white"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
                </tbody>

            </table>

        </div>

        <div class="col-md-6">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">Ajouter un article</h1>
            </div>



            <form method="post" action="#" >
                <div class="mb-3">
                    <label for="name" class="form-label">Nom de l'article</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Prix</label>
                    <input type="text" class="form-control" id="price" name="price">
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Catégorie</label>
                    <input type="text" class="form-control" id="category" name="category">
                    <div id="emailHelp" class="form-text">ID de la catégorie.</div>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="text" class="form-control" id="image" name="image">
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Quantité</label>
                    <input type="number" class="form-control" id="amount" name="amount">
                </div>

                <button type="submit" name="addProduct" class="btn btn-primary">Ajouter</button>
            </form>
        </div>

    </div>





</main>