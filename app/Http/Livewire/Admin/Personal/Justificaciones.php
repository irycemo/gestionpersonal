<?php

namespace App\Http\Livewire\Admin\Personal;

use App\Models\Justificacion;
use Livewire\Component;

class Justificaciones extends Component
{

    public $persona;
    public $paginator;

    public function render()
    {

        $justificaciones = Justificacion::with('creadoPor', 'actualizadoPor')
                                    ->where('persona_id', $this->persona->id)
                                    ->latest()
                                    ->paginate($this->paginator);

        return view('livewire.admin.personal.justificaciones', compact('justificaciones'));
    }
}
