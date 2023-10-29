<?php //include( 'view/template/header.php' ); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {packages:["orgchart"]});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Entity');
            data.addColumn('string', 'Parent');
            data.addColumn('string', 'ToolTip');

            // For each orgchart box, provide the name, manager, and tooltip to show.
            data.addRows([
                [{'v':'Mike', 'f':'Mike<div style="color:red; font-style:italic">President</div>'},
                    '', 'The President'],
                [{'v':'Jim', 'f':'Jim<div style="color:red; font-style:italic">Vice President</div>'},
                    'Mike', 'VP'],
                ['Alice', 'Mike', ''],
                ['Bob', 'Jim', 'Bob Sponge'],
                ['Carol', 'Bob', '']
            ]);

            // Create the chart.
            var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
            // Draw the chart, setting the allowHtml option to true for the tooltips.
            chart.draw(data, {'allowHtml':true});
        }
    </script>
</head>

<body>

<div class="container">
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
    <div id="chart_div"></div>

<?php include( 'view/template/footer.php' ); ?>
