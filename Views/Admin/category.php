<main class="col-md-9 ms-sm-auto mt-3 col-lg-10 px-md-4">

    <?= $response ?>

    <div class="row">

        <div class="col-md-6">

            <table class="table table-dark table-hover">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($categories as $category) { ?>
                <tr>
                    <th><?= $category->id ?></th>
                    <td><?= $category->name ?></td>
                    <td>
                        <form action="#" method="post">
                            <input type="text" hidden value="<?= $category->id ?>" name="productId">
                            <button type="submit" name="deleteCategory" class="btn text-white"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
                </tbody>

            </table>

        </div>

        <div class="col-md-6">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">Ajouter une catégorie</h1>
            </div>



            <form method="post" action="#" >
                <div class="mb-3">
                    <label for="name" class="form-label">Nom de la catégorie</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                <button type="submit" name="addCategory" class="btn btn-primary">Ajouter</button>
            </form>
        </div>

    </div>





</main>