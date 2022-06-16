@extends('layouts.admin')

@section('content')

    <h1 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3  bg-white">{{ $persona->nombre }} {{ $persona->ap_paterno }} {{ $persona->ap_materno }}</h1>

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

                    <p class="tracking-widest font-semibold text-lg">Horario</p>

                    <p>{{ $persona->horario->tipo }}</p>

                </div>

            </div>


        </div>

    </div>

    <div>

        <div class="w-full" x-data="{selected : null}">

            <div @click="selected != 1 ? selected = 1 : selected = null" class="">

                <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer  bg-white">

                    Incapacidades

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

                                    <th class="px-3 py-3 hidden lg:table-cell">

                                        Folio

                                    </th>

                                    <th  class="px-3 py-3 hidden lg:table-cell">

                                        Documento

                                    </th>

                                    <th  class=" px-3 py-3 hidden lg:table-cell">

                                        Tipo

                                    </th>

                                    <th  class=" px-3 py-3 hidden lg:table-cell">

                                        Registro

                                    </th>

                                    <th class="px-3 py-3 hidden lg:table-cell">

                                        Actualizado

                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">

                                @foreach($persona->incapacidades as $incapacidad)

                                    <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Folio</span>

                                            {{ $incapacidad->folio }}

                                        </td>


                                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Documento</span>

                                            <img class="h-20" src="{{ Storage::disk('incapacidades')->url($incapacidad->documento) }}" alt="Incapacidad">

                                        </td>

                                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tipo</span>

                                            {{ $incapacidad->tipo }}

                                        </td>

                                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                            @if($incapacidad->creadoPor != null)

                                                <span class="font-semibold">Registrado por: {{$incapacidad->creadoPor->name}}</span> <br>

                                            @endif

                                            {{ $incapacidad->created_at }}

                                        </td>

                                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

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

            <div @click="selected != 2 ? selected = 2 : selected = null" class="">

                <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer  bg-white">

                    Inasistencias

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 float-right" :class="selected == 2 ? 'transform rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="gray">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 9l-7 7-7-7" />
                    </svg>

                </h2>

            </div>

            <div
                class="text-center mb-2 overflow-hidden max-h-0 transition-all duration-500"
                x-ref="tab2"
                :style="selected == 2 ? 'max-height: ' + $refs.tab2.scrollHeight + 'px;' :  ''"
            >

                @if($persona->inasistencias->count())

                    <div class="relative overflow-x-auto rounded-lg shadow-xl">

                        <table class="rounded-lg w-full">

                            <thead class="border-b border-gray-300 bg-gray-50">

                                <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                                    <th class=" px-3 py-3 hidden lg:table-cell">

                                        Motivo

                                    </th>

                                    <th  class=" px-3 py-3 hidden lg:table-cell">

                                        Fecha

                                    </th>


                                    <th class=" px-3 py-3 hidden lg:table-cell">

                                        Archivo

                                    </th>

                                    <th class=" px-3 py-3 hidden lg:table-cell">

                                        Registro

                                    </th>

                                    <th  class=" px-3 py-3 hidden lg:table-cell">

                                        Actualizado

                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">

                                @foreach($persona->inasistencias as $inasistencia)

                                    <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Motivo</span>

                                            {{ $inasistencia->motivo }}

                                        </td>

                                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">fecha</span>

                                            {{ $inasistencia->fecha }}

                                        </td>


                                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">fecha</span>

                                            <img class="h-20" src="{{ Storage::disk('inasistencias')->url($inasistencia->archivo) }}" alt="Inasistencia">

                                        </td>

                                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                            @if($inasistencia->creadoPor != null)

                                                <span class="font-semibold">Registrado por: {{$inasistencia->creadoPor->name}}</span> <br>

                                            @endif

                                            {{ $inasistencia->created_at }}

                                        </td>

                                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                            @if($inasistencia->actualizadoPor != null)

                                                <span class="font-semibold">Actualizado por: {{$inasistencia->actualizadoPor->name}}</span> <br>

                                            @endif

                                            {{ $inasistencia->updated_at }}

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

                <h2 class="text-2xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-semibold mb-3 cursor-pointer  bg-white">

                    Justificaciones

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

                                    <th class=" px-3 py-3 hidden lg:table-cell">

                                        Folio

                                    </th>

                                    <th  class=" px-3 py-3 hidden lg:table-cell">

                                        Descripción

                                    </th>

                                    <th class=" px-3 py-3 hidden lg:table-cell">

                                        Registro

                                    </th>

                                    <th  class=" px-3 py-3 hidden lg:table-cell">

                                        Actualizado

                                    </th>

                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">

                                @foreach($persona->justificaciones as $justificacion)

                                    <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Motivo</span>

                                            {{ $justificacion->folio }}

                                        </td>

                                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">fecha</span>

                                            <img class="h-20" src="{{ Storage::disk('justificacion')->url($justificacion->documento) }}" alt="Justificación">

                                        </td>

                                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                            <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                            @if($justificacion->creadoPor != null)

                                                <span class="font-semibold">Registrado por: {{$justificacion->creadoPor->name}}</span> <br>

                                            @endif

                                            {{ $justificacion->created_at }}

                                        </td>

                                        <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

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

        </div>

    </div>

@endsection

