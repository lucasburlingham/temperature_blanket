<?php
// get the temperature from the API
$openweather_apikey = file_get_contents('.OPENWEATHER_API_KEY');

$data = array(
	'q' => 'Fayetteville, NC, USA',
	'appid' => $openweather_apikey,
	'units' => 'imperial',
);

$url = 'http://api.openweathermap.org/data/2.5/weather?' . http_build_query($data);
$weather = file_get_contents($url, ) or die('Error: Could not get the temperature');


// echo "Response: " . $weather . "\n";

$weather = json_decode($weather, true);
$temperature = $weather['main']['temp_max'];
echo "Temperature: " . $temperature . "°F\n";



// send the temperature to the sqlite database
$db = new SQLite3('temperature.db');
$db->exec('CREATE TABLE IF NOT EXISTS temperature (temperature REAL, date TEXT)');
$db->exec('INSERT INTO temperature (temperature, date) VALUES (' . $temperature . ', "' . date('Y-m-d') . '")');
$db->close();

// send the temperature to google sheets via curl and the google form
$url = file_get_contents('.GOOGLE_FORMS_URL');
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);

if ($temperature == NULL) {
	$temperature = 'ERROR';
}

$data = array(
	'entry.1408996142' => $temperature,
	'entry.1869297124_year' => date('Y'),
	'entry.1869297124_month' => date('m'),
	'entry.1869297124_day' => date('d'),
	'submit' => 'Submit',
);
$query = http_build_query($data);

// echo "<br>Query: " . $query . "\n";
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $query);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
curl_exec($curl);
