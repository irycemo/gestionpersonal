<?php

namespace App\Http\Livewire\Admin\Personal;

use Livewire\Component;
use App\Models\Incidencia;
use Livewire\WithPagination;

class Incidencias extends Component
{

    use WithPagination;

    public $persona;
    public $pagination;

    public function render()
    {

        $incidencias = Incidencia::where('persona_id', $this->persona->id)
                                        ->latest()
                                        ->paginate($this->pagination);

        return view('livewire.admin.personal.incidencias', compact('incidencias'));

    }
}
