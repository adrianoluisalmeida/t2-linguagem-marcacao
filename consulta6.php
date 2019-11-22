<?php 

header("Content-type: text/html; charset=utf-8");

require("./vendor/autoload.php");

use JsonPath\JsonObject;

$json = file_get_contents('movies.json');
$jsonPath = "$.topic[?(@.occurrence)]";
$jsonObject = new JsonObject($json);
$r = $jsonObject->get($jsonPath);

$elencoFilme = [];
foreach(json_decode($json) as $jso){
    foreach($jso as $js){
        if(property_exists($js, 'instanceOf')){
            $elenco = (array) $js->instanceOf->topicRef;
            if($elenco['@href'] == '#Elenco'){
                $elencoFilme[] = $js->baseName->baseNameString;
                
            }
            
        }
    }
}

$filmesId = [];
foreach(json_decode($json) as $topic){
    foreach($topic as $result){
        
        if(property_exists($result, 'occurrence')){
                
            $pkCount = (is_array($result->occurrence) ? count($result->occurrence) : 0);
            if($pkCount > 2){
                
                $array = (array) $result->occurrence[2]->scope->topicRef;
                $desc = (array) $result->occurrence[2]->resourceData;
                $array_id = (array) $result;
                
                foreach($elencoFilme as $elenco){
                    if(preg_match("/$elenco/", $desc[0])) {
                        $filmesId[] = $array_id["@id"];
                        
                        //echo $result->occurrence[0]->resourceData . "\n";
                    }
                }
                
            
            };
    
        }        
    }
}

$filmesId = array_unique($filmesId);
foreach($filmesId as $filme){
    echo $filme . "\n";
}

