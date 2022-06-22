<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

    @if ($flag)

        <a href="{{ route('dashboard') }}">

            <img class="w-96 mx-auto my-2" src="{{ asset('storage/img/logo2.png') }}" alt="Logo">

        </a>

        <h1 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-2  bg-white">{{ $persona->nombre }} {{ $persona->ap_paterno }} {{ $persona->ap_materno }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2">

            <div class="p-4 mx-auto">

                <img class="rounded-lg max-h-56 object-cover shadow-xl" src="{{ Storage::disk('personal')->url($persona->foto) }}" alt="Fotografía">

            </div>

            <div class="p-4">

                <div class="grid grid-cols-1 md:grid-cols-2 p-4 bg-white rounded-lg shadow-xl">

                    <div class="">

                        <p class="tracking-widest font-semibold text-lg">Horario</p>

                        <p class="font-semibold">{{ $persona->horario->tipo }}</p>

                        <p>Entrada:</p>

                        <p>{{ $persona->horario->entrada }}</p>

                        <p>Salida:</p>

                        <p>{{ $persona->horario->salida }}</p>

                        @if($persona->horario->entrada_mixta)

                            <p>Entrada (mixta):</p>

                            <p>{{ $persona->horario->entrada_mixta }}</p>

                        @endif

                        @if ($persona->horario->salida_mixta)

                            <p>Salida (mixta):</p>

                            <p>{{ $persona->horario->salida_mixta }}</p>

                        @endif

                        @if ($persona->horario->tolerancia)

                            <p>Tolerancia:</p>

                            <p>{{ $persona->horario->tolerancia }}</p>

                        @endif

                    </div>

                    <div class="">

                        <p class="tracking-widest font-semibold text-lg">Registros</p>

                            @foreach ($checados as $ch)

                                <p class="capitalize">{{ $ch->tipo }} - {{ $ch->hora }}</p>

                            @endforeach

                    </div>

                </div>


            </div>

        </div>

    @else

        <a href="{{ route('dashboard') }}">

            <img class="w-96 mx-auto my-2" src="{{ asset('storage/img/logo.png') }}" alt="Logo">

        </a>

    @endif

    <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg z-50">

        <h1 class="text-3xl tracking-widest text-center mb-2">Checador </h1>

        <div wire:ignore>
            <p  class="text-lg text-center mb-2" id="clock"></p>
        </div>

        <input class="bg-white rounded text-sm w-full" type="number" wire:model="codigo" wire:keydown.enter="capturarCodigo" id="codigo"  autofocus onblur="this.focus()">

    </div>

    <script>

        function display_ct() {

            var x = new Date()
            var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';
            hours = x.getHours( ) % 12;
            hours = hours ? hours : 12;
            hours=hours.toString().length==1? 0+hours.toString() : hours;

            var minutes=x.getMinutes().toString()
            minutes=minutes.length==1 ? 0+minutes : minutes;

            var seconds=x.getSeconds().toString()
            seconds=seconds.length==1 ? 0+seconds : seconds;

            var month=(x.getMonth() +1).toString();
            month=month.length==1 ? 0+month : month;

            var dt=x.getDate().toString();
            dt=dt.length==1 ? 0+dt : dt;

            var x1=month + "/" + dt + "/" + x.getFullYear();
            x1 = x1 + " - " +  hours + ":" +  minutes + ":" +  seconds + " " + ampm;
            document.getElementById('clock').innerHTML = x1;

            display_c();
        }

        function display_c(){

            var refresh=1000;
            setTimeout('display_ct()',refresh)
        }

        display_ct();

        window.onload=function(){
            document.getElementById("codigo").focus();
        }

        const alarm = {

            setup: function() {

                if (typeof this.timeoutID === 'number') {
                    this.cancel();
                }

                this.timeoutID = setTimeout(function() {
                    @this.set('flag', false);

                    setTimeout(() => {
                        document.getElementById("codigo").blur();
                    }, 1000);

                }.bind(this), 30000);

            },

            cancel: function() {
                clearTimeout(this.timeoutID);
            }
        };

        window.addEventListener('contador', event => {

            alarm.setup()

        });

    </script>

</div>
