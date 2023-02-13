<?php

namespace App\Http\Livewire\Admin;

use App\Models\Audit;
use Livewire\Component;
use App\Http\Traits\ComponentesTrait;
use Livewire\WithPagination;

class Auditoria extends Component
{

    use ComponentesTrait;
    use WithPagination;

    public $evento;
    public $modelo;
    public $selecetedAudit;
    public $modelos = [
        'App\Models\Incapacidad',
        'App\Models\Justificacion',
        'App\Models\Permisos',
        'App\Models\User',
        'App\Models\PermisoPersona',
    ];

    public function ver($audit){

        $this->selecetedAudit = $audit;

        $this->modal = true;

    }

    public function render()
    {

        $audits = Audit::with('user')
                            ->when(isset($this->evento) && $this->evento != "", function($q){
                                return $q->where('event', $this->evento);

                            })
                            ->when(isset($this->modelo) && $this->modelo != "", function($q){
                                return $q->where('auditable_type', $this->modelo);

                            })
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);


        return view('livewire.admin.auditoria', compact('audits'))->extends('layouts.admin');
    }
}
