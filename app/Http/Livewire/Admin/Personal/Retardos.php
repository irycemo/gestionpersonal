<?php

namespace App\Http\Livewire\Admin\Personal;

use App\Models\Retardo;
use Livewire\Component;

class Retardos extends Component
{

    public $persona;
    public $paginator;

    public function render()
    {

        $retardos = Retardo::with('justificacion')
                                    ->where('persona_id', $this->persona->id)
                                    ->latest()
                                    ->paginate($this->paginator);

        return view('livewire.admin.personal.retardos', compact('retardos'));
    }
}
