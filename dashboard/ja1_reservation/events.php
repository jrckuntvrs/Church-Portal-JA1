<?php require_once('../../config.php'); ?>

<?php
$clientuser = ucwords($_settings->userdata('id'));

$sql = "SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,customer_id,CONCAT(Customer_Name) as fullname,Set_Appointment_Date as dateevent FROM `tbl_wedding_event` WHERE customer_id='$clientuser' UNION SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,customer_id,CONCAT(Full_Name) as fullname,DateTime_Event as dateevent FROM `tbl_funeral_service` WHERE customer_id='$clientuser' UNION SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,customer_id,CONCAT(Owner_Name) as fullname,DateTime_Blessing as dateevent FROM `tbl_blessing_event` WHERE customer_id='$clientuser' UNION SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,customer_id,CONCAT(Full_Name) as fullname,DateTime_Event as dateevent FROM `tbl_child_dedication_events` WHERE customer_id='$clientuser' UNION SELECT id,Customer_Name,Transaction_Date,Transaction_No,Event_Type,Status,customer_id,CONCAT(Full_Name) as fullname,DateTime_Event as dateevent FROM `tbl_birthday_event` WHERE customer_id='$clientuser' UNION SELECT id,title as Customer_Name,title as Transaction_Date,color as Transaction_No,title as Event_Type, end as Status,id as customer_id,CONCAT(title) as fullname,start as dateevent FROM `events`";
$result = $conn->query($sql);

$events = array();

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
    $events = [];
    foreach ($data['items'] as $event) {
        $summary = $event['summary'];
        $start_date = $event['start']['date'] ?? $event['start']['dateTime'];
        $end_date = $event['end']['date'] ?? $event['end']['dateTime'];

        $id = 0;
        $title = $summary;
        $start = $start_date;
        $end = $start_date;
        $backgroundColor = '#e83e8c';
        $borderColor = '#e83e8c';

        $events[] = compact('id','title', 'start', 'end', 'backgroundColor', 'borderColor');
        
    }

    // Printing the result
    /*foreach ($events as $event) {
        $color = '#009942';
        $title = $event['summary'];
        $dateevent = $event['start_date'];
    }*/
} else {
    echo "Error fetching data from the API.";
}

while ($row = $result->fetch_assoc()) {
    if ($row['Event_Type'] == 'Wedding Event') {
        $color = '#d1b72a';
        $sqlwedding = "SELECT * FROM `tbl_wedding_event`";
        $resultwedding = $conn->query($sqlwedding);
        while ($rowedding = $resultwedding->fetch_assoc()) {
            if ($rowedding['Status'] == 1) {
                $title = 'Target to Marry';
                $dateevent = $rowedding['Target_Marry_Date'];
            } else {
                $title = 'Wedding Appointment';
                $dateevent = $rowedding['Set_Appointment_Date'];
            }
        }
    } else if ($row['Event_Type'] == 'Blessing Event') {
        $color = '#069e52';
        $title = 'Blessing Event';
        $dateevent = $row['dateevent'];
    } else if ($row['Event_Type'] == 'Birthday Event') {
        $color = '#ff0000';
        $title = 'Birthday Event';
        $dateevent = $row['dateevent'];
    } else if ($row['Event_Type'] == 'Child Dedication Event') {
        $color = '#026ab5';
        $title = 'Child Dedication Event';
        $dateevent = $row['dateevent'];
    } else if ($row['Event_Type'] == 'Funeral Service') {
        $color = '#4d4e4f';
        $title = 'Funeral Service';
        $dateevent = $row['dateevent'];
    }else {
        $color = $row['Transaction_No'];
        $title = $row['fullname'];
        $dateevent = $row['dateevent'];
        $dateeventend = $row['Status'];
    }

    $events[] = array(
        'id' => $row['id'],
        'title' => $title,
        'start' => $dateevent,
        'end' => $dateeventend ?? $dateevent,
        'backgroundColor' => $color,
        'borderColor' => $color
    );
}

echo json_encode($events);
