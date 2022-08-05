<div class="p-4">

    <input type="month" class="bg-white rounded text-sm w-full lg:w-1/6 mb-3 " wire:model="mes">

    <div class="bg-white" id='calendar' wire:ignore></div>

</div>

<script>

    document.addEventListener('livewire:load', function() {

        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {

          events: JSON.parse(@this.events),
          initialView: 'dayGridMonth',
          headerToolbar: false

        });

        calendar.render();

        @this.on(`refreshCalendar`, () => {
            calendar.refetchEvents()
            calendar.gotoDate( @this.mes)
        });

      });

</script>
