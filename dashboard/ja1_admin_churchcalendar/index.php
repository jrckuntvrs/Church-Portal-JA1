<?php if ($_settings->chk_flashdata('success')) : ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>

<head>
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/fullcalendar/main.css">
</head>

<style>
    .form-control{
        border-color: var(--primary);
    }
</style>

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
                                        <h3 class="card-title">Create Task/Event</h3>
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

                        <div class="col-md-9">
                            <div class="card card-primary">
                                <div class="card-body p-0">

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
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function(info) {
                // is the "remove after drop" checkbox checked?
                if (checkbox.checked) {
                    // if so, remove the element from the "Draggable Events" list
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            }
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
                        location.reload()
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