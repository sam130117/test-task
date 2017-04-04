<?php


class FrequencyAnalysis
{
    private static $englishLetterFrequency = ['z' => 0.05, 'q' => 0.1, 'j' => 0.15, 'x' => 0.15, 'k' => 0.77, 'v' => 0.98,
        'b' => 1.49, 'p' => 1.93, 'y' => 1.97, 'g' => 2.02, 'f' => 2.23, 'w' => 2.36, 'm' => 2.41, 'u' => 2.76,
        'c' => 2.78, 'l' => 4.03, 'd' => 4.25, 'r' => 5.99, 'h' => 6.09, 's' => 6.33, 'n' => 6.75, 'i' => 6.97,
        'o' => 7.51, 'a' => 8.17, 't' => 9.06, 'e' => 12.7 ];


    public static function runAnalysis($encryptedText)
    {
        $frequency = self::getLetterFrequencyArray($encryptedText);
        $estimatedValues = null;

        foreach($frequency as $encryptedLetter => $encryptedValue)
        {
            foreach (self::$englishLetterFrequency as $letter => $value)
            {
                if($encryptedValue == $value)
                {
                    $estimatedValues[$encryptedLetter] = $letter; break;
                }
                else {
                    if($encryptedValue > $value)
                    {
                        $prevLetter =  $letter;
                        $prevValue = $value;
                    }
                    else if($encryptedValue < $value) {
                        $nextLetter = $letter;
                        $nextValue = $value;
                        if(($encryptedValue - $prevValue) >= ($nextValue - $encryptedValue))
                            $estimatedValues[$encryptedLetter] = $nextLetter;
                        else
                            $estimatedValues[$encryptedLetter] = $prevLetter;
                        break;
                    }
                }
            }
        }
        return $estimatedValues;
    }

    private static function getLetterFrequencyArray($text)
    {
        $text = strtolower($text);
        $array = [];
        $textLength = strlen($text);
        for($i = 0; $i < $textLength; $i++) {
            $character = $text[$i];
            if(key_exists($character, self::$englishLetterFrequency))
            {
                if (key_exists($character,$array))
                    $array[$character] += 1;
                else
                    $array[$character] = 1;
            }
        }
        foreach($array as $key => $value)
            $array[$key]= round($value / $textLength * 100, 2);
        return $array;
    }
}