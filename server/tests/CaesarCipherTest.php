<?php
include_once '../model/CaesarCipher.php';
include_once '../model/FrequencyAnalysis.php';

use PHPUnit\Framework\TestCase;

class CaesarCipherTest extends TestCase
{
    public function testEncryptionIsCorrect(){
        $initialText = 'Technology has been a subject of discussion in philosophy since the Greeks.';
        $offset = 2;
        $correctEncryptedText = 'Vgejpqnqia jcu dggp c uwdlgev qh fkuewuukqp kp rjknquqrja ukpeg vjg Itggmu.';

        $encryptedText = CaesarCipher::encrypt($initialText, $offset);
        $this->assertEquals($correctEncryptedText, $encryptedText);
    }

    public function testDecryptionIsCorrect(){
        $initialText = 'Vgejpqnqia jcu dggp c uwdlgev qh fkuewuukqp kp rjknquqrja ukpeg vjg Itggmu.';
        $offset = 2;
        $correctDecryptedText = 'Technology has been a subject of discussion in philosophy since the Greeks.';

        $decryptedText = CaesarCipher::decrypt($initialText, $offset);
        $this->assertEquals($correctDecryptedText, $decryptedText);
    }

    public function testDecryptionEmptyString(){
        $initialText = '';
        $offset = 2;
        $correctDecryptedText = '';

        $decryptedText = CaesarCipher::decrypt($initialText, $offset);
        $this->assertEquals($correctDecryptedText, $decryptedText);
    }

    public function testEncryptionEmptyString(){
        $initialText = '';
        $offset = 2;
        $correctEncryptedText = '';

        $encryptedText = CaesarCipher::decrypt($initialText, $offset);
        $this->assertEquals($correctEncryptedText, $encryptedText);
    }

}