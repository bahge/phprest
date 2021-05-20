<?php
require __DIR__ . '/vendor/autoload.php';
use App\Controllers\httpRequest;
use App\Controllers\httpResponse;
use App\Controllers\sum;

$request_method = $_SERVER["REQUEST_METHOD"];

$a = new httpRequest($request_method, CHECKMETHODS);
$a->verify_authentication(CREDENTIALS);

if ($a == true) {

    if ( $a->getHttpMethod() == 'GET' ) :
        $r = new httpResponse();
        $res = $r->is_valid_method("Olá apenas o méthodo POST está habilitado consulte a documentação");
    elseif ( $a->getHttpMethod() == 'POST' ):
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, TRUE);

        $s = new sum($input['value1'], $input['value2']);
        $sum = $s->sum();

        $r = new httpResponse();
        $res = $r->is_valid_method("Soma: " . $input['value1'] . " + " . $input['value2'] . " = " . $sum);
    endif;

    header($res['header']);
    http_response_code(200);
    echo json_encode($res['msg']);
}