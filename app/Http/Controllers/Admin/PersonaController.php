<?php

namespace App\Http\Controllers\Admin;

use App\Models\Persona;
use App\Http\Controllers\Controller;

class PersonaController extends Controller
{
    public function __invoke(Persona $persona)
    {
        return view('admin.personal.show', compact('persona'));
    }
}
