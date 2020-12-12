<?php
include("../model/api.php");
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>DB Software</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- jQuery Mobile & AJAX -->
        <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"
            integrity="sha256-VAvG3sHdS5LqTT+5A/aeq/bZGa/Uj04xKxY8KM/w9EE="
            crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


        <!-- Personal Stylesheet & Icon -->
        <link href="/~1901368/cmp306/view/favicon.png" rel="icon">
        <link href="/~1901368/cmp306/view/styles1.css" rel="stylesheet">

        <script>
            $(document).ready(function(){
                $("button").click(function(){
                    $("#temp").load("demo.txt");
                });
            });
        </script>

        <script>
            setInterval(function(){
                $('#curve_chart').load('drawChart()');
            }, 20000) /* time in milliseconds (ie 20 seconds)*/
        </script>


        <script>
            function pageRedirect() {
                $(location).attr("href", "https://mayar.abertay.ac.uk/~1901368/cmp306/");
            }
        </script>
    </head>
    <body>
    <style>
        .title a {font-family: "Roboto", sans-serif}
        body,h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif;}
    </style>
    <div data-role="page" id="home" data-title="DB Software">
        <div class="title" data-role="header">
            <h1 class="st-xlarge st-text-grey">IoT Light and Temperatures using JQM</h1>
        </div>

        <div data-role="content">
            <button type="button" onclick="pageRedirect()">Return to main site</button></br>
            <div class="list-group-item list-group-item-action bg-light text-dark ">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Light Control</h5>
                </div>
                <?php

                $result = getLightStates();

                $row = $result->fetch_assoc();

                if ($row['redstate'] == 1){
                    echo "<a href=\"https://agent.electricimp.com/NX6L3phZZDlr?pin=5&state=0\" data-role=\"button\">Switch Red Light Off</a></br>";

                }
                else{
                    echo "<a href=\"https://agent.electricimp.com/NX6L3phZZDlr?pin=5&state=1\" data-role=\"button\">Switch Red Light On</a></br>";
                }

                if ($row['greenstate'] == 1){
                    echo "<a href=\"https://agent.electricimp.com/NX6L3phZZDlr?pin=7&state=0\" data-role=\"button\">Switch Green Light Off</a></br>";
                }
                else{
                    echo "<a href=\"https://agent.electricimp.com/NX6L3phZZDlr?pin=7&state=1\" data-role=\"button\">Switch Green Light On</a></br>";
                }

                echo"
                <div class=\"list-group-item list-group-item-action bg-light text-dark \">
                    <div class=\"d-flex w-100 justify-content-between\">
                        <h5 class=\"mb-1\">Temperature Readouts</h5>
                    </div>";

                $temperaturetxt = getMostRecentTemp() ;
                $temperature = json_decode($temperaturetxt) ;
                $messagetxt = ($temperature["0"]->message);
                $messagetemps = json_decode($messagetxt);
                $messagedate = ($temperature["0"]->dttm);

                echo"
                     <p>Date & time this temperature was taken on: {$messagedate}</p>
                     <p></p>
                     <p>Internal Temperature: {$messagetemps->Internal_Temprature}</p>
                     <p>External Temperature: {$messagetemps->External_Temprature}</p><br>";

                $tempstxt = getdbtemps();
                for ($i=0, $len=count($tempstxt); $i<$len; $i++) {
                    $tempsarray[] = json_decode($tempstxt[$i]["message"], true);
                }

                $temptimes=getdbtemptime();

                $tempwithtimearray = array_map(function($temptimes,$tempsarray){

                    return array_merge(isset($temptimes) ? $temptimes : array(), isset($tempsarray) ? $tempsarray : array());

                },$temptimes,$tempsarray);


                ?>


                <div id="curve_chart" style="width: 900px; height: 500px"></div>

                <script type="text/javascript">
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Time', 'Internal Temperature', 'External Temperature'],
                            <?php
                            for ($i = 0, $iMax = count($tempwithtimearray); $i < $iMax; $i++) {
                                echo"['{$tempwithtimearray[$i]["time_part"]}',
                                {$tempwithtimearray[$i]["Internal_Temprature"]},
                                {$tempwithtimearray[$i]["External_Temprature"]}],";
                            }
                            ?>]);

                        var options = {
                            title: 'ElectricImp Temperatures',
                            curveType: 'function',
                            legend: { position: 'bottom' }
                        };

                        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                        chart.draw(data, options);
                    }
                </script>





            </div>
        </div>
        </div>

        <div data-role="footer" data-position="fixed">
            <h4> Dylan Baker - 1901368</h4>
        </div>
    </div>
    </body>
</html>
