<?php
/**
 * Validação schema JSON
 */
require("./vendor/autoload.php");

use JsonSchema\Validator;
use JsonSchema\Constraints\Constraint;

$data = json_decode(file_get_contents('movies.json'));
$validations = (object) [
    "type"=>"object",
    "required" => ["topic", "association"],
    "properties"=> (object) [
        
        //TOPIC
        "topic"=> (object) [
            "type"=> "array",

            "items" => (object) [
                "type" => "object",
                "properties" => (object) [

                    //@id
                    "@id" => (object) [
                        "type" => "string"
                    ],

                    //instanceOf
                    "instanceOf" => (object) [
                        "type" => "object",
                        "required" => ["topicRef"],
                        "properties" => (object) [
                            "topicRef" => (object) [ 
                                "type" => "object",
                                "properties" => (object)[
                                    "@href" => (object)[ 
                                        "type" => "string"
                                    ]
                                ],
                                "required" => ["@href"]    
                            ]
                        ]
                    ],

                    //baseName
                    "baseName" => (object) [
                        "type" => ["object", "array"],
                        "properties" => (object)[
                            "baseNameString" => (object)[
                                "type" => "string"
                            ]
                        ]
                    ],

                    //ocurrence
                    "occurrence" => (object) [
                        "type" => ["array", "object"],
                        "items" => (object) [
                            "type" => "object",
                            "properties" => (object) [

                                //scope
                                "scope" => (object) [
                                    "type" => "object",
                                    "properties" => (object) [
                                        "topicRef" => (object) [
                                            "type" => "object",
                                            "properties" => (object) [
                                                "@href" => (object) [
                                                    "type" => "string"
                                                ]
                                            ],
                                            "required" => ["@href"]
                                        ]
                                    ],
                                    "required" => ["topicRef"]
                                ],

                                //resourceData
                                "resourceData" => (object) [
                                    "type" => "string"
                                ],

                                //instanceOf
                                "instanceOf" => (object) [
                                    "type" => "object",
                                    "properties" => (object) [
                                        "topicRef" => (object) [
                                            "type" => "object",
                                            "properties" => (object) [
                                                "@href" => (object) [
                                                    "type" => "string"
                                                ]
                                            ],
                                            "required" => ["@href"]
                                        ]
                                    ],
                                    "required" => ["topicRef"]

                                ],
                                //resourceRef
                                "resourceRef" => (object) [
                                    "type" => "object",
                                    "properties" => (object) [
                                        "@href" => (object) [
                                            "type" => "string"
                                        ]
                                    ],
                                    "required" => ["@href"]

                                ]
                            ],
                            
                        ]

                    ]

                    
                ],
                "required" => ["@id", "baseName"],
                //"additionalProperties" => true             
            ],
            "minItems" => 1
            
            
        ],
        "association" => (object) [
            "type"=> "array",
            "items" => (object) [
                "type" => "object",
                "properties" => (object) [

                    //instanceOf
                    "instanceOf" => (object) [
                        "type" => "object",
                        "properties" => (object) [
                            "topicRef" => (object) [
                                "type" => "object",
                                "properties" => (object) [
                                    "@href" => (object) [
                                        "type" => "string"
                                    ]
                                ],
                                "required" => ["@href"]
                            ]
                        ],
                        "required" => ["topicRef"]
    
                    ],

                    
                    "member" => (object) [
                        "type" => "array",
                        "items" => (object) [
                            "type" => "object",
                            "properties" => (object) [
                                "topicRef" => (object) [
                                    "type" => "object",
                                    "properties" => (object) [
                                        "@href" => (object) [
                                            "type" => "string"
                                        ]
                                    ],
                                    "required" => ["@href"]
                                ]
                            ],
                            "required" => ["topicRef"]
                        ],
                        "minItems" => 1
                    ]
                ],
                "required" => ["instanceOf", "member"]
                
            ]
        ]
    ],
    
];
$validator = new Validator();
$validator->validate(
    $data, 
    $validations,
    Constraint::CHECK_MODE_VALIDATE_SCHEMA
); // validates!

var_dump('<pre>', $validations, '</pre>');

if ($validator->isValid()) {
    echo "O documento informado é válido.";
} else {
    echo "O documento é inválido. Violações: <br>";
    echo "<ul>";
    foreach ($validator->getErrors() as $error) {
        echo "<li>" . sprintf("[%s] %s\n", $error['property'], $error['message']) . "</li>";
    }
    echo "</ul>";
}
//var_dump(is_int($request->refundAmount)); // true