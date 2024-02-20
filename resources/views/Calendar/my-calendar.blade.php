

@section('content')

@auth

    @isset($events)

    <div class="text-center"> <!-- Agrega la clase "text-center" para centrar el contenido -->
        <div id='calendar' style="width:50%; margin: auto;"></div> <!-- Ajusta el ancho y el margen automático -->
    </div>

    @endisset

@endauth

<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.10/index.global.min.js'></script>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      events: @json( $events )
    });
    calendar.render();
  });

</script>

