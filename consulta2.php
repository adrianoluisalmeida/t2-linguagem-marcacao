<?php 

header("Content-type: text/html; charset=utf-8");

require("./vendor/autoload.php");

use JsonPath\JsonObject;

$json = file_get_contents('movies.json');
$jsonPath = "$.association[?(@.member[1].topicRef.* == '#id_2000')].member[0].topicRef.*";
$jsonObject = new JsonObject($json);

$r = $jsonObject->get($jsonPath);


foreach(json_decode($json)->topic as $topic){
    $names = [];
    $array_topic = (array) $topic;
    foreach($r as $result){
        if($array_topic["@id"]  == substr($result, 1)){
            $nomes[] = $array_topic['baseName']->baseNameString;
        }
        
    }
    
}

sort($nomes);
foreach($nomes as $nome){
    echo $nome . "\n";
}