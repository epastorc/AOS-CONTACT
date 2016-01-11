<?php
require 'Slim/Slim.php';


header("Access-Control-Allow-Origin: *");

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app->contentType('application/json; charset=utf-8');

$http_codes = array(
    100 => 'Continue',
    101 => 'Switching Protocols',
    102 => 'Processing',
    200 => 'OK',
    201 => 'Created',
    202 => 'Accepted',
    203 => 'Non-Authoritative Information',
    204 => 'No Content',
    205 => 'Reset Content',
    206 => 'Partial Content',
    207 => 'Multi-Status',
    300 => 'Multiple Choices',
    301 => 'Moved Permanently',
    302 => 'Found',
    303 => 'See Other',
    304 => 'Not Modified',
    305 => 'Use Proxy',
    306 => 'Switch Proxy',
    307 => 'Temporary Redirect',
    400 => 'Bad Request',
    401 => 'Unauthorized',
    402 => 'Payment Required',
    403 => 'Forbidden',
    404 => 'Not Found',
    405 => 'Method Not Allowed',
    406 => 'Not Acceptable',
    407 => 'Proxy Authentication Required',
    408 => 'Request Timeout',
    409 => 'Conflict',
    410 => 'Gone',
    411 => 'Length Required',
    412 => 'Precondition Failed',
    413 => 'Request Entity Too Large',
    414 => 'Request-URI Too Long',
    415 => 'Unsupported Media Type',
    416 => 'Requested Range Not Satisfiable',
    417 => 'Expectation Failed',
    418 => 'I\'m a teapot',
    422 => 'Unprocessable Entity',
    423 => 'Locked',
    424 => 'Failed Dependency',
    425 => 'Unordered Collection',
    426 => 'Upgrade Required',
    449 => 'Retry With',
    450 => 'Blocked by Windows Parental Controls',
    500 => 'Internal Server Error',
    501 => 'Not Implemented',
    502 => 'Bad Gateway',
    503 => 'Service Unavailable',
    504 => 'Gateway Timeout',
    505 => 'HTTP Version Not Supported',
    506 => 'Variant Also Negotiates',
    507 => 'Insufficient Storage',
    509 => 'Bandwidth Limit Exceeded',
    510 => 'Not Extended'
);

define('BD_SERVIDOR', getenv('OPENSHIFT_MYSQL_DB_HOST'));
define('BD_NOMBRE', 'pbd_contacts');
define('BD_USUARIO', getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
define('BD_PASSWORD', getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
$db = mysqli_connect(BD_SERVIDOR, BD_USUARIO, BD_PASSWORD, BD_NOMBRE);

// USUARIOS

//GET USER BY ID
$app->get('/contact/:id',function ($id) use($db, $app) {
    $query = "SELECT * from contact where id = '".$id."';";
    $resultado = $db->query($query);
    $usuario = mysqli_fetch_assoc($resultado);
    echo json_encode($usuario);
});
//GET ALL USERS
$app->get('/contact', function() use($db){
    $query = "SELECT * from contact";
    $resultado = $db->query($query);
    $usuarios = array();
    while($usuario = mysqli_fetch_assoc($resultado)){
        $usuarios[] = $usuario;
    }
    echo json_encode($usuarios);
});
//DELETE USER USING ID
$app->delete('/contact/:id',function ($id) use($db, $app) {
    $query = "DELETE from contact where id = '".$id."';";
    $resultado = $db->query($query);
});
// MODIFING USER USING ID
$app->put('/contact/:id', function($id) use($db, $app){
    $user = $app->request;
    $user = $user->getBody();
    $user = json_decode($user);
    $nombre = $user->nombre;
    $apellido1 = $user->apellido1;
    $apellido2 = $user->apellido2;
    $numero = $user->telefono;
    $email = $user->email;
    $imagen = $user->imagen;

     $query = "SELECT * from contact where id = ".$id.";";
    $resultado = $db->query($query);

    if(mysqli_num_rows($resultado) == 1){
        $query = "UPDATE contact set nombre='".$nombre."',apellido1='".$apellido1."',apellido2='".$apellido2."',telefono='".$numero."',email='".$email."',imagen='".$imagen."' where id=".$id.";";
        $db->query($query);
        $app->response->setStatus(200);
    }else{
        $app->response->setStatus(406);
    }
});
//Adding user
$app->post('/contact', function() use($db, $app){
    $user = $app->request;
    $user = $user->getBody();
    $user = json_decode($user);
    $nombre = $user->nombre;
    $apellido1 = $user->apellido1;
    $apellido2 = $user->apellido2;
    $numero = $user->telefono;
    $email = $user->email;
    $imagen = $user->imagen;

    $query = "INSERT INTO contact (nombre, apellido1, apellido2, telefono, email, imagen) values ('".$nombre."','".$apellido1."','".$apellido2."','".$numero."','".$email."','".$imagen."');";
    $db->query($query);
    $app->response->setStatus(200);
});


$app->run();
?>
