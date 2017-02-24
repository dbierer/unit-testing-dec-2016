<?php
/**
 * Makes actual call to API
 * NOTE: such a test is expensive in terms of time and resources!!!
 *
 * For this test to work, the API simulator must be running
 * To Run API Simulator:
 *
 * #1: cd /path/to/source/api
 * #2: php -S localhost:8080 index.php
 * #3: usage:
 *     var_dump((new WidgetApi())->findByName('xxx'));
 *     where "xxx" = the name of the widget
 *
 * Look in /path/to/source/api/data.txt for widgets
 */

class WidgetApiTest extends PHPUnit_Framework_TestCase
{
    protected $api;
    public function setup()
    {
        $this->api = new WidgetApi();
    }
    public function testCallTest()
    {
        // expected row from the API call
        $expected = '{"widget":"test","price":"111.11","date":"2016-12-28 11:11:11"}';
        // make the call
        $response = $this->api->findByName('test');
        $this->assertEquals($expected, $response);
    }
}
