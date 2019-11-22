<?php 

header("Content-type: text/html; charset=utf-8");

require("./vendor/autoload.php");

use JsonPath\JsonObject;

$json = file_get_contents('movies.json');
$jsonPath = "$.topic[?(@.occurrence)]";
$jsonObject = new JsonObject($json);
$r = $jsonObject->get($jsonPath);



foreach(json_decode($json) as $topic){
    foreach($topic as $result){
        
        if(property_exists($result, 'occurrence')){
                
            $pkCount = (is_array($result->occurrence) ? count($result->occurrence) : 0);
            if($pkCount > 2){
                
                $array = (array) $result->occurrence[2]->scope->topicRef;
                $desc = (array) $result->occurrence[2]->resourceData;

                if(preg_match("/especial(\s|$|\.|\,)/", $desc[0])) {
                    echo $result->occurrence[0]->resourceData . "\n";
                }
            
            };
    
        }        
    }
}