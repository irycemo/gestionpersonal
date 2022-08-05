<div>

    <h1 class="titulo-seccion text-3xl font-thin text-gray-500 mb-3">Reportes</h1>

    <div class="p-4 mb-5 bg-white shadow-xl rounded-lg">

        <div>

            <Label>Área</Label>

        </div>

        <div>

            <select class="bg-white rounded text-sm mb-3" wire:model="area">
                <option selected>Selecciona una área</option>
                <option value="permisos">Permisos</option>
                <option value="incapacidades">Incapacidades</option>
                <option value="personal">Personal</option>
                <option value="justificaciones">Justificaciones</option>
                <option value="faltas">Faltas</option>
                <option value="retardos">Retardos</option>


            </select>

        </div>

        <div class="mb-5 flex space-x-8">

            <div>

                <div>

                    <Label>Fecha inicial</Label>

                </div>

                <div>

                    <input type="date" class="bg-white rounded text-sm " wire:model.defer="fecha1">

                </div>

                <div>

                    @error('fecha1') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

            <div>

                <div>

                    <Label>Fecha final</Label>

                </div>

                <div>

                    <input type="date" class="bg-white rounded text-sm " wire:model.defer="fecha2">

                </div>

                <div>

                    @error('fecha2') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

        </div>

        @if ($verPermisos)

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 items-center">

                <div class="flex-auto ">

                    <div>

                        <Label>Descripción</Label>
                    </div>

                    <div>

                        <input class="rounded text-sm w-full" type="text" wire:model="descripcionPermiso">

                    </div>

                    <div>

                        @error('descripcionPermiso') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div>
                    <button
                        class="bg-blue-500 hover:shadow-lg hover:bg-blue-700  text-sm py-2 px-4 text-white rounded-full focus:outline-none mt-3 w-full"
                        wire:click="filtrarPermisos"
                        wire:loading.attr="disabled"
                        wire:target="filtrarPermisos"
                    >
                        Filtrar
                    </button>

                </div>

            </div>

        @endif

        @if ($verIncapacidades)

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 items-center">

                <div class="flex-auto ">

                    <div>

                        <Label>Empleado</Label>
                    </div>

                    <div>

                        <select class="rounded text-sm w-full" wire:model.defer="incapacidades_empleado">

                            <option value="" selected>Seleccione un empleado</option>

                            @foreach ($empleados as $empleado)

                                <option value="{{$empleado->id}}" >{{$empleado->nombre}} {{$empleado->ap_paterno}} {{$empleado->ap_materno}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        @error('incapacidades_empleado') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto ">

                    <div>

                        <Label>Folio</Label>
                    </div>

                    <div>

                        <input class="rounded text-sm w-full" type="text" wire:model="incapacidades_folio">

                    </div>

                    <div>

                        @error('incapacidades_folio') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto ">

                    <div>

                        <Label>Tipo</Label>
                    </div>

                    <div>

                        <input class="rounded text-sm w-full" type="text" wire:model="incapacidades_tipo">

                    </div>

                    <div>

                        @error('incapacidades_tipo') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div>
                    <button
                        class="bg-blue-500 hover:shadow-lg hover:bg-blue-700  text-sm py-2 px-4 text-white rounded-full focus:outline-none mt-3 w-full"
                        wire:click="filtrarIncapacidades"
                        wire:loading.attr="disabled"
                        wire:target="filtrarIncapacidades"
                    >
                        Filtrar
                    </button>

                </div>

            </div>

        @endif

        @if ($verJustificaciones)

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 items-center">

                <div class="flex-auto ">

                    <div>

                        <Label>Empleado</Label>
                    </div>

                    <div>

                        <select class="rounded text-sm w-full" wire:model.defer="justificaciones_empleado">

                            <option value="" selected>Seleccione un empleado</option>

                            @foreach ($empleados as $empleado)

                                <option value="{{$empleado->id}}" >{{$empleado->nombre}} {{$empleado->ap_paterno}} {{$empleado->ap_materno}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        @error('justificaciones_empleado') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto ">

                    <div>

                        <Label>Folio</Label>
                    </div>

                    <div>

                        <input class="rounded text-sm w-full" type="text" wire:model="justificaciones_folio">

                    </div>

                    <div>

                        @error('justificaciones_folio') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div>
                    <button
                        class="bg-blue-500 hover:shadow-lg hover:bg-blue-700  text-sm py-2 px-4 text-white rounded-full focus:outline-none mt-3 w-full"
                        wire:click="filtrarJustificaciones"
                        wire:loading.attr="disabled"
                        wire:target="filtrarJustificaciones"
                    >
                        Filtrar
                    </button>

                </div>

            </div>

        @endif

        @if ($verPersonal)

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 items-center">

                <div class="flex-auto ">

                    <div>

                        <Label>Status</Label>
                    </div>

                    <div>

                        <select class="rounded text-sm w-full" wire:model.defer="status_empleado">

                            <option value="" selected>Seleccione un empleado</option>

                            <option value="activo" >Activo</option>

                            <option value="inactivo" >Inactivo</option>


                        </select>


                    </div>

                    <div>

                        @error('status_empleado') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto ">

                    <div>

                        <Label>Localidad</Label>
                    </div>

                    <div>

                        <select class="rounded text-sm w-full" wire:model.defer="localidad_empleado">

                            <option value="" selected>Seleccione una localidad</option>

                            @foreach ($localidades as $localidad)


                                <option value="{{ $localidad}}">{{ $localidad}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        @error('localidad_empleado') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto ">

                    <div>

                        <Label>Área</Label>
                    </div>

                    <div>

                        <select class="rounded text-sm w-full" wire:model.defer="area_empleado">

                            <option value="" selected>Seleccione Área</option>

                            @foreach ($areas as $area)


                                <option value="{{ $area}}">{{ $area}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        @error('area_empleado') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto ">

                    <div>

                        <Label>Tipo</Label>
                    </div>

                    <div>

                        <select class="rounded text-sm w-full" wire:model.defer="tipo_empleado">

                            <option value="" selected>Seleccione Tipo de Empleado</option>

                            @foreach ($tipos as $tipo)


                                <option value="{{ $tipo}}">{{ $tipo}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        @error('tipo_empleado') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto ">

                    <div>

                        <Label>Horario</Label>
                    </div>

                    <div>

                        <select class="rounded text-sm w-full" wire:model.defer="horario_empleado">

                            <option value="" selected>Seleccione el Horario</option>

                            @foreach ($horarios as $horario)


                                <option value="{{ $horario->id}}">{{ $horario->tipo}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        @error('horario_empleado') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div>
                    <button
                        class="bg-blue-500 hover:shadow-lg hover:bg-blue-700  text-sm py-2 px-4 text-white rounded-full focus:outline-none mt-3 w-full"
                        wire:click="filtrarPersonal"
                        wire:loading.attr="disabled"
                        wire:target="filtrarPersonal"
                    >
                        Filtrar
                    </button>

                </div>

            </div>

        @endif

        @if ($verFaltas)

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 items-center">

                <div class="flex-auto ">

                    <div>

                        <Label>Empleado</Label>
                    </div>

                    <div>

                        <select class="rounded text-sm w-full" wire:model.defer="falta_empleado">

                            <option value="" selected>Seleccione un empleado</option>

                            @foreach ($empleados as $empleado)

                                <option value="{{$empleado->id}}" >{{$empleado->nombre}} {{$empleado->ap_paterno}} {{$empleado->ap_materno}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        @error('falta_empleado') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div class="flex-auto ">

                    <div>

                        <Label>Tipo</Label>
                    </div>

                    <div>

                        <input type="text" class="rounded text-sm w-full" wire:model.defer="falta_tipo">

                    </div>

                    <div>

                        @error('falta_tipo') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div>
                    <button
                        class="bg-blue-500 hover:shadow-lg hover:bg-blue-700  text-sm py-2 px-4 text-white rounded-full focus:outline-none mt-3 w-full"
                        wire:click="filtrarFaltas"
                        wire:loading.attr="disabled"
                        wire:target="filtrarFaltas"
                    >
                        Filtrar
                    </button>

                </div>

            </div>

        @endif

        @if ($verRetardos)

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 items-center">

                <div class="flex-auto ">

                    <div>

                        <Label>Empleado</Label>
                    </div>

                    <div>

                        <select class="rounded text-sm w-full" wire:model.defer="retardo_empleado">

                            <option value="" selected>Seleccione un empleado</option>

                            @foreach ($empleados as $empleado)

                                <option value="{{$empleado->id}}" >{{$empleado->nombre}} {{$empleado->ap_paterno}} {{$empleado->ap_materno}}</option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        @error('retardo_empleado') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div>
                    <button
                        class="bg-blue-500 hover:shadow-lg hover:bg-blue-700  text-sm py-2 px-4 text-white rounded-full focus:outline-none mt-3 w-full"
                        wire:click="filtrarRetardos"
                        wire:loading.attr="disabled"
                        wire:target="filtrarRetardos"
                    >
                        Filtrar
                    </button>

                </div>

            </div>

        @endif

    </div>

    @if ($permisos_filtrados)

        @if(count($permisos_filtrados))

            <div class="rounded-lg shadow-xl mb-5 p-4 font-thin flex items-center justify-between bg-white">

                <p class="text-xl font-extralight">Se encontraron: {{ count($permisos_filtrados) }} registros con los filtros seleccionados.</p>

                <button wire:click="descargarExcel('permisos')" class="text-white flex items-center border rounded-full px-4 py-2 bg-green-500 hover:bg-green-700">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>

                    Exportar a Excel

                </button>

            </div>

            <div class="relative overflow-x-auto rounded-lg shadow-xl">

                <table class="rounded-lg w-full">

                    <thead class="border-b border-gray-300 bg-gray-50">

                        <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                            <th  class="px-3 py-3 hidden lg:table-cell">

                                Descripción

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Cantidad límite

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Registro

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Actualizado

                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none">

                        @foreach($permisos_filtrados as $permiso)

                            <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                <td class="w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Descripción</span>

                                    {{ $permiso->descripcion }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Cantidad límite</span>

                                    {{ $permiso->limite }}

                                </td>

                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                    @if($permiso->created_by != null)

                                        <span class="font-semibold">Registrado por: {{$permiso->createdBy->name}}</span> <br>

                                    @endif

                                    {{ $permiso->created_at }}

                                </td>

                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                    @if($permiso->updated_by != null)

                                        <span class="font-semibold">Actualizado por: {{$permiso->updatedBy->name}}</span> <br>

                                    @endif

                                    {{ $permiso->updated_at }}

                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                </table>

                <div class="h-full w-full rounded-lg bg-gray-200 bg-opacity-75 absolute top-0 left-0" wire:loading wire:target="permisos_filtrados">

                    <img class="mx-auto h-16" src="{{ asset('storage/img/loading.svg') }}" alt="">

                </div>

            </div>

        @else

            <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                No hay resultados.

            </div>

        @endif

    @endif

    @if ($incapacidades_filtradas)

        @if(count($incapacidades_filtradas))

            <div class="rounded-lg shadow-xl mb-5 p-4 font-thin flex items-center justify-between bg-white">

                <p class="text-xl font-extralight">Se encontraron: {{ count($incapacidades_filtradas) }} registros con los filtros seleccionados.</p>

                <button wire:click="descargarExcel('incapacidades')" class="text-white flex items-center border rounded-full px-4 py-2 bg-green-500 hover:bg-green-700">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>

                    Exportar a Excel

                </button>

            </div>

            <div class="relative overflow-x-auto rounded-lg shadow-xl">

                <table class="rounded-lg w-full">

                    <thead class="border-b border-gray-300 bg-gray-50">

                        <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Folio

                            </th>

                            <th  class="px-3 py-3 hidden lg:table-cell">

                                Tipo

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Empleado

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Registro

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Actualizado

                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none">

                        @foreach($incapacidades_filtradas as $incapacidad)

                            <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                <td class="w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Folio</span>

                                    {{ $incapacidad->folio }}

                                </td>

                                <td class="w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tipo</span>

                                    {{ $incapacidad->tipo }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Empleado</span>

                                    {{ $incapacidad->persona->nombre }} {{ $incapacidad->persona->ap_paterno }} {{ $incapacidad->persona->ap_materno }}

                                </td>

                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                    @if($incapacidad->created_by != null)

                                        <span class="font-semibold">Registrado por: {{$incapacidad->createdBy->name}}</span> <br>

                                    @endif

                                    {{ $incapacidad->created_at }}

                                </td>

                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                    @if($incapacidad->updated_by != null)

                                        <span class="font-semibold">Actualizado por: {{$incapacidad->updatedBy->name}}</span> <br>

                                    @endif

                                    {{ $incapacidad->updated_at }}

                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                </table>

                <div class="h-full w-full rounded-lg bg-gray-200 bg-opacity-75 absolute top-0 left-0" wire:loading wire:target="incapacidades_filtradas">

                    <img class="mx-auto h-16" src="{{ asset('storage/img/loading.svg') }}" alt="">

                </div>

            </div>

        @else

            <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                No hay resultados.

            </div>

        @endif

    @endif

    @if ($justificaciones_filtradas)

        @if(count($justificaciones_filtradas))

            <div class="rounded-lg shadow-xl mb-5 p-4 font-thin flex items-center justify-between bg-white">

                <p class="text-xl font-extralight">Se encontraron: {{ count($justificaciones_filtradas) }} registros con los filtros seleccionados.</p>

                <button wire:click="descargarExcel('justificaciones')" class="text-white flex items-center border rounded-full px-4 py-2 bg-green-500 hover:bg-green-700">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>

                    Exportar a Excel

                </button>

            </div>

            <div class="relative overflow-x-auto rounded-lg shadow-xl">

                <table class="rounded-lg w-full">

                    <thead class="border-b border-gray-300 bg-gray-50">

                        <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Folio

                            </th>


                            <th class="px-3 py-3 hidden lg:table-cell">

                                Empleado

                            </th>


                            <th class="px-3 py-3 hidden lg:table-cell">

                                RETARDO/FALTA

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Registro

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Actualizado

                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none">

                        @foreach($justificaciones_filtradas as $justificacion)

                            <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                <td class="w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Folio</span>

                                    {{ $justificacion->folio }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Empleado</span>

                                    {{ $justificacion->persona->nombre }} {{ $justificacion->persona->ap_paterno }} {{ $justificacion->persona->ap_materno }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Retardo / Falta</span>

                                    @if ($justificacion->retardo)

                                        Retardo: {{ $justificacion->retardo->created_at }}

                                    @elseif($justificacion->falta)

                                        Falta: {{ $justificacion->falta->tipo }} / {{ $justificacion->falta->created_at }}

                                    @endif

                                </td>

                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                    @if($justificacion->created_by != null)

                                        <span class="font-semibold">Registrado por: {{$justificacion->createdBy->name}}</span> <br>

                                    @endif

                                    {{ $justificacion->created_at }}

                                </td>

                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                    @if($justificacion->updated_by != null)

                                        <span class="font-semibold">Actualizado por: {{$justificacion->updatedBy->name}}</span> <br>

                                    @endif

                                    {{ $justificacion->updated_at }}

                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                </table>

                <div class="h-full w-full rounded-lg bg-gray-200 bg-opacity-75 absolute top-0 left-0" wire:loading wire:target="justificaciones_filtradas">

                    <img class="mx-auto h-16" src="{{ asset('storage/img/loading.svg') }}" alt="">

                </div>

            </div>

        @else

            <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                No hay resultados.

            </div>

        @endif

    @endif

    @if ($personal_filtradas)

        @if(count($personal_filtradas))

            <div class="rounded-lg shadow-xl mb-5 p-4 font-thin flex items-center justify-between bg-white">

                <p class="text-xl font-extralight">Se encontraron: {{ count($personal_filtradas) }} registros con los filtros seleccionados.</p>

                <button wire:click="descargarExcel('personal')" class="text-white flex items-center border rounded-full px-4 py-2 bg-green-500 hover:bg-green-700">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>

                    Exportar a Excel

                </button>

            </div>

            <div class="relative overflow-x-auto rounded-lg shadow-xl">

                <table class="rounded-lg w-full">

                    <thead class="border-b border-gray-300 bg-gray-50">

                        <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Número de empleado

                            </th>


                            <th class="px-3 py-3 hidden lg:table-cell">

                                Status

                            </th>


                            <th class="px-3 py-3 hidden lg:table-cell">

                                Nombre

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Código de barras

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Localidad

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Área

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Tipo

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                RFC

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                CURP

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Teléfono

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Domicilio

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                eMail

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Fecha de ingreso

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Horario

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Observaciones

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Registro

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Actualizado

                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none">

                        @foreach($personal_filtradas as $persona)

                            <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                <td class="w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Número de empleado</span>

                                    {{ $persona->numero_empleado }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Status</span>

                                    {{ $persona->status }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Nombre</span>

                                    {{ $persona->nombre }} {{ $persona->ap_paterno }} {{ $persona->ap_materno }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Código de barras</span>

                                    {{ $persona->codigo_barras }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Localidad</span>

                                    {{ $persona->localidad }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Área</span>

                                    {{ $persona->area }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tipo</span>

                                    {{ $persona->tipo }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">RFC</span>

                                    {{ $persona->rfc }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">CURP</span>

                                    {{ $persona->curp }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Teléfono</span>

                                    {{ $persona->telefono }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Domicilio</span>

                                    {{ $persona->domicilio }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">eMail</span>

                                    {{ $persona->email }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Fecha de ingreso</span>

                                    {{ $persona->fecha_ingreso }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Horario</span>

                                    {{ $persona->horario->tipo }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Observaciones</span>

                                    {{ $persona->observaciones }}

                                </td>

                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                    @if($persona->created_by != null)

                                        <span class="font-semibold">Registrado por: {{$persona->createdBy->name}}</span> <br>

                                    @endif

                                    {{ $persona->created_at }}

                                </td>

                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                    @if($persona->updated_by != null)

                                        <span class="font-semibold">Actualizado por: {{$persona->updatedBy->name}}</span> <br>

                                    @endif

                                    {{ $persona->updated_at }}

                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                </table>

                <div class="h-full w-full rounded-lg bg-gray-200 bg-opacity-75 absolute top-0 left-0" wire:loading wire:target="personal_filtradas">

                    <img class="mx-auto h-16" src="{{ asset('storage/img/loading.svg') }}" alt="">

                </div>

            </div>

        @else

            <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                No hay resultados.

            </div>

        @endif

    @endif

    @if ($faltas_filtradas)

        @if(count($faltas_filtradas))

            <div class="rounded-lg shadow-xl mb-5 p-4 font-thin flex items-center justify-between bg-white">

                <p class="text-xl font-extralight">Se encontraron: {{ count($faltas_filtradas) }} registros con los filtros seleccionados.</p>

                <button wire:click="descargarExcel('faltas')" class="text-white flex items-center border rounded-full px-4 py-2 bg-green-500 hover:bg-green-700">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>

                    Exportar a Excel

                </button>

            </div>

            <div class="relative overflow-x-auto rounded-lg shadow-xl">

                <table class="rounded-lg w-full">

                    <thead class="border-b border-gray-300 bg-gray-50">

                        <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Tipo

                            </th>

                             <th class="px-3 py-3 hidden lg:table-cell">

                                Empleado

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Justificación

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Registro

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Actualizado

                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none">

                        @foreach($faltas_filtradas as $falta)

                            <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                <td class="w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tipo</span>

                                    {{ $falta->tipo }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Empleado</span>

                                    {{ $falta->persona->nombre }} {{ $falta->persona->ap_paterno }} {{ $falta->persona->ap_materno }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Justificación</span>

                                    {{ $falta->justificacion ? 'Justificada':'Sin justificar' }}

                                </td>


                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                    @if($falta->created_by != null)

                                        <span class="font-semibold">Registrado por: {{$falta->createdBy->name}}</span> <br>

                                    @endif

                                    {{ $falta->created_at }}

                                </td>

                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                    @if($falta->updated_by != null)

                                        <span class="font-semibold">Actualizado por: {{$falta->updatedBy->name}}</span> <br>

                                    @endif

                                    {{ $falta->updated_at }}

                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                </table>

                <div class="h-full w-full rounded-lg bg-gray-200 bg-opacity-75 absolute top-0 left-0" wire:loading wire:target="faltas_filtradas">

                    <img class="mx-auto h-16" src="{{ asset('storage/img/loading.svg') }}" alt="">

                </div>

            </div>

        @else

            <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                No hay resultados.

            </div>

        @endif

    @endif

    @if ($retardos_filtrados)

        @if(count($retardos_filtrados))

            <div class="rounded-lg shadow-xl mb-5 p-4 font-thin flex items-center justify-between bg-white">

                <p class="text-xl font-extralight">Se encontraron: {{ count($retardos_filtrados) }} registros con los filtros seleccionados.</p>

                <button wire:click="descargarExcel('retardos')" class="text-white flex items-center border rounded-full px-4 py-2 bg-green-500 hover:bg-green-700">

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>

                    Exportar a Excel

                </button>

            </div>

            <div class="relative overflow-x-auto rounded-lg shadow-xl">

                <table class="rounded-lg w-full">

                    <thead class="border-b border-gray-300 bg-gray-50">

                        <tr class="text-xs font-medium text-gray-500 uppercase text-left traling-wider">

                              <th class="px-3 py-3 hidden lg:table-cell">

                                Empleado

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Justificación

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Registro

                            </th>

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Actualizado

                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none">

                        @foreach($retardos_filtrados as $retardo)

                            <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">


                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Empleado</span>

                                    {{ $retardo->persona->nombre }} {{ $retardo->persona->ap_paterno }} {{ $retardo->persona->ap_materno }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Justificación</span>

                                    {{ $retardo->justificacion ? 'Justificada':'Sin justificar' }}

                                </td>


                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                    @if($retardo->created_by != null)

                                        <span class="font-semibold">Registrado por: {{$retardo->createdBy->name}}</span> <br>

                                    @endif

                                    {{ $retardo->created_at }}

                                </td>

                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                    @if($retardo->updated_by != null)

                                        <span class="font-semibold">Actualizado por: {{$retardo->updatedBy->name}}</span> <br>

                                    @endif

                                    {{ $retardo->updated_at }}

                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                </table>

                <div class="h-full w-full rounded-lg bg-gray-200 bg-opacity-75 absolute top-0 left-0" wire:loading wire:target="retardos_filtrados">

                    <img class="mx-auto h-16" src="{{ asset('storage/img/loading.svg') }}" alt="">

                </div>

            </div>

        @else

            <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                No hay resultados.

            </div>

        @endif

    @endif

</div>
