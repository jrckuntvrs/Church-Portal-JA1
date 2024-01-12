<?php if ($_settings->chk_flashdata('success')) : ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>

<?php
if (isset($_GET['success'])) : ?>
    <script>
        var data = [
                [0, 11, "Good Morning"],
                [12, 18, "Good Afternoon"],
                [18, 24, "Good Evening"]
            ],
            hr = new Date().getHours();

        var greetampm = '';
        var greetimg = '';
        for (var i = 0; i < data.length; i++) {
            if (hr >= data[i][0] && hr <= data[i][1]) {
                greetampm = (data[i][2]) + ' Admin !';
                if (data[i][2] == "Good Morning") {
                    greetimg = '../images/morning.png';
                } else if (data[i][2] == "Good Afternoon") {
                    greetimg = '../images/afternoon.png';
                } else if (data[i][2] == "Good Evening") {
                    greetimg = '../images/evening.png';
                }
                break;
            }
        }
        // Assume the username is retrieved from the login process
        var username = '<?php echo ucwords($_settings->userdata('firstname') . ' ' . ucwords($_settings->userdata('lastname'))); ?>'; // Replace with the actual username

        // Check if the greeting has been shown before
        //var hasShownGreeting = localStorage.getItem('hasShownGreeting');

        //if (!hasShownGreeting) {
        // Display a SweetAlert greeting
        Swal.fire({
            title: greetampm,
            text: 'Hello, ' + username + '!',
            imageUrl: greetimg,
            imageWidth: 200,
            imageHeight: 200,
            confirmButtonText: 'OK'
        });

        // Mark that the greeting has been shown
        //localStorage.setItem('hasShownGreeting', true);
        //}
    </script>
<?php endif; ?>

<head>
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/fullcalendar/main.css">
</head>

<style>
    .a_card {
        color: #212529;
        text-decoration: none;
        background-color: transparent;
    }

    .a_card:hover {
        color: var(--pink);
        text-decoration: none;
    }

    .form-control{
        border-color: var(--primary);
    }
</style>

