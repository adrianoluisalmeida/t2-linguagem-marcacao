<?php
header("Content-type: text/html; charset=utf-8");

require("./vendor/autoload.php");

use JsonPath\JsonObject;
use JsonPath\InvalidJsonException;
use JsonPath\InvalidJsonPathException;

$json = file_get_contents('movies.json');

$jsonPath = "$.topic[?(@.instanceOf.topicRef.* == '#Genero')].baseName.baseNameString";
//
try {
    $jsonObject = new JsonObject($json);
} catch (InvalidJsonException $e) {
    print "Invalid JSON error: '" . $e->getMessage() . "'\r\n";
    die();
}

try {
    $r = $jsonObject->get($jsonPath);
} catch (InvalidJsonPathException $e) {
    print "Invalid JSONPath error: '" . $e->getMessage() . "'\r\n";
    die();
}

if ($r === false) {
    print "Nada encontrado";
} else {
    print json_encode($r, JSON_UNESCAPED_UNICODE);
}