<?php
/*
 * Copyright 2013 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

include_once 'google-api-php-client-v2.7.1/vendor/autoload.php';



//configurar variable de entorno
putenv('GOOGLE_APPLICATION_CREDENTIALS=credenciales.json');

$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->setScopes(['https://www.googleapis.com/auth/drive.file']);
try{
//instanciamos el servicio
$service = new Google_Service_Drive($client);

//ruta al archivo
$name='reporte_'.date('m-d-Y h:i:s A').'.pdf';
$file_path = $name;

//instacia de archivo
$file = new Google_Service_Drive_DriveFile();
$file->setName($name);

//obtenemos el mime type
$finfo = finfo_open(FILEINFO_MIME_TYPE); 
$mime_type=finfo_file($finfo, $file_path);

//id de la carpeta donde hemos dado el permiso a la cuenta de servicio 
$file->setParents(array("1lKKgVI-BOO0W_XlqgAvHBMbspO4f8j5g"));
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
echo("<script>window.location = 'index.php';</script>");

}catch(Google_Service_Exception $gs){
 
  $m=json_decode($gs->getMessage());
  echo $m->error->message;

}catch(Exception $e){
    echo $e->getMessage();
  
}

?>