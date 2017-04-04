<?php
require_once 'FrequencyAnalysis.php';

class CaesarCipher
{
    private static $alphabet = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5, 'f' => 6, 'g' => 7, 'h' => 8,
        'i' => 9, 'j' => 10, 'k' => 11, 'l' => 12, 'm' => 13, 'n' => 14, 'o' => 15, 'p' => 16, 'q' => 17, 'r' => 18,
        's' => 19, 't' => 20, 'u' => 21, 'v' => 22, 'w' => 23, 'x' => 24, 'y' => 25, 'z' => 26, 'A' => 27, 'B' => 28,
        'C' => 29, 'D' => 30, 'E' => 31, 'F' => 32, 'G' => 33, 'H' => 34, 'I' => 35, 'J' => 36, 'K' => 37, 'L' => 38,
        'M' => 39, 'N' => 40, 'O' => 41, 'P' => 42, 'Q' => 43, 'R' => 44, 'S' => 45, 'T' => 46, 'U' => 47, 'V' => 48,
        'W' => 49, 'X' => 50, 'Y' => 51, 'Z' => 52];

    private static $allowedSymbols = ['!' => 1, '?' => 2, ',' => 3, '.' => 4, ':' => 5, ';' => 6, '"' => 7, '(' => 8,
        ')' => 9, '-' => 10, ' ' => 11, '\'' => 12];


    /**
     * @param $text
     * @param $offset
     * @return string
     */
    public static function encrypt($text, $offset)
    {
        $encryptedText = '';
        for($i = 0; $i < strlen($text); $i++)
        {
            if (key_exists($text[$i], self::$allowedSymbols))
                $encryptedText .= $text[$i];

            else if (key_exists($text[$i], self::$alphabet))
            {
                $offsetValue = self::$alphabet[$text[$i]] + $offset;

                if(self::isStringUppercase($text[$i])) {
                    if ($offsetValue > count(self::$alphabet))
                        $offsetValue = $offsetValue - count(self::$alphabet) / 2;
                }
                else {
                    if($offsetValue > count(self::$alphabet) / 2)
                        $offsetValue = $offsetValue - count(self::$alphabet) / 2;
                }

                $offsetKey = array_search($offsetValue, self::$alphabet);
                $encryptedText .= $offsetKey;
            }
        }
        return $encryptedText;
    }

    /**
     * @param $encryptedText
     * @param $offset
     * @return string
     */
    public static function decrypt($encryptedText, $offset)
    {
        $decryptedText = '';
        for($i = 0; $i < strlen($encryptedText); $i++)
        {
            if (key_exists($encryptedText[$i], self::$allowedSymbols))
                $decryptedText .= $encryptedText[$i];

            else if (key_exists($encryptedText[$i], self::$alphabet))
            {
                $offsetValue = self::$alphabet[$encryptedText[$i]] - $offset;

                if(self::isStringUppercase($encryptedText[$i])) {
                    if ($offsetValue <= count(self::$alphabet) / 2)
                        $offsetValue = $offsetValue + count(self::$alphabet) / 2;
                }
                else {
                    if($offsetValue <= 0)
                        $offsetValue = $offsetValue + count(self::$alphabet) / 2;
                }
                $offsetKey = array_search($offsetValue, self::$alphabet);
                $decryptedText .= $offsetKey;
            }
        }
        return $decryptedText;
    }

    /**
     * Verifies the correspondence between the frequency of the letters of the alphabet and the frequency
     * of the letters of the given text. Returns the estimated offset.
     * @param $text
     * @return integer
     */
    public static function runFrequencyAnalysis($text)
    {
        if(empty($text)) return 0;

        $result = FrequencyAnalysis::runAnalysis($text);
        $estimatedOffsets = null;
        foreach ($result as $encryptedLetter => $alphabetLetter)
        {
            $offset = self::$alphabet[$encryptedLetter] - self::$alphabet[$alphabetLetter];
            if($offset < 0) {
                $offset = count(self::$alphabet) / 2 + $offset;
            }
            $estimatedOffsets[] = $offset;
        }
        $groupedEstimatedOffsets = array_count_values($estimatedOffsets);
        $mostFrequentOffset = max($groupedEstimatedOffsets);
        $mostFrequentOffsetKeys = array_keys($groupedEstimatedOffsets, $mostFrequentOffset);
        $result = array_sum($mostFrequentOffsetKeys) / count($mostFrequentOffsetKeys);

        return round($result);
    }

    /**
     * Check if string contains A-Z letters
     * @param $string
     * @return bool
     */
    public static function isStringUppercase($string) {
        if(preg_match("/[A-Z]/", $string) === 1)
            return true;
        return false;
    }
}