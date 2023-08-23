<?php

namespace App\Http\Livewire\Admin\Personal;

use App\Models\Falta;
use Livewire\Component;
use Livewire\WithPagination;

class Faltas extends Component
{

    use WithPagination;

    public $persona;
    public $pagination;

    public function render()
    {

        $faltas = Falta::with('justificacion')
                                    ->where('persona_id', $this->persona->id)
                                    ->latest()
                                    ->paginate($this->pagination);

        return view('livewire.admin.personal.faltas', compact('faltas'));
    }
}
