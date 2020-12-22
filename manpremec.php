<?php
    require __DIR__. '/vendor/autoload.php';
    use Spipu\Html2Pdf\Html2Pdf;
    
    date_default_timezone_set("America/Bogota");
    $name='reporte_'.date('m-d-Y h:i:sa').'.pdf';
  
    if(isset($_POST['crearpdf'])){
      ob_start();
      require_once 'remanpremec.php';
      $html = ob_get_clean();
      
  
      $html2pdf = new Html2pdf('P','A4','es','true','UTF-8');
      $html2pdf->writeHTML($html);
      $ste=$html2pdf->output($name, 'D');    
  }

  if(isset($_POST['subir'])){
    include_once 'google-api-php-client-v2.7.1/vendor/autoload.php';
      date_default_timezone_set("America/Bogota");
      //$name='reporte_'.date('m-d-Y h:i:sa').'.pdf';
  
      //configurar variable de entorno
      putenv('GOOGLE_APPLICATION_CREDENTIALS=credenciales.json');
  
      $client = new Google_Client();
      $client->useApplicationDefaultCredentials();
      $client->setScopes(['https://www.googleapis.com/auth/drive.file']);
    
    $ids = [];
  
    $ids[1] = "1ixcnxJQm2wXuXoriq2RLlUFu1aSTykUb";
    $ids[2] = "1uzqOCQ6EahpWHyrvpu0CpaKj7VMVNo5m";
    $ids[3] = "1CHL4XL--ccxPVFapq3b84jWOhOaXket7";
    $ids[4] = "1FZWRauadr54RwGLHEFU7NL2NGUYs-aKZ";
    $ids[5] = "1Kd94xBIk6O8Mk4luFWEWRZFXcrprKxP-";
  
    try{
          
      //instanciamos el servicio
      $service = new Google_Service_Drive($client);
  
     
      $file_path = $_FILES["subirArchivo"]["name"];
  
      //instacia de archivo
      $file = new Google_Service_Drive_DriveFile();
      $file->setName($name);
  
      //obtenemos el mime type
      $finfo = finfo_open(FILEINFO_MIME_TYPE); 
      $mime_type=finfo_file($finfo, $file_path);
  
      //id de la carpeta donde hemos dado el permiso a la cuenta de servicio 
  
      $file->setParents(array($ids[$_POST['inputCategoria']]));
      $file->setDescription('Archivo subido desde php');
      $file->setMimeType($mime_type);
  
      $result = $service->files->create(
        $file,
        array(
          'data' => file_get_contents($file_path),
          'mimeType' => $mime_type,
          'uploadType' => 'media',
        )
      );
  
      //echo '<a href="https://drive.google.com/open?id='.$result->id.'" target="_blank">'.$result->name.'</a>';
  
      echo("<script>alert('Archivo subido con exito!')</script>");
     // echo("<script>window.location = 'index.php';</script>");
  
      }catch(Google_Service_Exception $gs){
      
        $m=json_decode($gs->getMessage());
        echo $m->error->message;
  
      }catch(Exception $e){
          echo $e->getMessage();
        
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento preventivo mecanico</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Mantenimiento preventivo mecanico - Waterblasting</h1>
        <form action="" method="POST" class="mt-5 mb-5">
            <fieldset>
                <legend class="text-center">Encabezado</legend>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="txtNum">Numero de documento</label>
                        <input type="number" id="txtNum" class="form-control" name="txtNum" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtCla">Clasificacion</label>
                        <input type="text" id="txtCla" class="form-control" name="txtCla"required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtDoc">Nivel de documento</label>
                        <input type="txt" id="txtDoc" class="form-control" name="txtDoc"required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="txtRev">Numero de revision</label>
                        <input type="number" id="txtRev" class="form-control" name="txtRev"required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="txtFechaE">Fecha de emision</label>
                        <input type="date" id="txtFechaE" class="form-control" name="txtFechaE"required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="txtPrep">Preparado por </label>
                        <input type="text" id="txtPrep" class="form-control" name="txtPrep" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="txtAprob">Aprobacion</label>
                        <input type="txt" id="txtAprob" class="form-control" name="txtAprob" required>
                    </div>
                </div> 
            </fieldset>

            <fieldset>
                <legend class="text-center">Datos principales</legend>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="txtFecha">Fecha</label>
                        <input type="date" id="txtFecha" class="form-control" name="txtFecha" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtMaq">Maquina</label>
                        <input type="text" id="txtMaq" class="form-control" name="txtMaq" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtUbi">Ubicación</label>
                        <input type="text" id="txtUbi" class="form-control" name="txtUbi" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="txtPeriodo">Periodo</label>
                        <input type="text" id="txtPeriodo" class="form-control" name="txtPeriodo" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtCod">Codigo</label>
                        <input type="text" id="txtCod" class="form-control" name="txtCod" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="txtWO">WO</label>
                        <input type="text" id="txtWO" class="form-control" name="txtWO" required>
                    </div>
                </div>
            </fieldset>
             
            <fieldset>
                <legend class="text-center">Tareas</legend>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <p class="text-center">Cambio de aceite</p>
                        <div class="form-check">
                            
                          <input class="form-check-input" type="radio" name="checkAceite" id="checkAceite" value="Si">
                          <label class="form-check-label" for="checkAceite">
                            Si
                          </label>
                        </div>

                        <div class="form-check">
                            
                          <input class="form-check-input" type="radio" name="checkAceite" id="checkAceite" value="No">
                          <label class="form-check-label" for="checkAceite">
                            No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsBomb">Observacion</label>
                        <textarea name="txtObsBomb" id="txtObsBomb" cols="30" class="form-control" value="No registra"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p class="text-center">Inspeccion manifold de succion</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkInsSuc" id="checkInsSuc" value="Si" >
                          <label class="form-check-label" for="checkInsSuc">
                            Si
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkInsSuc" id="checkInsSuc" value="No">
                          <label class="form-check-label" for="checkInsSuc">
                            No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsSuc">Observacion</label>
                        <textarea name="txtObsSuc" id="txtObsSuc" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Inspeccion manifold de descarga</p> 
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkInsDes" id="checkInsDes" value="Si">
                          <label class="form-check-label" for="checkInsDes">
                              Si
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkInsDes" id="checkInsDes" value="No">
                          <label class="form-check-label" for="checkInsDes">
                              No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsDes">Observacion</label>
                        <textarea name="txtObsDes" id="txtObsDes" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Inspeccion y/o cambio de pakings</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkInsPak" id="checkInsPak" value="Si">
                          <label class="form-check-label" for="checkInsPak">
                             Si
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkInsPak" id="checkInsPak" value="No">
                          <label class="form-check-label" for="checkInsPak">
                             No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsPak">Observacion</label>
                        <textarea name="txtObsPak" id="txtObsPak" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Inspeccion pistones</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkPis" id="checkPis" value="Si">
                          <label class="form-check-label" for="checkPis">
                             Si
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkPis" id="checkPis" value="No">
                          <label class="form-check-label" for="checkPis">
                             No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsPis">Observacion</label>
                        <textarea name="txtObsPis" id="txtObsPis" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Inspeccion resortes de empuje de presion</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkPresion" id="checkPresion" value="Si">
                          <label class="form-check-label" for="checkPresion">
                            Si
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkPresion" id="checkPresion" value="No">
                          <label class="form-check-label" for="checkPresion">
                            No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsPresion">Observacion</label>
                        <textarea name="txtObsPresion" id="txtObsPresion" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <p>Inspeccion tuercas de seguridad </p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkTuercas" id="checkTuercas" value="Si">
                          <label class="form-check-label" for="checkTuercas">
                              Si
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkTuercas" id="checkTuercas" value="No">
                          <label class="form-check-label" for="checkTuercas">
                              No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsTuercas">Observacion</label>
                        <textarea name="txtObsTuercas" id="txtObsTuercas" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <p>Inspeccion de rings de sellado</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkRings" id="checkRings" value="Si">
                          <label class="form-check-label" for="checkRings">
                              Si
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkRings" id="checkRings" value="No">
                          <label class="form-check-label" for="checkRings">
                              No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsRings">Observacion</label>
                        <textarea name="txtObsRings" id="txtObsRings" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Inspeccion de acoples y mangueras</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkAM" id="checkAM" value="Si">
                          <label class="form-check-label" for="checkAM">
                             Si
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkAM" id="checkAM" value="No">
                          <label class="form-check-label" for="checkAM">
                             No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsAM">Observacion</label>
                        <textarea name="txtObsAM" id="txtObsAM" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Inspeccion y/o calibracion de indicadores de presion</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkCalPre" id="checkCalPre" value="Si">
                          <label class="form-check-label" for="checkCalPre">
                            Si
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkCalPre" id="checkCalPre" value="No">
                          <label class="form-check-label" for="checkCalPre">
                            No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsCalPre">Observacion</label>
                        <textarea name="txtObsCalPre" id="txtObsCalPre" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Inspeccion de bandas bomba motor</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkInsBan" id="checkInsBan" value="Si">
                          <label class="form-check-label" for="checkInsBan">
                             Si
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkInsBan" id="checkInsBan" value="No">
                          <label class="form-check-label" for="checkInsBan">
                             No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsInsBan">Observacion</label>
                        <textarea name="txtObsInsBan" id="txtObsInsBan" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Inspeccion poleas bomba motor</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkPoBomba" id="checkPoBomba" value="Si">
                          <label class="form-check-label" for="checkPoBomba">
                            Si
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkPoBomba" id="checkPoBomba" value="No">
                          <label class="form-check-label" for="checkPoBomba">
                            No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsPoBomba">Observacion</label>
                        <textarea name="txtObsPoBomba" id="txtObsPoBomba" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Inspeccion de prisioneros y chavetas</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkPriCha" id="checkPriCha" value="Si">
                          <label class="form-check-label" for="checkPriCha">
                             Si
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkPriCha" id="checkPriCha" value="No">
                          <label class="form-check-label" for="checkPriCha">
                             No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsPriCha">Observacion</label>
                        <textarea name="txtObsPriCha" id="txtObsPriCha" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Inspeccion y reajuste de guardas</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkInsGua" id="checkInsGua" value="Si">
                          <label class="form-check-label" for="checkInsGua">
                             Si
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkInsGua" id="checkInsGua" value="No">
                          <label class="form-check-label" for="checkInsGua">
                             No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsInsGua">Observacion</label>
                        <textarea name="txtObsInsGua" id="txtObsInsGua" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Inspeccion de pistola de lavado</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkPisLa" id="checkPisLa" value="Si">
                          <label class="form-check-label" for="checkPisLa">
                             Si
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkPisLa" id="checkPisLa" value="No">
                          <label class="form-check-label" for="checkPisLa">
                             No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsPisLa">Observacion</label>
                        <textarea name="txtObsPisLa" id="txtObsPisLa" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Inspeccion de recubrimiento de manguera</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkRecMan" id="checkRecMan" value="Si">
                          <label class="form-check-label" for="checkRecMan">
                             Si
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkRecMan" id="checkRecMan" value="No">
                          <label class="form-check-label" for="checkRecMan">
                             No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsRecMan">Observacion</label>
                        <textarea name="txtObsRecMan" id="txtObsRecMan" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Reajuste general de pernos</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkPernos" id="checkPernos" value="Si">
                          <label class="form-check-label" for="checkPernos">
                             Si
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkPernos" id="checkPernos" value="No">
                          <label class="form-check-label" for="checkPernos">
                             No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsPernos">Observacion</label>
                        <textarea name="txtObsPernos" id="txtObsPernos" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Inspeccion control electrico</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkCtrlElec" id="checkCtrlElec" value="Si">
                          <label class="form-check-label" for="checkCtrlElec">
                             Si
                          </label>
                        </div>

                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkCtrlElec" id="checkCtrlElec" value="No">
                          <label class="form-check-label" for="checkCtrlElec">
                             No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsCtrlElec">Observacion</label>
                        <textarea name="txtObsCtrlElec" id="txtObsCtrlElec" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Revision motor electrico</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkMotorElec" id="checkMotorElec" value="Si">
                          <label class="form-check-label" for="checkMotorElec">
                            Si
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkMotorElec" id="checkMotorElec" value="No">
                          <label class="form-check-label" for="checkMotorElec">
                            No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsMotorElec">Observacion</label>
                        <textarea name="txtObsMotorElec" id="txtObsMotorElec" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Inspeccion y/o cambio de rodamientos motor</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkRodMotor" id="checkRodMotor" value="Si">
                          <label class="form-check-label" for="checkRodMotor">
                             Si
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkRodMotor" id="checkRodMotor" value="No">
                          <label class="form-check-label" for="checkRodMotor">
                             No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsRodMotor">Observacion</label>
                        <textarea name="txtObsRodMotor" id="txtObsRodMotor" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Revision ventilador de enfriamiento</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkVenEnf" id="checkVenEnf" value="Si">
                          <label class="form-check-label" for="checkVenEnf">
                            Si
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkVenEnf" id="checkVenEnf" value="No">
                          <label class="form-check-label" for="checkVenEnf">
                            No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsVenEnf">Observacion</label>
                        <textarea name="txtObsVenEnf" id="txtObsVenEnf" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Lubricacion general de equipo </p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkEquipo" id="checkEquipo" value="Si">
                          <label class="form-check-label" for="checkEquipo">
                            Si
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkEquipo" id="checkEquipo" value="No">
                          <label class="form-check-label" for="checkEquipo">
                            No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsEquipo">Observacion</label>
                        <textarea name="txtObsEquipo" id="txtObsEquipo" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Pruebas de parametros de presion del equipo</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkPreEqui" id="checkPreEqui" value="Si">
                          <label class="form-check-label" for="checkPreEqui">
                             Si
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkPreEqui" id="checkPreEqui" value="No">
                          <label class="form-check-label" for="checkPreEqui">
                             No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsPreEqui">Observacion</label>
                        <textarea name="txtObsPreEqui" id="txtObsPreEqui" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                    <p>Pruebas de funcionamiento de lavado</p>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkLav" id="checkLav" value="Si">
                          <label class="form-check-label" for="checkLav">
                             Si
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="checkLav" id="checkLav" value="No">
                          <label class="form-check-label" for="checkLav">
                             No
                          </label>
                        </div>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="txtObsLav">Observacion</label>
                        <textarea name="txtObsLav" id="txtObsLav" cols="30" class="form-control"></textarea>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend class="text-center">Firmas</legend>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="txtTecMec">Ingrese nombre del tecnico mecanico</label>
                        <input type="text" id="txtTecMec" class="form-control" name="txtTecMec" placeholder="Nombre del Tecnico">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txtSuper">Supervisado por</label>
                        <input type="text" id="txtSuper" class="form-control" name="txtSuper" placeholder="Nombre del Supervisado">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend class="text-center">Nota</legend>
                <p>Este registro es propiedad intelectual de Weatherford, sin importar si el contenido es patentable o no patentable, implica la propiedad y confidencialidad de la información por parte de Weatherford; quien lo recibe esta de acuerdo en que es prestado en términos confidenciales con el entendimiento de que ni este ni la información contenida en el mismo puede ser reproducida usada o difundida, completamente o en parte, para ningún propósito excepto para el propósito limitado para que se presta. Este documento debe ser devuelto cuando Weatherford lo requiera.</p>
            </fieldset>
            <div class="alert alert-warning mt-3" role="alert">
                El mantenimiento dura 3 horas
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                  <input type="submit" class="btn btn-danger mt-3" name="crearpdf" value="Crear PDF">
              </div>
              
            </div>

            
            
        </form>

        <div class="container"> 
            <h1 class="text-center">Subir el archivo a Drive</h1>
            <form method="POST" action="" enctype="multipart/form-data">
            
                
                <div class="form-group">
                <label for="inputCategoria">Carpeta a guardar</label>
                <select name="inputCategoria" id="inputCategoria" class="form-control" required>
                  <option></option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <br>
                <span>Cargar archivo para subirlo a Drive</span>
              <br>
                <input type="file" name="subirArchivo" >
                <input type="submit" name="subir" class="btn btn-success" value="Subir"></button>
            </form>
        </div>
    </div>

    <footer>
        <p class="text-center">Desarrollado por Diego Alejandro Perdomo Montealegre</p>
    </footer>


    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>    
</body>
</html>