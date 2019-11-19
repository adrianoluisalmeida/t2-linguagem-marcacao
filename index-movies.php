<?php
/**
 * Aquivo de leitura do movies.json 
 * */ 
$data = json_decode(file_get_contents('movies.json'));

$arrayFilmes = [];

$i = 0;
foreach($data->topic as $d){
    $href = "@href";
    $id = "@id";
        
    if(property_exists($d, 'instanceOf')){
        
        if($d->instanceOf->topicRef->$href == "#Filme"){

            if(property_exists($d, 'baseName')){
                if(property_exists($d->baseName, 'baseNameString')){
                    $arrayFilmes[$d->$id]['name'] = $d->baseName->baseNameString;
                }
            }
            if(property_exists($d, 'occurrence')){
            
                foreach($d->occurrence as $ocurrenc){
                    if(property_exists($ocurrenc, 'scope')){
                        if(property_exists($ocurrenc->scope, 'topicRef')){
                            if($ocurrenc->scope->topicRef->$href  == "#ingles"){
                                $arrayFilmes[$d->$id]['name_english'] = $ocurrenc->resourceData;
                            }

                            if($ocurrenc->scope->topicRef->$href  == "#sinopse"){
                                $arrayFilmes[$d->$id]['sinopse'] = $ocurrenc->resourceData;
                            }

                            if($ocurrenc->scope->topicRef->$href  == "#distribuicao"){
                                $arrayFilmes[$d->$id]['distribution'] = $ocurrenc->resourceData;
                            }

                            if($ocurrenc->scope->topicRef->$href  == "#site"){
                                $arrayFilmes[$d->$id]['site'] = $ocurrenc->resourceData;
                            }

                            if($ocurrenc->scope->topicRef->$href  == "#elencoApoio"){
                                $arrayFilmes[$d->$id]['cast_support'][] = $ocurrenc->resourceData;
                            }
                        }

                    
                    }
                 
                
                }
                
            
            }


        }
    }
    $i++;
    
}

foreach($data->association as $d){
    

    if($d->instanceOf->topicRef->$href == "#filme-ano")
        $arrayFilmes[substr($d->member[0]->topicRef->$href, 1)]['year'] = substr($d->member[1]->topicRef->$href, 4);

    if($d->instanceOf->topicRef->$href == "#filme-direcao")
        $arrayFilmes[substr($d->member[0]->topicRef->$href, 1)]['direction'] = substr($d->member[1]->topicRef->$href, 1);
    
    if($d->instanceOf->topicRef->$href == "#filme-duracao")
        $arrayFilmes[substr($d->member[0]->topicRef->$href, 1)]['duration'] = substr($d->member[1]->topicRef->$href, 1);

    if($d->instanceOf->topicRef->$href == "#elenco")
        $arrayFilmes[substr($d->member[0]->topicRef->$href, 1)]['cast'] = substr($d->member[1]->topicRef->$href, 1);

    if($d->instanceOf->topicRef->$href == "#filme-genero")
        $arrayFilmes[substr($d->member[0]->topicRef->$href, 1)]['genre'] = substr($d->member[1]->topicRef->$href, 1);
}

return $arrayFilmes;