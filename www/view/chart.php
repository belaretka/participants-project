<?php include('view/template/header.php'); ?>

<div class="container-fluid">

    <section>
        <div class="mt-5 mb-3">
            <div id="chart_div"></div>
        </div>
    </section>

    <script type="text/javascript">
        google.charts.load('current', {packages: ["orgchart"]});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Entity');
            data.addColumn('string', 'Parent');
            data.addColumn('string', 'ToolTip');

            fetch("http://localhost/?action=get")
                .then((res) => res.json())
                .then((participants) => {

                    let rows = [];

                    for (const participant of participants) {
                        let row = [];
                        if (participant["position"] !== 'novice') {
                            let f = '' + participant["firstname"] + '<div style="color:red; font-style:italic">' + participant["position"] + '</div>';
                            row.push(
                                {
                                    'v': participant["firstname"],
                                    'f': f
                                },
                                participant["parent_id"] === 0 ? '' : participant["parent_firstname"],
                                '');
                        } else {
                            row.push(
                                participant["firstname"],
                                participant["parent_firstname"],
                                '');
                        }
                        rows.push(row);
                    }

                    data.addRows(rows);
                    var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
                    // Draw the chart, setting the allowHtml option to true for the tooltips.
                    chart.draw(data, {'allowHtml': true});
                });
        }

    </script>

    <?php include('view/template/footer.php'); ?>
