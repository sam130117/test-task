<?php
require_once '../model/CaesarCipher.php';

$text = $_POST['text'];
$offset = $_POST['offset'];

$decryptedText = CaesarCipher::decrypt($text, $offset);

$data = ['text' => $decryptedText];
echo json_encode($data);