<div>

    <h1 class="titulo-seccion text-3xl font-thin text-gray-500 mb-3">Reportes</h1>

    <div class="p-4 mb-5 bg-white shadow-xl rounded-lg">

        <div>

            <Label>Área</Label>

        </div>

        <div>

            <select class="bg-white rounded text-sm mb-3" wire:model="area">
                <option selected>Selecciona una área</option>
                <option value="inasistencias">Inasistencias</option>
                <option value="permisos">Permisos</option>
                <option value="incapacidades">Incapacidades</option>
                <option value="personal">Personal</option>
                <option value="justificaciones">Justificaciones</option>
            </select>

        </div>

        <div class="mb-5 flex space-x-8">

            <div>

                <div>

                    <Label>Fecha inicial</Label>

                </div>

                <div>

                    <input type="date" class="bg-white rounded text-sm " wire:model="fecha1">

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

                    <input type="date" class="bg-white rounded text-sm " wire:model="fecha2">

                </div>

                <div>

                    @error('fecha2') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                </div>

            </div>

        </div>

        @if ($verInasistencias)

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 items-center">

                <div class="flex-auto ">

                    <div>

                        <Label>Empleado</Label>
                    </div>

                    <div>

                        <select class="rounded text-sm w-full" wire:model.defer="inasistencia_empleado">

                            <option value="" selected>Seleccione un empleado</option>

                            @foreach ($empleados as $empleado)


                                <option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>

                            @endforeach

                        </select>

                    </div>

                    <div>

                        @error('inasistencia_empleado') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

                <div>
                    <button
                        class="bg-blue-500 hover:shadow-lg hover:bg-blue-700  text-sm py-2 px-4 text-white rounded-full focus:outline-none mt-3 w-full"
                        wire:click="filtrarInasistencias"
                        wire:loading.attr="disabled"
                        wire:target="filtrarInasistencias"
                    >
                        Filtrar
                    </button>

                </div>

            </div>

        @endif
        @if ($verPermisos)

            <div class="flex flex-col md:flex-row justify-between md:space-x-3 items-center">

                <div class="flex-auto ">

                    <div>

                        <Label>Clave</Label>
                    </div>

                    <div>

                        <input class="rounded text-sm w-full" type="text" wire:model="clavePermiso">

                    </div>

                    <div>

                        @error('clavePermiso') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

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
    </div>

    @if ($inasistencias_filtradas)

        @if(count($inasistencias_filtradas))

            <div class="rounded-lg shadow-xl mb-5 p-4 font-thin flex items-center justify-between bg-white">

                <p class="text-xl font-extralight">Se encontraron: {{ count($inasistencias_filtradas) }} registros con los filtros seleccionados.</p>

                <button wire:click="descargarExcel('inasistencias')" class="text-white flex items-center border rounded-full px-4 py-2 bg-green-500 hover:bg-green-700">

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

                                Motivo

                            </th>

                            <th  class="px-3 py-3 hidden lg:table-cell">

                                Fecha

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

                        @foreach($inasistencias_filtradas as $inasistencia)

                            <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                                <td class="w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Motivo</span>

                                    {{ $inasistencia->motivo }}

                                </td>

                                <td class="w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Fecha</span>

                                    {{ $inasistencia->fecha }}

                                </td>

                                <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Empleado</span>

                                    {{ $inasistencia->persona->nombre }}

                                </td>

                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                    @if($inasistencia->created_by != null)

                                        <span class="font-semibold">Registrado por: {{$inasistencia->createdBy->name}}</span> <br>

                                    @endif

                                    {{ $inasistencia->created_at }}

                                </td>

                                <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                    @if($inasistencia->updated_by != null)

                                        <span class="font-semibold">Actualizado por: {{$inasistencia->updatedBy->name}}</span> <br>

                                    @endif

                                    {{ $inasistencia->updated_at }}

                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                </table>

                <div class="h-full w-full rounded-lg bg-gray-200 bg-opacity-75 absolute top-0 left-0" wire:loading wire:target="requests_filtered">

                    <img class="mx-auto h-16" src="{{ asset('storage/img/loading.svg') }}" alt="">

                </div>

            </div>

        @else

            <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

                No hay resultados.

            </div>

        @endif

    @endif


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

                            <th class="px-3 py-3 hidden lg:table-cell">

                                Clave

                            </th>

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

                                    <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Clave</span>

                                    {{ $permiso->clave }}

                                </td>

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

</div>
