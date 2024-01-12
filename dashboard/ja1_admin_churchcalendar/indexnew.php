<head>
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/fullcalendar/main.css">
</head>

<div class="container-fluid">
    <div class="card">
        <div class="card-title p-2 rounded-top" style="background: #001629; color: white;">
            <h4 class="ml-2">Church Calendar</h4>
        </div>
        <div class="card-body">

            <div id="calendar"></div>

        </div>
    </div>
</div>

<script src="<?php echo base_url ?>plugins/fullcalendar/main.js"></script>
<script src="<?php echo base_url ?>plugins/moment/moment.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            events: _base_url_ + 'dashboard/ja1_admin_churchcalendar/events.php',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            }
        });

        calendar.render();
    });
</script>