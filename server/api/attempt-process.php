<?php

include '../model/FrequencyAnalysis.php';
include '../model/CaesarCipher.php';

$text = $_POST['text'];
$estimatedOffset = CaesarCipher::runFrequencyAnalysis($text);

if($estimatedOffset == 0 || $estimatedOffset == 26)     // if initial text is not encrypted
    $data = ['offset' => 0];

$data = ['offset' => $estimatedOffset];
echo json_encode($data);