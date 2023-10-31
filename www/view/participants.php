<?php include('view/template/header.php'); ?>

<div class="container-fluid">

<section class="card mt-3 mb-3">
    <header class="card-header">
        <h1 class="mb-0"><?= htmlentities($title); ?></h1>
    </header>

    <div class="card-body">

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>entity_id</th>
                <th>first_name</th>
                <th>last_name</th>
                <th>email</th>
                <th>position</th>
                <th>shares_amount</th>
                <th>start_date</th>
                <th>parent_id</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($participants as $participant) : ?>
                <tr>
                    <td><?= $participant->getEntityId(); ?></td>
                    <td><?= $participant->getFirstname(); ?></td>
                    <td><?= $participant->getLastname(); ?></td>
                    <td><?= $participant->getEmail(); ?></td>
                    <td><?= $participant->getPosition(); ?></td>
                    <td><?= $participant->getSharesAmount(); ?></td>
                    <td><?= $participant->getStartDate(); ?></td>
                    <td><?= $participant->getParentId(); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php include('view/template/footer.php'); ?>
