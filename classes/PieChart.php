<?php
class PieChart
{
    private $data = array();

    public function show()
    {
    echo '<script>
            google.charts.load("current", {packages: ["corechart"]});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() 
            {
                var data = google.visualization.arrayToDataTable([
                    [\'Kategoria\', \'Kwota\'],';
                        foreach ($this->data as $key => $value)
                            echo "['" . $key . "'," . $value . "],";
    echo               ']);
                
                var options = 
                {
                    pieHole: 0.4,
                    backgroundColor: \'#221803\',
                    colors: [\'#c1a877\', \'#556281\', \'#61460d\', \'#40365F\', \'#2A5353\', \'#34405D\'],
                    legend: \'none\',
                    fontName: \'Marcellus SC\',
                    pieSliceTextStyle: 
                    {
                        color: \'white\'
                    }
                };
            
                var chart = new google.visualization.PieChart(document.getElementById(\'donutchart\'));
                chart.draw(data, options);
            }
        </script>
        <div id="donutchart" style="width: 900px; height: 500px;" class="col-md-6 text-center"></div>';
    }

    public function populatePieChart($data)
    {
        $this->data = $data;
    }
}