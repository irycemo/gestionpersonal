<?php

namespace App\Http\Livewire\Admin\Personal;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Justificacion;

class Justificaciones extends Component
{

    use WithPagination;

    public $persona;
    public $pagination;

    public function render()
    {

        $justificaciones = Justificacion::with('creadoPor', 'actualizadoPor', 'retardo', 'falta')
                                    ->where('persona_id', $this->persona->id)
                                    ->latest()
                                    ->paginate($this->pagination);

        return view('livewire.admin.personal.justificaciones', compact('justificaciones'));
    }
}
