<?php

namespace App\Models;

use Carbon\Carbon;
use App\Http\Traits\ModelosTrait;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Auditable
{

    use HasRoles;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use ModelosTrait;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $fillable = [
        'name',
        'email',
        'status',
        'ubicacion',
        'password',
        'actualizado_por',
        'creado_por'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function tiempoConsumidoPermisos(){

        $permisos = $this->permisos()->where('tipo', 'personal')
                                                ->where('tiempo_consumido','!=', null)
                                                ->where('status', '!=', null)
                                                ->whereMonth('permisos_persona.created_at', Carbon::now()->month)
                                                ->get();

        $min = 0;

        foreach ($permisos as $permiso) {

            $min = $min + $permiso->pivot->tiempo_consumido;

        }

        return $min;
    }

}
