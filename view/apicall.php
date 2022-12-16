<?php
if(isset($_POST['ifsc'])) {
	$ifsc = $_POST['ifsc'];
	$json = @file_get_contents(
		"https://ifsc.razorpay.com/".$ifsc);
	$arr = json_decode($json);

	if(isset($arr->BRANCH)) {
		echo '<pre>';
		echo "<b>Bank:-</b>".$arr->BANK;
		echo "<br/>";
		echo "<b>Branch:-</b>".$arr->BRANCH;
		echo "<br/>";
		echo "<b>Centre:-</b>".$arr->CENTRE;
		echo "<br/>";
		echo "<b>District:-</b>".$arr->DISTRICT;
		echo "<br/>";
		echo "<b>State:-</b>".$arr->STATE;
		echo "<br/>";
		echo "<b/>Address:-</b>".$arr->ADDRESS;
		echo "<br/>";
	}
	else {
		echo "Invalid IFSC Code";
	}
}
?>

<?php

// $api_url = 'https://dummy.restapiexample.com/api/v1/employees';
$api_url = 'https://ifsc.razorpay.com/CIUB0000432';

// Read JSON file
$json_data = file_get_contents($api_url);

// Decode JSON data into PHP array
$response_data = json_decode($json_data);

// All user data exists in 'data' object
$user_data = $response_data->data;
console.log($user_data);

// Cut long data into small & select only first 10 records
// $user_data = array_slice($user_data, 0, 9);

// Print data if need to debug
//print_r($user_data);

// Traverse array and display user data
foreach ($user_data as $user) {
	echo "name: ".$user->BANKCODE;
	echo "<br />";
	echo "name: ".$user->BANK;
	echo "<br /> <br />";
}

$url = "https://ifsc.razorpay.com/CIUB0000432";
$json = file_get_contents($url);
$json_data = json_decode($json, true);
echo "My token: ". $json_data["access_token"];
?>
<?php
$content =     file_get_contents("http://api.minetools.eu/ping/play.desnia.net/25565");

$result  = json_decode($content);
console.log($result);

print_r( $result->players->online );
?>
