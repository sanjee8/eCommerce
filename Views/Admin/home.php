<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dernières commandes</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Prix payé</th>
                <th scope="col">Date</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($latest as $orderLatest) { ?>
            <tr>
                <td><?= $orderLatest->id ?></td>
                <td><?= $orderLatest->email ?></td>
                <td><?= $orderLatest->final_price ?>€</td>
                <td><?= date('d/m/Y H:i:s', $orderLatest->date_of) ?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</main>