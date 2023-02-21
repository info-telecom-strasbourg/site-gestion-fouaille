<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Temps', 'Recette'],
                ['10',  3],
                ['20',  6],
                ['30',  22],
                ['40',  1030],
                ['50',  1040],
                ['60',  1070],
                ['70',  1278],
                ['80',  1876],
                ['90',  2098]
            ]);

            var options = {
                title: 'Company Performance',
                hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
                vAxis: {minValue: 0}
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
<div id="chart_div" style="width: 100%; height: 500px;"></div>
</body>
</html>