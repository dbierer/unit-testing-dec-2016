<?php

class RomanNumeral
{
    protected $romanValues = array(
        0 => array(
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
        ),
        1 => array(
            1 => 'X',
            2 => 'XX',
            3 => 'XXX',
            4 => 'XL',
            5 => 'L',
            6 => 'LX',
            7 => 'LXX',
            8 => 'LXXX',
            9 => 'XC',
        )
    );

    public function curryGetRomanValue($power, array $romanValues)
    {
        return function ($item) use ($power, $romanValues) {
            return !empty($item) ? $romanValues[$item] : '';
        };
    }

    public function convert($arabicNumber)
    {
        $arabicNumber = (string) $arabicNumber;

        $arabicNumberArray = str_split($arabicNumber);

        // Functional programming style
        $getRomanValueIsOfPower0 = $this->curryGetRomanValue(0, $this->romanValues[0]);
        $getRomanValueIsOfPower1 = $this->curryGetRomanValue(1, $this->romanValues[1]);

        return count($arabicNumberArray) > 1
            ? $getRomanValueIsOfPower1($arabicNumberArray[0]) . $getRomanValueIsOfPower0($arabicNumberArray[1])
            : $getRomanValueIsOfPower0($arabicNumberArray[0]);
    }

    public function convertCollection(array $arabicNumbers)
    {
        return array_map(array($this, 'convert'), $arabicNumbers);
    }
}
