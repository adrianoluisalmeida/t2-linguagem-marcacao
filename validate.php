<?php

require("./vendor/autoload.php");

use JsonSchema\Validator;

$data = json_decode(file_get_contents('movies.json'));

$schema = (object)[
    "type" => "object",
    "properties"=> (object) [
        "topic" => (object) [
            "type" => "array",
            "topic" => (object) [
                "type" => "object",
                "required" => (object) ["@id"],
                "properties"=> (object) [
                    "@id" => (object) [
                        "type" => "string"
                    ],
                    "instanceOf" => (object) [
                        "type" => "object"
                    ],
                    "baseName" => [
                        "required" => (object) ["baseNameString"],
                        "type" =>  (object) ["object", "array"],
                        "properties" => (object) [
                            "baseNameString" => (object) [
                                "type" => "string"
                            ]
                        ]
                    ]
                ]
            ]
        ],
        "association" => (object) [
            "type" => "array",
            "required" => [
                "topicc"
            ]
        ]

    ]
];
    



$validator = new Validator();
$validator->validate($data, $schema);
var_dump('<pre>', $validator->isValid(), '</pre>');

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