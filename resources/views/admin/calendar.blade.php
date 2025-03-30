<!DOCTYPE html>
<html lang="en">
<head>

    @include('admin.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction/main.min.js"></script>

@include('admin.css_calendar')
</head>
<>
<body style="background-color: #FAEBD7;">
    @include('admin.sidebar')
    @include('admin.navbar')

    <div class="main-content">
            <div id="calendar"></div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '/fetch-google-events',
                eventTimeFormat: { 
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true 
                }
            });

            calendar.render();
        });
    </script>
</body>
@include('admin.script')
</html>
