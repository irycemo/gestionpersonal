<?php

namespace App\Observers;

use Carbon\Carbon;
use App\Models\Falta;
use App\Models\Retardo;

class RetardoObserver
{
    /**
     * Handle the Retardo "created" event.
     *
     * @param  \App\Models\Retardo  $retardo
     * @return void
     */
    public function created(Retardo $retardo)
    {
        $retardos = Retardo::where('status',  1)->where('persona_id', $retardo->persona->id)->get();

        if($retardos->count() > 3){

            Falta::create([
                'tipo' => 'Más de 30 min tarde',
                'persona_id' => $retardo->persona->id
            ]);

            foreach($retardos as $retardo){

                $retardo->status = 0;
                $retardo->save();
            }

        }
    }

    /**
     * Handle the Retardo "updated" event.
     *
     * @param  \App\Models\Retardo  $retardo
     * @return void
     */
    public function updated(Retardo $retardo)
    {
        //
    }

    /**
     * Handle the Retardo "deleted" event.
     *
     * @param  \App\Models\Retardo  $retardo
     * @return void
     */
    public function deleted(Retardo $retardo)
    {
        //
    }

    /**
     * Handle the Retardo "restored" event.
     *
     * @param  \App\Models\Retardo  $retardo
     * @return void
     */
    public function restored(Retardo $retardo)
    {
        //
    }

    /**
     * Handle the Retardo "force deleted" event.
     *
     * @param  \App\Models\Retardo  $retardo
     * @return void
     */
    public function forceDeleted(Retardo $retardo)
    {
        //
    }
}
