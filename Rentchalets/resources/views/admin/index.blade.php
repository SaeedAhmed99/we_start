@extends('admin.layout.master')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Area Chart Example
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Bar Chart Example
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
        <div id="calendar">

        </div>
    </div>
</main>
@stop


@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $.ajax({
            type: 'get',
            url: "/admin/home/featch",
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                var event = [];
                for (key in data[0]) {
                    // console.log(data[0][key].date);
                    event.push({
                        title: 'Meeting',
                        start: data[0][key].date,
                        constraint: 'availableForMeeting', // defined below
                        color: '#257e4a',
                    });
                }

                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                    },
                    initialDate: new Date(),
                    navLinks: false, // can click day/week names to navigate views
                    businessHours: true, // display business hours
                    editable: false,
                    selectable: true,
                    // locale: 'ar',
                    events: event
                });

                calendar.render();
            },
            error: function (data) {
                console.log('****************');
            }
        })
    });
    // console.log(aa);
</script>
{{--
<script>
    document.addEventListener('DOMContentLoaded', function() {

      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        initialDate: new Date(),
        navLinks: false, // can click day/week names to navigate views
        businessHours: true, // display business hours
        editable: false,
        selectable: true,
        // locale: 'ar',
        events: [
          {
            title: 'Meeting',
            start: '2022-11-24',
            constraint: 'availableForMeeting', // defined below
            color: '#257e4a',
          }
        ]
      });

      calendar.render();
    });

  </script> --}}
@endsection

