<div class="">

    <div class="mb-5">

        <h1 class="text-3xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-thin mb-6  bg-white">Formatos</h1>

    </div>

    <div class="p-4 mb-5 bg-white shadow-lg rounded-lg">

        <div class="text-center lg:w-1/3 mx-auto">

            <div class="mb-3">

                <div>

                    <Label>Formato</Label>

                </div>

                <div>

                    <select class="bg-white rounded text-sm w-full" wire:model="formato">
                        <option selected value="">Selecciona una opción</option>
                        <option value="economico">Permiso económico</option>
                        <option value="salida">Pase de salida</option>
                    </select>

                    <div>

                        @error('formato') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

            </div>

            <div class="mb-3">

                <div>

                    <Label>Empleado</Label>

                </div>

                <div>

                    <select class="bg-white rounded text-sm w-full" wire:model.defer="empleado">
                        <option selected value="">Selecciona una opción</option>

                        @foreach ($empleados as $empleado)

                            <option value="{{ $empleado }}">{{ $empleado->nombre }} {{ $empleado->ap_paterno }} {{ $empleado->ap_materno }}</option>

                        @endforeach

                    </select>

                    <div>

                        @error('empleado') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

            </div>

            <div class="flex space-x-3 justify-center w-full">

                @if($this->flags['fecha1'])

                    <div>

                        <div>

                            <Label>Fecha inicial</Label>

                        </div>

                        <div>

                            <input type="date" class="bg-white rounded text-sm" wire:model.defer="fecha1">

                        </div>

                        <div>

                            @error('fecha1') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                @endif

                @if($this->flags['hora1'])

                    <div>

                        <div>

                            <Label>Hora inicial</Label>

                        </div>

                        <div>

                            <input type="time" class="bg-white rounded text-sm" wire:model.defer="hora1">

                        </div>

                        <div>

                            @error('hora1') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                @endif

                @if($this->flags['fecha2'])

                    <div class="">

                        <div>

                            <Label>Fecha final</Label>

                        </div>

                        <div>

                            <input type="date" class="bg-white rounded text-sm" wire:model.defer="fecha2">

                        </div>

                        <div>

                            @error('fecha2') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                @endif

                @if($this->flags['hora2'])

                    <div>

                        <div>

                            <Label>Hora final</Label>

                        </div>

                        <div>

                            <input type="time" class="bg-white rounded text-sm" wire:model.defer="hora2">

                        </div>

                        <div>

                            @error('hora2') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                @endif

                @if($this->flags['dias'])

                    <div>

                        <div>

                            <Label>Dias</Label>

                        </div>

                        <div>

                            <input type="number" class="bg-white rounded text-sm" wire:model.defer="dias">

                        </div>

                        <div>

                            @error('dias') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                        </div>

                    </div>

                @endif

            </div>

            <div class="mt-3">

                <div>

                    <Label>Autoriza</Label>

                </div>

                <div>

                    <select class="bg-white rounded text-sm w-full" wire:model.defer="autoriza">
                        <option selected value="">Selecciona una opción</option>

                        @foreach ($estructura as $item)

                            <option value="{{ $item->nombre }} {{ $item->ap_paterno }} {{ $item->ap_materno }}">{{ $item->nombre }} {{ $item->ap_paterno }} {{ $item->ap_materno }}</option>

                        @endforeach

                    </select>

                    <div>

                        @error('autoriza') <span class="error text-sm text-red-500">{{ $message }}</span> @enderror

                    </div>

                </div>

            </div>

            @if($this->flags['observaciones'])

                <div class="mt-3">

                    <div>

                        <Label>Observaciones</Label>

                    </div>

                    <div>

                        <textarea class="bg-white rounded text-sm mb-3 w-full" wire:model.defer="observaciones" rows="5"></textarea>

                    </div>

                </div>

            @endif

            <button
                class="bg-blue-400 mt-3 hover:shadow-lg text-white text-xs md:text-sm px-3 py-2 rounded-full hover:bg-blue-700 flex focus:outline-none w-full justify-center items-center"
                wire:click="crear"
                wire:loading.attr="disabled"
                wire:target="crear"
                >
                <img wire:loading wire:target="crear" class="h-4 mr-1" src="{{ asset('storage/img/loading3.svg') }}" alt="Loading">

                <p>Crear formato</p>
            </button>

        </div>

    </div>

</div>
