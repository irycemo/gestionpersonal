<div>

    <div class="md:flex md:flex-row flex-col md:space-x-4 items-end bg-white rounded-xl mb-5 p-4">

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

        <div class="mt-2 md:mt-0">

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

    <div class="md:flex flex-col md:flex-row justify-between md:space-x-3 items-center bg-white rounded-xl mb-5 p-4">

        <div class="flex-auto ">

            <div>

                <Label>Status</Label>
            </div>

            <div>

                <select class="rounded text-sm w-full" wire:model="status_empleado">

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

                <select class="rounded text-sm w-full" wire:model="localidad_empleado">

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

                <select class="rounded text-sm w-full" wire:model="area_empleado">

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

                <select class="rounded text-sm w-full" wire:model="tipo_empleado">

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

                <select class="rounded text-sm w-full" wire:model="horario_empleado">

                    <option value="" selected>Seleccione el Horario</option>

                    @foreach ($horarios as $horario)


                        <option value="{{ $horario->id}}">{{ $horario->nombre}}</option>

                    @endforeach

                </select>

            </div>

            <div>

                @error('horario_empleado') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

            </div>

        </div>

    </div>

    @if(count($personal))

        <div class="rounded-lg shadow-xl mb-5 p-4 font-thin md:flex items-center justify-between bg-white">

            <p class="text-xl font-extralight">Se encontraron: {{ number_format($personal->total()) }} registros con los filtros seleccionados.</p>

            <button wire:click="descargarExcel" class="text-white flex items-center border rounded-full px-4 py-2 bg-green-500 hover:bg-green-700 mt-2 md:mt-0 w-full md:w-auto justify-center">

                <img wire:loading wire:target="descargarExcel" class="mx-auto h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

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

                    @foreach($personal as $persona)

                        <tr class="text-sm font-medium text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0 text-center">

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

                                {{ $persona->horario->nombre }}

                            </td>

                            <td class="capitalize w-full lg:w-auto p-3 text-gray-800  md:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Observaciones</span>

                                {{ $persona->observaciones }}

                            </td>

                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Registrado</span>

                                @if($persona->creado_por != null)

                                    <span class="font-semibold">Registrado por: {{$persona->creadoPor->name}}</span> <br>

                                @endif

                                {{ $persona->created_at }}

                            </td>

                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Actualizado</span>

                                @if($persona->actualizado_por != null)

                                    <span class="font-semibold">Actualizado por: {{$persona->actualizadoPor->name}}</span> <br>

                                @endif

                                {{ $persona->updated_at }}

                            </td>
                        </tr>

                    @endforeach

                </tbody>

                <tfoot class="border-gray-300 bg-gray-50">

                    <tr>

                        <td colspan="1" class="py-2 px-5">

                            <select class="bg-white rounded-full text-sm" wire:model="pagination">

                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>

                            </select>

                        </td>

                        <td colspan="16" class="py-2 px-5">

                            {{ $personal->links()}}

                        </td>

                    </tr>

                </tfoot>

            </table>

            <div class="h-full w-full rounded-lg bg-gray-200 bg-opacity-75 absolute top-0 left-0" wire:loading >

                <img class="mx-auto h-16" src="{{ asset('storage/img/loading.svg') }}" alt="">

            </div>

        </div>

    @else

        <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

            No hay resultados.

        </div>

    @endif

</div>
