<?php include( 'view/header.php' ); ?>

<section class="card mt-3 mb-3">
    <header class="card-header">
        <h1 class="mb-0"><?= htmlentities( $title ); ?></h1>
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
            <?php foreach ( $participants as $participant ) : ?>
                <tr>
                    <td><?= $participant->entity_id; ?></td>
                    <td><?= $participant->firstname; ?></td>
                    <td><?= $participant->lastname; ?></td>
                    <td><?= $participant->email; ?></td>
                    <td><?= $participant->position; ?></td>
                    <td><?= $participant->shares_amount; ?></td>
                    <td><?= $participant->start_date; ?></td>
                    <td><?= $participant->parent_id; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php include( 'view/footer.php' ); ?>