<div class="container-fluid">

    <div class="card">
        <div class="card-title p-2 rounded-top" style="background: #001629; color: white;">
            <h4 class="ml-2">Activity Events</h4>
        </div>
        <div class="card-body">


            <div class="row">

                <div class="col-md-3 col-sm-6 col-12">
                    <a href="<?php echo base_url ?>dashboard/?page=ja1_admin_today_reservation" class="a_card">
                        <div class="info-box shadow">
                            <span class="info-box-icon bg-light"><i class="fas fa-calendar-day"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Today's Reservation</span>
                                <span class="info-box-number text-xl">
                                    <?php

                                    $tables = ["tbl_wedding_event", "tbl_funeral_service", "tbl_blessing_event", "tbl_child_dedication_events", "tbl_birthday_event"];
                                    $ja1idtody = 0;

                                    foreach ($tables as $table) {
                                        $query = "SELECT * FROM " . $table ." WHERE date(Transaction_Date) = '".date('Y-m-d')."'" ;
                                        $result = $conn->query($query);
                                    
                                        if ($result) {
                                            $ja1idtody += $result->num_rows;
                                            $result->close();
                                        } else {
                                            echo "Error executing query: " . $conn->error;
                                        }
                                    }
                                    echo number_format($ja1idtody);
                                    ?>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <a href="<?php echo base_url ?>dashboard/?page=ja1_admin_pending_reservation" class="a_card">
                        <div class="info-box shadow">
                            <span class="info-box-icon bg-light"><i class="fas fa-calendar-exclamation"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Pending Reservation</span>
                                <span class="info-box-number text-xl">
                                    <?php

                                    $tables = ["tbl_wedding_event", "tbl_funeral_service", "tbl_blessing_event", "tbl_child_dedication_events", "tbl_birthday_event"];
                                    $ja1idtody = 0;

                                    foreach ($tables as $table) {
                                        $query = "SELECT * FROM " . $table ." WHERE tdy_rsrvtn_status='0'" ;
                                        $result = $conn->query($query);
                                    
                                        if ($result) {
                                            $ja1idtody += $result->num_rows;
                                            $result->close();
                                        } else {
                                            echo "Error executing query: " . $conn->error;
                                        }
                                    }
                                    echo number_format($ja1idtody);
                                    ?>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <a href="<?php echo base_url ?>dashboard/?page=ja1_admin_birthday" class="a_card">
                        <div class="info-box shadow">
                            <span class="info-box-icon bg-light"><i class="fas fa-birthday-cake"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Birthday Events</span>
                                <span class="info-box-number text-xl">
                                    <?php
                                    $ja1id = $conn->query("SELECT id FROM `tbl_birthday_event`")->num_rows;
                                    echo number_format($ja1id);
                                    ?>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-md-3 col-sm-6 col-12">
                    <a href="<?php echo base_url ?>dashboard/?page=ja1_admin_wedding" class="a_card">
                        <div class="info-box shadow">
                            <span class="info-box-icon bg-light"><i class="fas fa-rings-wedding"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Wedding Events</span>
                                <span class="info-box-number text-xl">
                                    <?php
                                    $ja1id = $conn->query("SELECT id FROM `tbl_wedding_event`")->num_rows;
                                    echo number_format($ja1id);
                                    ?>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <a href="<?php echo base_url ?>dashboard/?page=ja1_admin_child_dedication" class="a_card">
                        <div class="info-box shadow">
                            <span class="info-box-icon bg-light"><i class="fas fa-child"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Child Dedication</span>
                                <span class="info-box-number text-xl">
                                    <?php
                                    $ja1id = $conn->query("SELECT id FROM `tbl_child_dedication_events`")->num_rows;
                                    echo number_format($ja1id);
                                    ?>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <a href="<?php echo base_url ?>dashboard/?page=ja1_admin_funeral_s" class="a_card">
                        <div class="info-box shadow">
                            <span class="info-box-icon bg-light"><i class="fas fa-coffin-cross"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Funeral Service</span>
                                <span class="info-box-number text-xl">
                                    <?php
                                    $ja1id = $conn->query("SELECT id FROM `tbl_funeral_service`")->num_rows;
                                    echo number_format($ja1id);
                                    ?>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <a href="<?php echo base_url ?>dashboard/?page=ja1_admin_blessing" class="a_card">
                        <div class="info-box shadow">
                            <span class="info-box-icon bg-light"><i class="fas fa-candle-holder"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Blessing Events</span>
                                <span class="info-box-number text-xl">
                                    <?php
                                    $ja1id = $conn->query("SELECT id FROM `tbl_blessing_event`")->num_rows;
                                    echo number_format($ja1id);
                                    ?>
                                </span>
                            </div>
                        </div>
                </div>
                </a>
            </div>

        </div>
    </div>

</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-title p-2 rounded-top" style="background: #001629; color: white;">
            <h4 class="ml-2">Church Calendar</h4>
        </div>
        <div class="card-body" style="  width: 100%;">


            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="sticky-top mb-3">
                                <div class="card" style="display: none;">
                                    <div class="card-header">
                                        <h4 class="card-title">Draggable Events</h4>
                                    </div>
                                    <div class="card-body">

                                        <div id="external-events">
                                            <div class="external-event bg-success">Lunch</div>
                                            <div class="external-event bg-warning">Go home</div>
                                            <div class="external-event bg-info">Do homework</div>
                                            <div class="external-event bg-primary">Work on UI design</div>
                                            <div class="external-event bg-danger">Sleep tight</div>
                                            <div class="checkbox">
                                                <label for="drop-remove">
                                                    <input type="checkbox" id="drop-remove">
                                                    remove after drop
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title"><b>Create Task/Event</b></h3>
                                    </div>
                                    <div class="card-body">
                                        <form id="add-new-event">
                                            <label for="new-event" class="control-label">Pick a Color</label>
                                            <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                                <ul class="fc-color-picker" id="color-chooser">
                                                    <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                                                    <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                                                    <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                                                    <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                                                    <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                                                </ul>
                                            </div>

                                            <input id="colorpick" type="hidden" name="colorpick" class="form-control"value="#007bf">

                                            <div class="form-group">
                                                <label for="new-event" class="control-label">Title</label>
                                                <input id="new-event" type="text" name="title" class="form-control" placeholder="Event Title">
                                            </div>

                                            <div class="form-group">
                                                <label for="start_datetime" class="control-label">Start</label>
                                                <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="end_datetime" class="control-label">End</label>
                                                <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                                            </div>

                                            <div style="display: flex; justify-content: flex-end;">
                                                <button form="add-new-event" id="addnewevent" class="btn btn-primary">Add</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md">
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div id="calendar"></div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </section>


        </div>
    </div>
