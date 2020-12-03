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
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

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
            <h1 class="st-xlarge st-text-grey"> jQuery Mobile Site with IoT Light and Temperatures</h1>
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
                     <p>External Temperature: {$messagetemps->External_Temprature}</p>"
                ?>

               <canvas id="myChart"></canvas>
                <script>
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var chart = new Chart(ctx, {
                        // The type of chart we want to create
                        type: 'line',

                        // The data for our dataset
                        data: {
                            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                            datasets: [{
                                label: 'My First dataset',
                                backgroundColor: 'rgb(0, 0, 0)',
                                borderColor: 'rgb(255, 99, 132)',
                                data: [0, 10, 5, 2, 20, 30, 45]
                            }]
                        }}
                </script>
            </div>
        </div>
        </div>

        <div data-role="footer" data-position="fixed">
            <h4> Dylan Baker </h4>
        </div>
    </div>
    </body>
</html>
