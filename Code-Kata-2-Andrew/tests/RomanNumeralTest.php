<?php

class RomanNumeralTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider numberDataProvider
     */
    public function testItAllWorks($collection, $expected)
    {
     $romanNum = new RomanNumeral();
     $response = $romanNum->convertCollection($collection);
     $this->assertEquals($expected, $response);
    }

    public function numberDataProvider()
    {
        return [
            [range(1,10),
                ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X']],
            [range(11,20),
                ['XI', 'XII', 'XIII', 'XIV', 'XV', 'XVI', 'XVII', 'XVIII', 'XIX', 'XX']],
            [[40, 41, 43, 44, 45, 49],
                ['XL', 'XLI', 'XLIII', 'XLIV', 'XLV', 'XLIX']],
            [[50, 51, 53, 54, 55],
                ['L', 'LI', 'LIII', 'LIV', 'LV']]
        ];
    }
}