</div>

<script src="<?php echo base_url ?>plugins/fullcalendar/main.js"></script>

<script>
    $(function() {

        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
            ele.each(function() {

                // create an Event Object (https://fullcalendar.io/docs/event-object)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                }

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject)

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                })

            })
        }

        ini_events($('#external-events div.external-event'))

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()

        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;

        var containerEl = document.getElementById('external-events');
        var checkbox = document.getElementById('drop-remove');
        var calendarEl = document.getElementById('calendar');

        // initialize the external events
        // -----------------------------------------------------------------

        new Draggable(containerEl, {
            itemSelector: '.external-event',
            eventData: function(eventEl) {
                return {
                    title: eventEl.innerText,
                    backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                    borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                    textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                };
            }
        });

        var calendar = new Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            eventContent: function(arg) {
                var eventEl = document.createElement('div');
                var timeEl = document.createElement('b');
                timeEl.textContent = arg.timeText;
                eventEl.appendChild(timeEl);

                // Create a div for the title with max-width: 100%
                var titleDiv = document.createElement('div');
                titleDiv.style.maxWidth = '100%';
                titleDiv.style.overflowWrap = 'break-word';
                titleDiv.textContent = arg.event.title;

                // Append the title div to the event element
                eventEl.appendChild(titleDiv);

                eventEl.style.backgroundColor = arg.event.backgroundColor;
                eventEl.style.borderColor = arg.event.borderColor;
                eventEl.style.borderWidth = '0px';
                eventEl.style.color = 'white';
                eventEl.style.padding = '5px';
                eventEl.style.width = '100%';
                eventEl.style.borderRadius = '5px';

                return {
                    domNodes: [eventEl]
                };
            },
            themeSystem: 'bootstrap',
            //Random default events
            events: _base_url_ + 'dashboard/ja1_admin_churchcalendar/events.php',
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            /*drop: function(info) {
                // is the "remove after drop" checkbox checked?
                if (checkbox.checked) {
                    // if so, remove the element from the "Draggable Events" list
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            }*/
        });

        calendar.render();
        // $('#calendar').fullCalendar()

        /* ADDING EVENTS */
        var currColor = '#3c8dbc' //Red by default
        // Color chooser button
        $('#color-chooser > li > a').click(function(e) {
            e.preventDefault()
            // Save color
            currColor = $(this).css('color')
            // Add color effect to button
            $('#addnewevent').css({
                'background-color': currColor,
                'border-color': currColor
            })

            $('.form-control').css({
                'border-color': currColor
            })

            $('#colorpick').val(currColor)
        })
        /*$('#add-new-event').click(function(e) {
            e.preventDefault()
            // Get value and make sure it is not null
            var val = $('#new-event').val()
            if (val.length == 0) {
                return
            }

            // Create events
            var event = $('<div />')
            event.css({
                'background-color': currColor,
                'border-color': currColor,
                'color': '#fff'
            }).addClass('external-event')
            event.text(val)
            $('#external-events').prepend(event)

            // Add draggable funtionality
            ini_events(event)

            // Remove event from text input
            $('#new-event').val('')
        })*/
    })
</script>

<script>
    $(document).ready(function() {
        $('#add-new-event').submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Content.php?f=add_church_clndr_admin",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: "POST",
                type: "POST",
                dataType: "json",
                error: err => {
                    alert_toast("An error occured", 'error')
                    console.log(err);
                    end_loader();
                },
                success: function(resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {
                        end_loader();
                        location.href = _base_url_ + "dashboard";
                    } else {
                        alert_toast("An error occured", 'error')
                        console.log(resp);
                        end_loader();
                    }
                }
            })
        })
    })
</script>