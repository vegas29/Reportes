<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <style>

        .centrar-texto{
            text-align:center;
            margin-bottom:20px;
        }

        table {
            border:1px solid #333;
            margin-bottom: 20px;
        }

        .tareas td{
            width:33%;
        }

        .centrar{
            margin: 0 auto;
        }

        
       
    </style>
<?php if(isset($_POST['txtNum'])): ?>
    <h1 class="centrar-texto">Mantenimiento Preventivo Mecanico</h1>
        <table class="table">
        
        <tbody>
            <tr>
                <th scope="row">Num de documento</th>
                <th>Clasificacion</th>
                <th>Nivel de Documento</th>
                <th>Num de Revision</th>
                <th>Fecha Emisión</th>
                <th>Preparado por</th>
                <th>Aprobación</th>
            </tr>
            <tr>
                <th scope="row"><?=$_POST['txtNum']?></th>
                <td><?=$_POST['txtCla']?></td>
                <td><?=$_POST['txtDoc']?></td>
                <td><?=$_POST['txtRev']?></td>
                <td><?=$_POST['txtFechaE']?></td>
                <td><?=$_POST['txtPrep']?></td>
                <td><?=$_POST['txtAprob']?></td>
            </tr>


            <tr>
                <th>Fecha</th>
                <th colspan="2">Maquina</th>
                <th>Ubicacion</th>

                <th>Periodo</th>
                <th>Codigo</th>
                <th>WO</th>
            </tr>

            <tr>
                <td><?=$_POST['txtFecha']?></td>
                <td colspan="2"><?=$_POST['txtMaq']?></td>
                <td><?=$_POST['txtUbi']?></td>

                <td><?=$_POST['txtPeriodo']?></td>
                <td><?=$_POST['txtCod']?></td>
                <td><?=$_POST['txtWO']?></td>
            </tr>

            

            
        </tbody>
        </table>

        <br>

        <table>
            <tbody>
                
            <tr>
                <th>Titulo procedimiento</th>
                <th>Respuesta</th>
                <th>Observacion</th>
            </tr>

            <tr>
                <td>Cambio de aceite</td>
                <td><?=$_POST['checkAceite']?></td>
                <td><?=$_POST['txtObsBomb']?></td>
            </tr>
            <tr>
                <td>Inspeccion manifold de succion</td>
                <td><?=$_POST['checkInsSuc']?></td>
                <td><?=$_POST['txtObsSuc']?></td>
            </tr>
            <tr>
                <td>Inspeccion manifold de descarga</td>
                <td><?=$_POST['checkInsDes']?></td>
                <td><?=$_POST['txtObsDes']?></td>
            </tr>
            <tr>
                <td>Inspeccion y/o cambio de pakings</td>
                <td><?=$_POST['checkInsPak']?></td>
                <td><?=$_POST['txtObsPak']?></td>
            </tr>
            <tr>
                <td>Inspeccion de pistones</td>
                <td><?=$_POST['checkPis']?></td>
                <td><?=$_POST['txtObsPis']?></td>
            </tr>
            <tr>
                <td>Inspeccion resortes de empuje de presion</td>
                <td><?=$_POST['checkPresion']?></td>
                <td><?=$_POST['txtObsPresion']?></td>
            </tr>
            <tr>
                <td>Inspeccion tuercas de seguridad</td>
                <td><?=$_POST['checkTuercas']?></td>
                <td><?=$_POST['txtObsTuercas']?></td>
            </tr>
            <tr>
                <td>Inspeccion de rings de sellado</td>
                <td><?=$_POST['checkRings']?></td>
                <td><?=$_POST['txtObsRings']?></td>
            </tr>
            <tr>
                <td>Inspeccion de acoples y mangueras</td>
                <td><?=$_POST['checkAM']?></td>
                <td><?=$_POST['txtObsAM']?></td>
            </tr>
            <tr>
                <td>Inspeccion y/o calibracion de indicadores de presion</td>
                <td><?=$_POST['checkInsSuc']?></td>
                <td><?=$_POST['txtObsSuc']?></td>
            </tr>
            <tr>
                <td>Inspeccion de bandas bomba motor</td>
                <td><?=$_POST['checkInsBan']?></td>
                <td><?=$_POST['txtObsInsBan']?></td>
            </tr>
            <tr>
                <td>Inspeccion poleas bomba motor</td>
                <td><?=$_POST['checkPoBomba']?></td>
                <td><?=$_POST['txtObsPoBomba']?></td>
            </tr>
            <tr>
                <td>Inspeccion de prisioneros y chavetas</td>
                <td><?=$_POST['checkPriCha']?></td>
                <td><?=$_POST['txtObsPriCha']?></td>
            </tr>
            <tr>
                <td>Inspeccion y reajuste de guardas</td>
                <td><?=$_POST['checkInsGua']?></td>
                <td><?=$_POST['txtObsInsGua']?></td>
            </tr>
            <tr>
                <td>Inspeccion de pistola de lavado</td>
                <td><?=$_POST['checkPisLa']?></td>
                <td><?=$_POST['txtObsPisLa']?></td>
            </tr>
            <tr>
                <td>Inspeccion de recubrimiento de manguera</td>
                <td><?=$_POST['checkRecMan']?></td>
                <td><?=$_POST['txtObsRecMan']?></td>
            </tr>
            <tr>
                <td>Reajuste general de pernos</td>
                <td><?=$_POST['checkPernos']?></td>
                <td><?=$_POST['txtObsPernos']?></td>
            </tr>
            <tr>
                <td>Inspeccion control electrico</td>
                <td><?=$_POST['checkCtrlElec']?></td>
                <td><?=$_POST['txtObsCtrlElec']?></td>
            </tr>
            <tr>
                <td>Revision motor electrico</td>
                <td><?=$_POST['checkMotorElec']?></td>
                <td><?=$_POST['txtObsMotorElec']?></td>
            </tr>
            <tr>
                <td>Inspeccion y/o cambio de rodamientos motor</td>
                <td><?=$_POST['checkRodMotor']?></td>
                <td><?=$_POST['txtObsRodMotor']?></td>
            </tr>
            <tr>
                <td>Revision ventilador de enfriamiento</td>
                <td><?=$_POST['checkVenEnf']?></td>
                <td><?=$_POST['txtObsVenEnf']?></td>
            </tr>
            <tr>
                <td>Lubricacion general de equipo</td>
                <td><?=$_POST['checkEquipo']?></td>
                <td><?=$_POST['txtObsEquipo']?></td>
            </tr>
            <tr>
                <td>Pruebas de parametros de presion del equipo</td>
                <td><?=$_POST['checkPreEqui']?></td>
                <td><?=$_POST['txtObsPreEqui']?></td>
            </tr>
            <tr>
                <td>Pruebas de funcionamiento de lavado</td>
                <td><?=$_POST['checkLav']?></td>
                <td><?=$_POST['txtObsLav']?></td>
            </tr>
            
            </tbody>
        </table>

        <div class="centrar">
         <p><?=$_POST['txtTecMec']?></p>
         <p><?=$_POST['txtSuper']?></p>
        </div>
<?php endif; ?>

<!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
-->
</body>
</html>