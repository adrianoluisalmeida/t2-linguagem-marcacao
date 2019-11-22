<?php 

header("Content-type: text/html; charset=utf-8");

require("./vendor/autoload.php");

use JsonPath\JsonObject;

$json = file_get_contents('movies.json');
$jsonPath = "$.topic[?(@.occurrence)]";
$jsonObject = new JsonObject($json);
$r = $jsonObject->get($jsonPath);



    $filmesApoio = 0;
    foreach(json_decode($json)->topic as $result){
        $count = 0;
        if(property_exists($result, 'occurrence')){
                
            $pkCount = (is_array($result->occurrence) ? count($result->occurrence) : 0);
            if($pkCount > 2){
                $count = 0;
                foreach($result->occurrence as $ocur){
                    
                    if(property_exists($ocur, 'scope')){
                        $topicRef = (array) $ocur->scope->topicRef;
                
                        if($topicRef["@href"] == "#elencoApoio"){
                            $count++;
                        }
                    }
                    
                }
                

                if($count == 3){
                    $filmesApoio++;
                }

            };
    
        }        

    }

    print("Total de filmes: " . $filmesApoio . "\n");