@extends('layouts.admin')

@section('content')

    <h1 class="text-2xl tracking-widest px-6 py-3 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3  bg-white">{{ $persona->nombre }} {{ $persona->ap_paterno }} {{ $persona->ap_materno }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2">

        <div class="p-4 mx-auto">

            <img class="rounded-lg max-h-96 object-cover mb-3 shadow-xl" src="{{ Storage::disk('personal')->url($persona->foto) }}" alt="Fotografía">

        </div>

        <div class="p-4">

            <div class="grid grid-cols-1 md:grid-cols-2 p-4 bg-white rounded-lg shadow-xl">

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Fecha de Ingreso</p>

                    <p>{{ $persona->fecha_ingreso }}</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Número de empleado</p>

                    <p>{{ $persona->numero_empleado }}</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Código de Barras</p>

                    <p>{{ $persona->codigo_barras }}</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Localidad</p>

                    <p>{{ $persona->localidad }}</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Área</p>

                    <p>{{ $persona->area }}</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Tipo</p>

                    <p>{{ $persona->tipo }}</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">RFC</p>

                    <p>{{ $persona->rfc }}</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">CURP</p>

                    <p>{{ $persona->curp }}</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Teléfono</p>

                    <p>{{ $persona->telefono }}</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Email</p>

                    <p>{{ $persona->email }}</p>

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Estado</p>

                    @if($persona->status == 'activo')

                        <span class="bg-green-400 py-1 px-2 rounded-full text-white">{{ ucfirst($persona->status) }}</span>

                    @else

                        <span class="bg-red-400 py-1 px-2 rounded-full text-white">{{ ucfirst($persona->status) }}</span>

                    @endif

                </div>

                <div class="mb-4">

                    <p class="tracking-widest font-semibold text-lg">Horario</p>

                    <p>{{ $persona->horario->tipo }}</p>

                </div>

                @if ( $persona->observaciones)

                    <div class="mb-4 col-span-2">

                        <p class="tracking-widest font-semibold text-lg">Observaciones</p>

                        <p>{{ $persona->observaciones }}</p>

                    </div>

                @endif

            </div>


        </div>

    </div>

    <div>

        <div class="w-full" x-data="{selected : null}">

            <div @click="selected != 1 ? selected = 1 : selected = null">

                <h2 class="text-2xl tracking-widest px-6 py-3 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer  bg-white">

                    Incapacidades ({{ $persona->incapacidades->count() }})

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 float-right" :class="selected == 1 ? 'transform rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="gray">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 9l-7 7-7-7" />
                    </svg>

                </h2>

            </div>

            <div
                class="text-center mb-2 overflow-hidden max-h-0 transition-all duration-500"
                x-ref="tab1"
                :style="selected == 1 ? 'max-height: ' + $refs.tab1.scrollHeight + 'px;' :  ''"
            >

                @if($persona->incapacidades->count())

                    <div class="relative overflow-x-auto rounded-lg shadow-xl">

                        <table class="rounded-lg w-full">

                            <thead class="border-b border-gray-300 bg-gray-50">

                                <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                                    <th class="px-3 hidden lg:table-cell">

                                        Folio

                                    </th>

                                    <th  class="px-3 hidden lg:table-cell">

                                        Documento

                                    </th>

                                    <th  class=" px-3 hidden lg:table-cell">

                                        Tipo

                                    </th>

                                    <th  class=" px-3 hidden lg:table-cell">

                                        Registro

                                    </th>

                                    <th class="px-3 hidden lg:table-cell">

                                        Actualizado

                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">

                                @foreach($persona->incapacidades as $incapacidad)

                                    <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                        <td class="px-3  w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Folio</span>

                                            {{ $incapacidad->folio }}

                                        </td>


                                        <td class="px-3  w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Documento</span>

                                            <img class="h-20" src="{{ Storage::disk('incapacidades')->url($incapacidad->documento) }}" alt="Incapacidad">

                                        </td>

                                        <td class="px-3  w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tipo</span>

                                            {{ $incapacidad->tipo }}

                                        </td>

                                        <td class="px-3  w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                            @if($incapacidad->creadoPor != null)

                                                <span class="font-semibold">Registrado por: {{$incapacidad->creadoPor->name}}</span> <br>

                                            @endif

                                            {{ $incapacidad->created_at }}

                                        </td>

                                        <td class="px-3  w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                            @if($incapacidad->actualizadoPor != null)

                                                <span class="font-semibold">Actualizado por: {{$incapacidad->actualizadoPor->name}}</span> <br>

                                            @endif

                                            {{ $incapacidad->updated_at }}

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                        No hay resultados.

                    </div>

                @endif

            </div>

            <div @click="selected != 3 ? selected = 3 : selected = null" class="">

                <h2 class="text-2xl tracking-widest px-6 py-3 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer  bg-white">

                    Justificaciones ({{ $persona->justificaciones->count() }})

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 float-right" :class="selected == 3 ? 'transform rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="gray">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 9l-7 7-7-7" />
                    </svg>

                </h2>

            </div>

            <div
                class="text-center mb-2 overflow-hidden max-h-0 transition-all duration-500"
                x-ref="tab3"
                :style="selected == 3 ? 'max-height: ' + $refs.tab3.scrollHeight + 'px;' :  ''"
            >

                @if($persona->justificaciones->count())

                    <div class="relative overflow-x-auto rounded-lg shadow-xl">

                        <table class="rounded-lg w-full">

                            <thead class="border-b border-gray-300 bg-gray-50">

                                <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                                    <th class=" px-3 hidden lg:table-cell">

                                        Folio

                                    </th>

                                    <th  class=" px-3 hidden lg:table-cell">

                                        Documento

                                    </th>

                                    <th  class=" px-3 hidden lg:table-cell">

                                        Retardo / Falta

                                    </th>

                                    <th class=" px-3 hidden lg:table-cell">

                                        Registro

                                    </th>

                                    <th  class=" px-3 hidden lg:table-cell">

                                        Actualizado

                                    </th>

                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">

                                @foreach($persona->justificaciones as $justificacion)

                                    <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                        <td class="px-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Motivo</span>

                                            {{ $justificacion->folio }}

                                        </td>

                                        <td class="px-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">fecha</span>

                                            <img class="h-20" src="{{ Storage::disk('justificacion')->url($justificacion->documento) }}" alt="Justificación">

                                        </td>

                                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Retardo / Falta</span>

                                            @if ($justificacion->retardo)

                                                Retardo: {{ $justificacion->retardo->created_at }}

                                            @elseif($justificacion->falta)

                                                Falta: {{ $justificacion->falta->tipo }} / {{ $justificacion->falta->created_at }}

                                            @endif

                                        </td>

                                        <td class="px-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                            @if($justificacion->creadoPor != null)

                                                <span class="font-semibold">Registrado por: {{$justificacion->creadoPor->name}}</span> <br>

                                            @endif

                                            {{ $justificacion->created_at }}

                                        </td>

                                        <td class="px-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                            @if($justificacion->actualizadoPor != null)

                                                <span class="font-semibold">Actualizado por: {{$justificacion->actualizadoPor->name}}</span> <br>

                                            @endif

                                            {{ $justificacion->updated_at }}

                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                        No hay resultados.

                    </div>

                @endif

            </div>

            <div @click="selected != 4 ? selected = 4 : selected = null" class="">

                <h2 class="text-2xl tracking-widest px-6 py-3 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer  bg-white">

                    Retardos ({{ $persona->retardos->count() }})

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 float-right" :class="selected == 4 ? 'transform rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="gray">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 9l-7 7-7-7" />
                    </svg>

                </h2>

            </div>

            <div
                class="text-center mb-2 overflow-hidden max-h-0 transition-all duration-500"
                x-ref="tab4"
                :style="selected == 4 ? 'max-height: ' + $refs.tab4.scrollHeight + 'px;' :  ''"
            >

                @if($persona->retardos->count())

                    <div class="relative overflow-x-auto rounded-lg shadow-xl">

                        <table class="rounded-lg w-full">

                            <thead class="border-b border-gray-300 bg-gray-50">

                                <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                                    <th class=" px-3 hidden lg:table-cell">

                                        Registro

                                    </th>

                                    <th class=" px-3 hidden lg:table-cell">

                                        Justificación

                                    </th>

                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">

                                @foreach($persona->retardos as $retardo)

                                    <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                        <td class="px-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registro</span>

                                            {{ $retardo->created_at }}

                                        </td>

                                        <td class="px-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Justificación</span>

                                            @if ($retardo->justificacion)

                                                {{ $retardo->justificacion->folio }}

                                            @else

                                                Sin justificación

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                        No hay resultados.

                    </div>

                @endif

            </div>

            <div @click="selected != 5 ? selected = 5 : selected = null" class="">

                <h2 class="text-2xl tracking-widest px-6 py-3 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer  bg-white">

                    Faltas ({{ $persona->faltas->count() }})

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 float-right" :class="selected == 5 ? 'transform rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="gray">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 9l-7 7-7-7" />
                    </svg>

                </h2>

            </div>

            <div
                class="text-center mb-2 overflow-hidden max-h-0 transition-all duration-500"
                x-ref="tab5"
                :style="selected == 5 ? 'max-height: ' + $refs.tab5.scrollHeight + 'px;' :  ''"
            >

                @if($persona->faltas->count())

                    <div class="relative overflow-x-auto rounded-lg shadow-xl">

                        <table class="rounded-lg w-full">

                            <thead class="border-b border-gray-300 bg-gray-50">

                                <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                                    <th class=" px-3 hidden lg:table-cell">

                                        Tipo

                                    </th>

                                    <th class=" px-3 hidden lg:table-cell">

                                        Registro

                                    </th>

                                    <th class=" px-3 hidden lg:table-cell">

                                        Justificación

                                    </th>

                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">

                                @foreach($persona->faltas as $falta)

                                    <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                        <td class="px-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tipo</span>

                                            {{ $falta->tipo }}

                                        </td>

                                        <td class="px-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registro</span>

                                            {{ $falta->created_at }}

                                        </td>

                                        <td class="px-3 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Justificación</span>

                                            @if ($falta->justificacion)

                                                {{ $falta->justificacion->folio }}

                                            @else

                                                Sin justificación

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                        No hay resultados.

                    </div>

                @endif

            </div>

        </div>

    </div>

@endsection

