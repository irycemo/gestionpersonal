<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Solicitud</title>
</head>
<style>

    /* @page {
        margin: 0cm 0cm;
    } */

    header{
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 100px;
        text-align: center;
    }

    header img{
        height: 100px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }


    body{
        margin-top: 150px;
        counter-reset: page;
        height: 100%;
        background-image: url("storage/img/escudo_fondo.png");
        background-size: cover;
        font-size: 12px;
    }

    footer{
        position: fixed;
        bottom: 0cm;
        left: 0cm;
        right: 0cm;
        background: #5E1D45;
        color: white;
        font-size: 12px;
        text-align: right;
        padding-right: 10px;
    }

    .fot{
        display: flex;
        padding: 2px;
        text-align: center;
    }

    .fot p{
        display: inline-block;
        width: 33%;
        margin: 0;
    }

    .titulo{
        font-weight: bold;
        text-align: center;
        margin-bottom: 50px;
    }

    p{
        margin: 0;
        margin-bottom: 15px;
    }

    .observaciones{
        text-align: justify;
    }

    .firmas{
        margin-top: 80px;
    }

    table{
        width: 100%;
        margin-left: auto;
        margin-right: auto;
    }

    th{
        text-align: center;
        padding-right: 40px;
        align-items: flex-start;
        width: 33.3%;
    }

    th p:first-child{
        border-top: 1px solid;
    }

</style>
<body>

    <header>


            <img src="{{ public_path('storage/img/encabezado.png') }}" alt="encabezado">


    </header>



    <footer>

        <div class="fot">
            <p>www.irycem.michoacan.gob.mx</p>
        </div>

    </footer>

    <main>

        <div class="container">

            <p class="titulo">PASE DE SALIDA DEL CENTRO DE TRABAJO</p>

            <p><strong>Nombre del empleado: </strong>{{ $empleado }}</p>
            <p><strong>Adscrito al departamento: </strong>{{ $departamento }}</p>
            <p><strong>Salir del edificio a realizar una actividad personal</strong></p>
            <div>
                <p><strong>Hora de salida: </strong>{{ $hora1 }}, <strong>Hora de llegada: </strong>{{ $hora2 }}</p>
            </div>
            {{-- <p class="observaciones"><strong>Observaciones: </strong>{{ $observaciones }}</p> --}}
            <p><strong>Elaboró: </strong>{{ auth()->user()->name }}, el {{ now()->format('d-m-Y H:i:s') }}</p>

            <div class="firmas">

                <table>

                    <thead>

                        <tr>
                            <th>
                                <p>Empleado</p>
                                <p style="font-weight: 400; vertical-align: top">{{ $empleado }}</p>
                            </th>
                            <th>
                                <p>Autoriza</p>
                                <p style="font-weight: 400; vertical-align: top">{{ $autoriza }}</p>
                            </th>
                        </tr>

                    </thead>

                </table>

            </div>

            <p style="font-size: 10px;">Confirmación de trabajo social (IMSS, ISSSTE, STASPE, SITASPE, Dir. de Pensiones, Dir. de Recursos Humanos)</p>

        </div>

    </main>

</body>
</html>
