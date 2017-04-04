<?php
require_once '../model/CaesarCipher.php';

$text = $_POST['text'];
$offset = $_POST['offset'];

$encryptedText = CaesarCipher::encrypt($text, $offset);

$data = ['text' => $encryptedText];
echo json_encode($data);