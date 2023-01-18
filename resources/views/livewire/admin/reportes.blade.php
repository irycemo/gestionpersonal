<div>

    <h1 class="text-3xl tracking-widest py-3 px-6 text-gray-600 rounded-xl border-b-2 border-gray-500 font-thin mb-6  bg-white">Reportes</h1>

    <div class="p-4 mb-5 bg-white shadow-xl rounded-lg">

        <div>

            <Label>Área</Label>

        </div>

        <div>

            <select class="bg-white rounded text-sm mb-3" wire:model="area">
                <option selected value="">Selecciona una área</option>
                <option value="permisos">Permisos</option>
                <option value="incapacidades">Incapacidades</option>
                <option value="personal">Personal</option>
                <option value="justificaciones">Justificaciones</option>
                <option value="faltas">Faltas</option>
                <option value="retardos">Retardos</option>


            </select>

        </div>

    </div>

    @if ($verPermisos)

            @livewire('admin.reporte-permiso', ['fecha1' => $this->fecha1, 'fecha2' => $this->fecha2])

    @endif

    @if ($verIncapacidades)

        @livewire('admin.reporte-incapacidad', ['fecha1' => $this->fecha1, 'fecha2' => $this->fecha2])

    @endif

    @if ($verJustificaciones)

        @livewire('admin.reporte-justificacion', ['fecha1' => $this->fecha1, 'fecha2' => $this->fecha2])

    @endif

    @if ($verPersonal)

        @livewire('admin.reporte-personal', ['fecha1' => $this->fecha1, 'fecha2' => $this->fecha2])

    @endif

    @if ($verFaltas)

        @livewire('admin.reporte-falta', ['fecha1' => $this->fecha1, 'fecha2' => $this->fecha2])

    @endif

    @if ($verRetardos)

        @livewire('admin.reporte-retardo', ['fecha1' => $this->fecha1, 'fecha2' => $this->fecha2])

    @endif

</div>
