<!DOCTYPE html>
<html lang="en">
<head>
  <title>Weather Station</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
  <body>
    <?php
$url = "http://www.3zcs.net/webs/data/get";
$json = file_get_contents($url);
$data = json_decode($json, true);
$objcont = count($data);
//id - date time - temp - humdity - smoke 
?>
<div class="container">
  <h2>Table of Data</h2>
  <p>This table print all data received from sensor:</p>            
  <table class="table">

<thead> 
<th>id</th> 
<th>date time</th>
<th>temp</th> 
<th>humdity</th>
 <th>smoke</th>
	 </thead>
<tbody>
<?php 
$i = 0 ; 
while($i < $objcont){
		$record = $data[$i];
		echo "<tr> 
			<td>$record[id]</td>
			<td>$record[datetime]</td>
			 <td>$record[temp]</td>
			 <td>$record[humdity]</td>
			 <td>$record[smoke]</td>
		 </tr>";
	$i=$i+1 ;
}
?>
</tbody>
  </table>
</div>
  </body>
</html>
