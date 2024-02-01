<div>

    @if($permisos->count())

        <div class="relative overflow-x-auto rounded-lg shadow-xl">

            <table class="rounded-lg w-full">

                <thead class="border-b border-gray-300 bg-gray-50">

                    <tr class="text-xs text-gray-500 uppercase text-left traling-wider">

                        <th class=" px-3 hidden lg:table-cell py-2">

                            Descripcíon

                        </th>

                        <th class=" px-3 hidden lg:table-cell py-2">

                            Límite

                        </th>

                        <th class=" px-3 hidden lg:table-cell py-2">

                            Fecha Inicial

                        </th>

                        <th class=" px-3 hidden lg:table-cell py-2">

                            Fecha Final

                        </th>

                        <th class=" px-3 hidden lg:table-cell py-2">

                            Tiempo Consumido

                        </th>

                        <th class=" px-3 hidden lg:table-cell py-2">

                            Registro

                        </th>

                        <th class=" px-3 hidden lg:table-cell py-2">

                            Acciones

                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200 flex-1 sm:flex-none ">

                    @foreach($permisos as $permiso)

                        <tr class="text-sm text-gray-500 bg-white flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                            <td class="p-2 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Descripción</span>

                                {{ $permiso->permiso->descripcion }}

                            </td>

                            <td class="p-2 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Límite</span>

                                {{ $permiso->permiso->limite }}

                            </td>

                            <td class="p-2 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Fecha Inicial</span>

                                @if ($permiso->fecha_inicio)

                                    {{ $permiso->fecha_inicio }}

                                @else

                                    N/A

                                @endif

                            </td>

                            <td class="p-2 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Fehca Final</span>

                                @if ($permiso->fecha_final)

                                    {{ $permiso->fecha_final }}

                                @else

                                    N/A

                                @endif

                            </td>

                            <td class="p-2 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tiempo Consumido</span>

                                @if ($permiso->tiempo_consumido)

                                    {{ $permiso->tiempo_consumido }} min. @if($permiso->status)<span class="bg-slate-400 text-white rounded-full px-2 py-1 text-xs">Contabilizado</span>@endif

                                @else

                                    N/A

                                @endif

                            </td>

                            <td class="p-2 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Tiempo Consumido</span>

                                @if($permiso->creado_por != null)

                                    <span class="font-semibold">Registrado por: {{$permiso->creadoPor->name}}</span> <br>

                                @endif

                                {{ $permiso->created_at }}

                            </td>

                            <td class="p-2 w-full lg:w-auto text-gray-800 text-center lg:text-left lg:border-0 border border-b block lg:table-cell relative lg:static">

                                <span class="lg:hidden absolute top-0 left-0 bg-blue-300 px-2 py-1 text-xs text-white font-bold uppercase rounded-br-xl">Acciones</span>

                                @can('Borrar permiso')

                                    <button
                                        wire:click="abrirModalEliminar({{ $permiso->id }})"
                                        wire:loading.attr="disabled"
                                        wire:target="abrirModalEliminar({{ $permiso->id }})"
                                        class="bg-red-400 hover:shadow-lg text-white text-xs md:text-sm px-3 py-1 items-center rounded-full hover:bg-red-700 flex focus:outline-none"
                                    >

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-3">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>

                                        <p>Eliminar</p>

                                    </button>

                                @endcan

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

                        <td colspan="20" class="py-2 px-5">

                            {{ $permisos->links()}}

                        </td>

                    </tr>

                </tfoot>

            </table>

        </div>

    @else

        <div class="border-b border-gray-300 bg-white text-gray-500 text-center p-5 rounded-full text-lg">

            No hay resultados.

        </div>

    @endif

    <x-jet-confirmation-modal wire:model="modal">

        <x-slot name="title">
            Eliminar permiso
        </x-slot>

        <x-slot name="content">
            ¿Esta seguro que desea eliminar al permiso? No sera posible recuperar la información.
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
                wire:click="eliminar"
                wire:loading.attr="disabled"
                wire:target="eliminar"
            >
                Borrar
            </x-jet-danger-button>

        </x-slot>

    </x-jet-confirmation-modal>

</div>
