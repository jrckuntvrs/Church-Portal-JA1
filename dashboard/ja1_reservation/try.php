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
            $dates2 = [];
            $dates3 = [];
            $dates4 = [];
            $dates5 = [];
            foreach ($data['items'] as $event) {
                $dates[] = $event['start']['date'];
                $dates2[] = $event['start']['date'];
                $dates3[] = $event['start']['date'];
                $dates4[] = $event['start']['date'];
                $dates5[] = $event['start']['date'];
            }
        } else {
            echo "Error fetching data from the API.";
        }
        
 echo 'helo';
 $queryeventsss = "SELECT DATE(start) as start_date, DATE(end) as end_date FROM events";
$resulteventsss =  $conn->query($queryeventsss);

// Array to store disabled dates
$disabledDateseventsss = [];

// Fetch date ranges and add them to the disabledDates array
while ($roweventsss = $resulteventsss->fetch_assoc()) {
    $startDateeventsss = strtotime($roweventsss['start_date']);
    $endDateeventsss = strtotime($roweventsss['end_date']);

    // Iterate through the date range and add each date to disabledDates
    while ($startDateeventsss <= $endDateeventsss) {
        $disabledDateseventsss[] = date('Y-m-d', $startDateeventsss);
        $startDateeventsss = strtotime('+1 day', $startDateeventsss);
    }
}

$query = 'SELECT DATE(Set_Appointment_Date) as date FROM `tbl_wedding_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_funeral_service` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_blessing_event` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_child_dedication_events` UNION SELECT DATE(DateTime_Event) as date FROM `tbl_birthday_event` ';
            $result = $conn->query($query);

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $dates[] = $row['date'];
                }

            } else {
                echo 'Query failed: ' . $conn->error;
            }

// Output the disabledDates array

// Merge the two arrays
$mergedDates = array_merge($disabledDateseventsss, $dates);

// Now $mergedDates contains all the dates from both arrays

// Optionally, you can remove duplicates if needed
//$mergedDates = array_unique($mergedDates);

// Print or use the merged dates as needed
echo 'disabledDates = ' . json_encode($mergedDates) . ';';

?>
