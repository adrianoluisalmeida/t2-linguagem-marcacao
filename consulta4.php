<?php 

header("Content-type: text/html; charset=utf-8");

require("./vendor/autoload.php");

use JsonPath\JsonObject;

$json = file_get_contents('movies.json');
$jsonPath = "$.association[?(@.member[1].topicRef.* == '#thriller')].member[0].topicRef.*";
$jsonObject = new JsonObject($json);
$r = $jsonObject->get($jsonPath);

foreach(json_decode($json)->topic as $topic){
    $topicArray = (array) $topic;
    
    foreach($r as $result){
        
        if($topicArray["@id"] == substr($result, 1)){

            if(property_exists($topic, 'occurrence')){
                foreach($topic->occurrence as $ocur){
                    if(property_exists($ocur, 'instanceOf')){
                        $array = (array) $ocur->resourceRef;
                        
                        echo $array["@href"] . "\n";
                    }
                    
                }
            
            }
        }

    }
    
}

