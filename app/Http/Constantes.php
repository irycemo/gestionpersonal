<?php

namespace App\Http;

class Constantes{

    /* Permisos */
    const AREAS = [
        'Roles',
        'Permisos',
        'Usuarios',
        'Horarios',
        'Inasistencias',
        'Permisos Personal',
        'Incapacidades',
        'Personal',
        'Reportes',
        'Checador'
    ];

    /* Usuarios */
    const AREAS_ADSCRIPCION = [
        'Dirección de Catastro',
        'Dirección General del Instituto Registral y Catastral',
        'Dirección del Registro Público de la Propiedad',
        'Subdirección de Planeación Estratégica',
        'Subdirección Jurídica',
        'Subdirección de Tecnologías de la Información',
        'Delegación Administrativa'
    ];

    const LOCALIDADES = [
        'Catasro',
        'RPP',
        'Regional 1',
        'Regional 2',
        'Regional 3',
        'Regional 4',
        'Regional 5',
        'Regional 6',
        'Regional 7'
    ];

    const TIPO = [
        'Estructura',
        'Base',
        'Sindicalizado',
        'Contrato',
        'Eventual'
    ];

}
