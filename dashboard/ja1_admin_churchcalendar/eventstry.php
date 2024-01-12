<?php require_once('../../config.php'); ?>

<?php
$api_url = "https://www.googleapis.com/calendar/v3/calendars/en.philippines%23holiday%40group.v.calendar.google.com/events";
$api_key = "AIzaSyCi0f4w1sJxJ7exMaT8bF_gTAzrlfSgbmU"; // Replace with your actual API key

$url = $api_url . '?' . http_build_query(['key' => $api_key]);

$options = [
    'http' => [
        'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
        'method' => 'GET',
    ],
];

$context = stream_context_create($options);
$stream = fopen($url, 'r', false, $context);

if ($stream) {
    $response = stream_get_contents($stream);
    fclose($stream);

    $data = json_decode($response, true);

    // Extracting relevant information
    $dates = [];
    foreach ($data['items'] as $event) {
        $dates[] = $event['start']['date'];
        
    }
} else {
    echo "Error fetching data from the API.";
}
?>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<?php
$query = 'SELECT DATE(Set_Appointment_Date) as date FROM `tbl_wedding_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_funeral_service` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_blessing_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_child_dedication_events` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_birthday_event`';
$result = $conn->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $dates[] = $row['date'];
    }

    echo 'disabledDates = ' . json_encode($dates) . ';';
} else {
    echo 'Query failed: ' . $conn->error;
}
?>