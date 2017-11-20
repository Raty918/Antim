<?php
session_start();
if(!$_SESSION['loged']){
   header('Location: index.php');
}

/* Include the fusioncharts.php file that contains functions to embed the charts. */

include("fusioncharts.php");

/* The following 4 code lines contain the database connection information. Alternatively, you can move these code lines to a separate file and include the file here. You can also modify this code based on your database connection. */
// Establish a connection to the database

$dir = 'sqlite:/antim/db/antim.db';
$dbh  = new PDO($dir) or die("cannot open the database");


/*Render an error message, to avoid abrupt failure, if the database connection parameters are incorrect */
if ($dbh->connect_error) {
exit("There was an error with your connection: ".$dbh->connect_error);
}
?>


<!-- You need to include the following JS file to render the chart.
When you make your own charts, make sure that the path to this JS file is correct.
Else, you will get JavaScript errors. -->
<div id="chart-1"></div>
<script  src="node_modules/fusioncharts/fusioncharts.js"></script>
<script  src="node_modules/fusioncharts/themes/fusioncharts.theme.ocean.js"></script>

<?php

    // Form the SQL query that returns the top 3 most signatures detected
    $strQuery = "SELECT md5, COUNT(*) FROM signatures GROUP BY md5 ORDER BY COUNT(*) DESC LIMIT 3;";

    // Execute the query, or else return the error message.
    $result = $dbh->query($strQuery) or exit("Error code ({$dbh->errno}): {$dbh->error}");

    // If the query returns a valid response, prepare the JSON string
    if ($result) {
        // The `$arrData` array holds the chart attributes and data
        $arrData = array(
            "chart" => array(
              "caption" => "Top 3 Most Detected Signatures",
              "paletteColors" => "#5bb705",
              "bgColor" => "#ffffff",
              "borderAlpha"=> "20",
              "canvasBorderAlpha"=> "0",
              "usePlotGradientColor"=> "0",
              "plotBorderAlpha"=> "10",
              "showXAxisLine"=> "1",
              "xAxisLineColor" => "#999999",
              "showValues" => "0",
              "divlineColor" => "#999999",
              "divLineIsDashed" => "1",
              "showAlternateHGridColor" => "0"
            )
        );

        $arrData["data"] = array();
	// Push the data into the array
	foreach($result as $row){
        array_push($arrData["data"], array(
            "label" => $row[0],
            "value" => $row[1]
            )
        );
        }

        /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        $jsonEncodedData = json_encode($arrData);

/*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

       $columnChart = new FusionCharts("Column2D", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);

        // Render the chart
       return $columnChart->render();

        // Close the database connection
        $dbh->close();
    }

?>
