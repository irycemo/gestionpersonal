<div class="">

    <div class="mb-5" >

        <h1 class="text-3xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-thin mb-6  bg-white">Horarios</h1>

        <div class="flex justify-between">

            <div>

                <input type="text" wire:model.debounce.500ms="search" placeholder="Buscar" class="bg-white rounded-full text-sm">

                <select class="bg-white rounded-full text-sm" wire:model="pagination">

                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>

                </select>

            </div>

            @can('Crear horario')

                <button wire:click="abrirModalCrear" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right mb-5 text-sm py-2 px-4 text-white rounded-full focus:outline-none hidden md:block">

                    <img wire:loading wire:target="abrirModalCrear" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">
                    Agregar nuevo horario

                </button>

                <button wire:click="abrirModalCrear" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right mb-5 text-sm py-2 px-4 text-white rounded-full focus:outline-none md:hidden">+</button>

            @endcan

        </div>

    </div>

    @if($horarios->count())

        <div class="relative overflow-x-auto rounded-lg shadow-xl">

            <table class="rounded-lg w-full">

                <thead class="border-b border-gray-300 bg-gray-50">

                    <tr class="text-xs  text-gray-500 uppercase text-left traling-wider">

                        <th wire:click="order('nombre')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Nombre

                            @if($sort == 'nombre')

                                @if($direction == 'asc')

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                    </svg>

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                    </svg>

                                @endif

                            @else

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>

                            @endif

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Descripción

                        </th>

                        <th  class=" px-3 py-3 hidden lg:table-cell" >

                            Tolerancia

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell" >

                            Falta

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Lunes Entrada

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Lunes salida

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Martes Entrada

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Martes salida

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Miercoles Entrada

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Miercoles salida

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Jueves Entrada

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Jueves salida

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Viernes Entrada

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">

                            Viernes salida

                        </th>

                        <th wire:click="order('created_at')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Registro

                            @if($sort == 'created_at')

                                @if($direction == 'asc')

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                    </svg>

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                    </svg>

                                @endif

                            @else

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>

                            @endif

                        </th>

                        <th wire:click="order('updated_at')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Actualizado

                            @if($sort == 'updated_at')

                                @if($direction == 'asc')

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                    </svg>

                                @else

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                    </svg>

                                @endif

                            @else

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 float-right" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>

                            @endif

                        </th>

                        <th class="px-3 py-3 hidden lg:table-cell">Acciones</th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">

                    @foreach($horarios as $horario)

                        <tr class="text-sm  text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Nombre</span>

                                {{ $horario->nombre }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto capitalize p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden  absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Descripción</span>

                                @if ($horario->descripcion)

                                    {{ $horario->descripcion }}

                                @else

                                    N/A

                                @endif

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tolerancia</span>

                                {{ $horario->tolerancia }} min

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Falta</span>

                                {{ $horario->falta }} min

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Lunes Entrada</span>

                                {{ $horario->lunes_entrada }}

                            </td>


                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Lunes Salida</span>

                                {{ $horario->lunes_salida }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Martes Entrada</span>

                                {{ $horario->martes_entrada }}

                            </td>


                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Martes Salida</span>

                                {{ $horario->martes_salida }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Miercoles Entrada</span>

                                {{ $horario->miercoles_entrada }}

                            </td>


                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Miercoles Salida</span>

                                {{ $horario->miercoles_salida }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Jueves Entrada</span>

                                {{ $horario->jueves_entrada }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Jueves Salida</span>

                                {{ $horario->jueves_salida }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Viernes Entrada</span>

                                {{ $horario->viernes_entrada }}

                            </td>


                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Viernes Salida</span>

                                {{ $horario->viernes_salida }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                @if($horario->creadoPor != null)

                                    <span class="font-semibold">Registrado por: {{$horario->creadoPor->name}}</span> <br>

                                @endif

                                {{ $horario->created_at }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                @if($horario->actualizadoPor != null)

                                    <span class="font-semibold">Actualizado por: {{$horario->actualizadoPor->name}}</span> <br>

                                @endif

                                {{ $horario->updated_at }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Acciones</span>

                                <div class="flex justify-center lg:justify-start">

                                    @can('Editar horario')

                                        <button
                                            wire:click="abrirModalEditar({{$horario}})"
                                            wire:loading.attr="disabled"
                                            wire:target="abrirModalEditar({{$horario}})"
                                            class="bg-blue-400 hover:shadow-lg text-white text-xs md:text-sm px-3 py-2 rounded-full mr-2 hover:bg-blue-700 flex focus:outline-none"
                                        >


                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>

                                            <p>Editar</p>

                                        </button>

                                    @endcan

                                    @can('Borrar horario')

                                        <button
                                            wire:click="abrirModalBorrar({{$horario}})"
                                            wire:loading.attr="disabled"
                                            wire:target="abrirModalBorrar({{$horario}})"
                                            class="bg-red-400 hover:shadow-lg text-white text-xs md:text-sm px-3 py-2 rounded-full hover:bg-red-700 flex focus:outline-none"
                                        >

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>

                                            <p>Eliminar</p>

                                        </button>

                                    @endcan

                                </div>

                            </td>
                        </tr>

                    @endforeach

                </tbody>

                <tfoot class="border-gray-300 bg-gray-50">

                    <tr>

                        <td colspan="18" class="py-2 px-5">
                            {{ $horarios->links()}}
                        </td>

                    </tr>

                </tfoot>

            </table>

            <div class="h-full w-full rounded-lg bg-gray-200 bg-opacity-75 absolute top-0 left-0" wire:loading.delay.longer>

                <img class="mx-auto h-16" src="{{ asset('storage/img/loading.svg') }}" alt="">

            </div>

        </div>

    @else

        <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

            No hay horarios registrados.

        </div>

    @endif

    <x-jet-dialog-modal wire:model="modal">

        <x-slot name="title">

            @if($crear)
                Nuevo horario
            @elseif($editar)
                Editar horario
            @endif

        </x-slot>
        <x-slot name="content">

             <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <div class="flex-auto ">

                    <div>

                        <Label>Nombre</Label>
                    </div>

                    <div>

                        <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="nombre">

                    </div>

                    <div>

                        @error('nombre') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto ">

                    <div>

                        <Label>Tolerancia</Label>
                    </div>

                    <div>

                        <input type="number" class="bg-white rounded text-sm w-full" wire:model.defer="tolerancia">

                    </div>

                    <div>

                        @error('tolerancia') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto ">

                    <div>

                        <Label>Falta</Label>
                    </div>

                    <div>

                        <input type="number" class="bg-white rounded text-sm w-full" wire:model.defer="falta">

                    </div>

                    <div>

                        @error('falta') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <div class="flex-auto ">

                    <table class="mx-auto w-full table-auto">

                        <thead>

                            <tr class="text-xs  text-gray-700 uppercase traling-wider text-center">
                                <th>Día</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                            </tr>

                        </thead>

                        <tbody class="space-y-4">

                            <tr class="">

                                <td class="px-3 py-2">
                                    Lunes
                                </td>
                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model.defer="lunes_entrada">

                                    </div>

                                    <div>

                                        @error('lunes_entrada') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>
                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model.defer="lunes_salida">

                                    </div>

                                    <div>

                                        @error('lunes_salida') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>

                            </tr>

                            <tr>

                                <td class="px-3 py-2">
                                    Martes
                                </td>

                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model.defer="martes_entrada">

                                    </div>

                                    <div>

                                        @error('martes_entrada') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>
                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model.defer="martes_salida">

                                    </div>

                                    <div>

                                        @error('martes_salida') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>

                            </tr>

                            <tr>

                                <td class="px-3 py-2">
                                    Miercoles
                                </td>
                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model.defer="miercoles_entrada">

                                    </div>

                                    <div>

                                        @error('miercoles_entrada') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>
                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model.defer="miercoles_salida">

                                    </div>

                                    <div>

                                        @error('miercoles_salida') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>

                            </tr>

                            <tr>

                                <td class="px-3 py-2">
                                    Jueves
                                </td>
                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model.defer="jueves_entrada">

                                    </div>

                                    <div>

                                        @error('jueves_entrada') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>
                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model.defer="jueves_salida">

                                    </div>

                                    <div>

                                        @error('jueves_salida') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>

                            </tr>

                            <tr>

                                <td class="px-3 py-2">
                                    Viernes
                                </td>
                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model.defer="viernes_entrada">

                                    </div>

                                    <div>

                                        @error('viernes_entrada') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>
                                <td class="px-3 py-2">
                                    <div>

                                        <input type="time" class="bg-white rounded text-sm w-full" wire:model.defer="viernes_salida">

                                    </div>

                                    <div>

                                        @error('viernes_salida') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>



            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <div class="flex-auto ">

                    <div>

                        <Label>Descripción</Label>
                    </div>

                    <div>

                        <textarea wire:model="descripcion" class="bg-white rounded text-sm w-full"></textarea>

                    </div>

                    <div>

                        @error('descripcion') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

            </div>

        </x-slot>

        <x-slot name="footer">

            <div class="float-righ">

                @if($crear)

                    <button
                        wire:click="crear"
                        wire:loading.attr="disabled"
                        wire:target="crear"
                        class="bg-blue-400 text-white hover:shadow-lg font-bold px-4 py-2 rounded-full text-sm mb-2 hover:bg-blue-700 flaot-left mr-1 focus:outline-none">

                        <img wire:loading wire:target="crear" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        Guardar
                    </button>

                @elseif($editar)

                    <button
                        wire:click="actualizar"
                        wire:loading.attr="disabled"
                        wire:target="actualizar"
                        class="bg-blue-400 hover:shadow-lg text-white font-bold px-4 py-2 rounded-full text-sm mb-2 hover:bg-blue-700 flaot-left mr-1 focus:outline-none">

                        <img wire:loading wire:target="actualizar" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                        Actualizar
                    </button>

                @endif

                <button
                    wire:click="resetearTodo"
                    wire:loading.attr="disabled"
                    wire:target="resetearTodo"
                    type="button"
                    class="bg-red-400 hover:shadow-lg text-white font-bold px-4 py-2 rounded-full text-sm mb-2 hover:bg-red-700 flaot-left focus:outline-none">
                    Cerrar
                </button>

            </div>

        </x-slot>

    </x-jet-dialog-modal>

    <x-jet-confirmation-modal wire:model="modalBorrar">

        <x-slot name="title">
            Eliminar Horario
        </x-slot>

        <x-slot name="content">
            ¿Esta seguro que desea eliminar este horario? No sera posible recuperar la información.
        </x-slot>

        <x-slot name="footer">

            <x-jet-secondary-button
                wire:click="$toggle('modalBorrar')"
                wire:loading.attr="disabled"
            >
                No
            </x-jet-secondary-button>

            <x-jet-danger-button
                class="ml-2"
                wire:click="borrar()"
                wire:loading.attr="disabled"
                wire:target="borrar"
            >
                Borrar
            </x-jet-danger-button>

        </x-slot>

    </x-jet-confirmation-modal>

</div>
