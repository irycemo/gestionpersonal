<div class="">

    <div class="mb-5">

        <h1 class="text-3xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-thin mb-6  bg-white">Personal</h1>

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

            @can('Lista de personal')

                <button wire:click="abrirModalCrear" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right mb-5 text-sm py-2 px-4 text-white rounded-full focus:outline-none hidden md:block">

                    <img wire:loading wire:target="abrirModalCrear" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                    Agregar nueva persona

                </button>

                <button wire:click="abrirModalCrear" class="bg-gray-500 hover:shadow-lg hover:bg-gray-700 float-right mb-5 text-sm py-2 px-4 text-white rounded-full focus:outline-none md:hidden">+</button>

            @endcan

        </div>

    </div>

    @if($personal->count())

        <div class="relative overflow-x-auto rounded-lg shadow-xl">

            <table class="rounded-lg w-full">

                <thead class="border-b border-gray-300 bg-gray-50">

                    <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                        <th wire:click="order('numero_empleado')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            #Empleado

                            @if($sort == 'numero_empleado')

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

                        @if (auth()->user()->hasRole('Administrador'))

                            <th wire:click="order('codigo_barras')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                                Código de Barras

                                @if($sort == 'codigo_barras')

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

                        @endif

                        <th wire:click="order('status')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Estado

                            @if($sort == 'status')

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

                        <th wire:click="order('localidad')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Localidad

                            @if($sort == 'localidad')

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

                        <th wire:click="order('area')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Área

                            @if($sort == 'area')

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

                        <th wire:click="order('tipo')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Tipo

                            @if($sort == 'tipo')

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

                        <th wire:click="order('horario_id')" class="cursor-pointer px-3 py-3 hidden lg:table-cell">

                            Horario

                            @if($sort == 'horario_id')

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

                    @foreach($personal as $persona)

                        <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">#Empleado</span>

                                {{ $persona->numero_empleado }}

                            </td>


                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Nombre</span>

                                {{ $persona->nombre }} {{ $persona->ap_paterno }} {{ $persona->ap_materno }}

                            </td>

                            @if (auth()->user()->hasRole('Administrador'))

                                <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Código de Barras</span>

                                    {{ $persona->codigo_barras }}

                                </td>

                            @endif

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Codigo Barras</span>

                                @if($persona->status == 'activo')

                                    <span class="bg-green-400 py-1 px-2 rounded-full text-white">{{ ucfirst($persona->status) }}</span>

                                @else

                                    <span class="bg-red-400 py-1 px-2 rounded-full text-white">{{ ucfirst($persona->status) }}</span>

                                @endif

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Localidad</span>

                                {{ $persona->localidad }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Area</span>

                                {{ $persona->area }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tipo</span>

                                {{ $persona->tipo }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Horario_id</span>

                                <a href="{{ route('horarios') . '?search=' . $persona->horario->nombre }}">{{ $persona->horario->nombre }}</a>

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                @if($persona->creadoPor != null)

                                    <span class="font-semibold">Registrado por: {{$persona->creadoPor->name}}</span> <br>

                                @endif

                                {{ $persona->created_at }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                @if($persona->actualizadoPor != null)

                                    <span class="font-semibold">Actualizado por: {{$persona->actualizadoPor->name}}</span> <br>

                                @endif

                                {{ $persona->updated_at }}

                            </td>

                            <td class="px-3 py-3 w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Acciones</span>

                                <div class="flex justify-center lg:justify-start">

                                    @can('Ver personal')

                                    <a
                                        href="{{ route('personal_detalle', $persona->id) }}"
                                        class="bg-green-400 hover:shadow-lg text-white text-xs md:text-sm px-3 py-2 rounded-full mr-2 hover:bg-green-700 flex focus:outline-none"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>

                                            <p>Ver</p>

                                        </a>

                                    @endcan

                                    @can('Editar personal')

                                        <button
                                            wire:click="abrirModalEditar({{$persona}})"
                                            wire:loading.attr="disabled"
                                            wire:target="abrirModalEditar({{$persona}})"
                                            class="bg-blue-400 hover:shadow-lg text-white text-xs md:text-sm px-3 py-2 rounded-full mr-2 hover:bg-blue-700 flex focus:outline-none"
                                        >


                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>

                                            <p>Editar</p>

                                        </button>

                                    @endcan


                                    @can('Borrar personal')

                                        <button
                                            wire:click="abrirModalBorrar({{$persona}})"
                                            wire:loading.attr="disabled"
                                            wire:target="abrirModalBorrar({{$persona}})"
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

                        <td colspan="13" class="py-2 px-5">
                            {{ $personal->links()}}
                        </td>

                    </tr>

                </tfoot>

            </table>

            <div class="h-full w-full rounded-lg bg-gray-200 bg-opacity-75 absolute top-0 left-0" wire:loading wire:target="search">

                <img class="mx-auto h-16" src="{{ asset('storage/img/loading.svg') }}" alt="">

            </div>

        </div>

    @else

        <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

            No hay resultados.

        </div>

    @endif

    <x-jet-dialog-modal wire:model="modal">

        <x-slot name="title">

            @if($crear)
                Nuevo Empleado
            @elseif($editar)
                Editar Empleado
            @endif

        </x-slot>

        <x-slot name="content">

             <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <div class="flex-auto ">

                    <div>

                        <Label>#Empleado</Label>
                    </div>

                    <div>

                        <input type="number" class="bg-white rounded text-sm w-full" wire:model.defer="numero_empleado">

                    </div>

                    <div>

                        @error('numero_empleado') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

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

                        <Label>Paterno</Label>

                    </div>

                    <div>

                        <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="paterno">

                    </div>

                    <div>

                        @error('paterno') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto ">

                    <div>

                        <Label>Materno</Label>

                    </div>

                    <div>

                        <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="materno">

                    </div>

                    <div>

                        @error('materno') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <div class="flex-auto ">

                    <div>

                        <Label>Localidad</Label>
                    </div>

                    <div>

                        <select class="bg-white rounded text-sm w-full" wire:model.defer="localidad">

                            <option value="" selected>Selecciona una opción</option>

                            @foreach(App\Http\Constantes::LOCALIDADES as $ubicacion)
                                <option value="{{$ubicacion}}" >{{$ubicacion}}</option>
                           @endforeach

                         </select>


                    </div>

                    <div>

                        @error('localidad') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto ">

                    <div>

                        <Label>Área</Label>
                    </div>

                    <div>

                        <select class="bg-white rounded text-sm w-full" wire:model.defer="area">
                            <option value="" selected>Selecciona una opción</option>
                            @foreach(App\Http\Constantes::AREAS_ADSCRIPCION as $ubicacion)
                                <option value="{{$ubicacion}}" >{{$ubicacion}}</option>
                           @endforeach

                         </select>


                    </div>

                    <div>

                        @error('area') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto ">

                    <div>

                        <Label>Tipo</Label>
                    </div>

                    <div>

                        <select class="bg-white rounded text-sm w-full" wire:model.defer="tipo">
                            <option value="" selected>Selecciona una opción</option>
                            @foreach(App\Http\Constantes::TIPO as $ubicacion)
                                <option value="{{$ubicacion}}" >{{$ubicacion}}</option>
                           @endforeach

                         </select>


                    </div>

                    <div>

                        @error('tipo') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <div class="flex-auto ">

                    <div>

                        <Label>Código de Barras</Label>
                    </div>

                    <div>

                        <div x-data="{ showPassword : false }">

                            <div  class="relative rounded-md shadow-sm">

                              <input :type="showPassword ? 'text' : 'password'" id="password" class="border p-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-10 sm:text-sm border-gray-300 rounded-md" wire:model.defer="codigo_barras">

                              <div x-on:click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2" :class="showPassword ? 'block' : 'hidden'">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2" :class="showPassword ? 'hidden' : 'block'">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>

                              </div>

                            </div>

                        </div>

                    </div>

                    <div>

                        @error('codigo_barras') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto">

                    <div>
                        <Label>Teléfono</Label>
                    </div>

                    <div>

                        <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="telefono">

                    </div>

                    <div>

                        @error('telefono') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto">

                    <div>
                        <Label>Email</Label>
                    </div>

                    <div>

                        <input type="email" class="bg-white rounded text-sm w-full" wire:model.defer="email">

                    </div>

                    <div>

                        @error('email') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <div class="flex-auto">

                    <div>
                        <Label>RFC</Label>
                    </div>

                    <div>

                        <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="rfc">

                    </div>

                    <div>

                        @error('rfc') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto">

                    <div>
                        <Label>CURP</Label>
                    </div>

                    <div>

                        <input type="text" class="bg-white rounded text-sm w-full" wire:model.defer="curp">

                    </div>

                    <div>

                        @error('curp') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <div class="flex-auto">

                    <div>
                        <Label>Domicilio</Label>
                    </div>

                    <div>

                        <textarea class="bg-white rounded text-sm w-full" wire:model="domicilio" ></textarea>

                    </div>

                    <div>

                        @error('domicilio') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <div class="flex-auto">

                    <div>
                        <Label>Fecha de ingreso</Label>
                    </div>

                    <div>

                        <input type="date" class="bg-white rounded text-sm w-full" wire:model.defer="fecha_ingreso">

                    </div>

                    <div>

                        @error('fecha_ingreso') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto ">

                    <div>

                        <Label>Horario</Label>
                    </div>

                    <div>

                        <select class="bg-white rounded text-sm w-full" wire:model.defer="horario_id">
                            <option value="" selected>Selecciona una opción</option>
                            @foreach($horarios as $horario)
                                <option value="{{$horario->id }}" >{{ $horario->nombre }}</option>
                           @endforeach

                         </select>


                    </div>

                    <div>

                        @error('horario_id') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto ">

                    <div>

                        <Label>Estado</Label>
                    </div>

                    <div>

                        <select class="bg-white rounded text-sm w-full" wire:model.defer="status">
                            <option value="" selected>Selecciona una opción</option>
                            <option value="activo" >Activo</option>
                            <option value="inactivo" >Inactivo</option>

                         </select>


                    </div>

                    <div>

                        @error('status') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <div class="flex-auto">

                    <div>
                        <Label>Observaciones</Label>
                    </div>

                    <div>

                        <textarea class="bg-white rounded text-sm w-full" wire:model="observaciones" ></textarea>

                    </div>

                    <div>

                        @error('observaciones') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

            </div>

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 mb-5">

                <div class="flex-auto ">

                    <div>
                        <Label>Fotografía</Label>
                    </div>

                    <div>

                        <x-filepond wire:model="foto"  />

                    </div>

                    <div>

                        @error('foto') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

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
            Eliminar Empleado
        </x-slot>

        <x-slot name="content">
            ¿Esta seguro que desea eliminar el empleado? No será posible recuperar la información.
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
