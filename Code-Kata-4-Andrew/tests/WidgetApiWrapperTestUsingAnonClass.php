<?php
// NOTE: only works in PHP 7 and above

class WidgetApiWrapperTest extends PHPUnit_Framework_TestCase
{

    const API_URL = 'http://localhost:8080';
    const ERROR_EXPECTED_ARRAY = 'ERROR: Expected array not returned';
    const ERROR_EXPECTED_EXCEPTION = 'ERROR: Expected an Exception';

    protected $api;
    protected $storage;
    protected $wrapper;
    protected $expectedRow;
    protected $expectedJson;

    /*public function setup()
    {
        // Create expected results
        $this->expectedRow = [
            'widget' => 'grumpy-learning',
            'price' => '100.10',
            'date' => '2016-08-06 14:00:00'
        ];
        $this->expectedJson = json_encode($this->expectedRow);

        // create test double for WidgetApi using PHP 7 anonymous class
        $this->api = new class() extends WidgetApi {
            protected $fake;
            public function setFake($fake)
            {
                $this->fake = $fake;
                return $this;
            }
            public function findByName($name)
            {
                return $this->fake;
            }
        };
        $this->api->setFake($this->expectedJson);

        // create test double for WidgetStorage using PHP 7 anonymous class
        $this->storage = new class() extends WidgetStorage {
            public function __construct()
            {
                // do nothing
            }
            public function setSaveReturn($return)
            {
                $this->saveReturn = $return;
            }
            public function save($data)
            {
                return $this->saveReturn;
            }
        };
        $this->storage->setSaveReturn(true);
        $this->wrapper = new WidgetApiWrapper(self::API_URL, $this->api, $this->storage);
    }

    public function teardown()
    {
        $this->api = NULL;
        $this->storage = NULL;
    }

    public function testRawCall()
    {
        $response = $this->wrapper->rawCallByName('test');
        $this->assertEquals($this->expectedRow, $response, self::ERROR_EXPECTED_ARRAY);
    }

    // NOTE: we are not trying to verify data was saved in the database ...
    //       that is the job of WidgetStorageTest!!!
    public function testCallByName()
    {
        $response = $this->wrapper->callByName('test');
        $this->assertEquals($this->expectedRow, $response, self::ERROR_EXPECTED_ARRAY);
    }

    // NOTE: we are not trying to confirm a database error ...
    //       we are just asserting that if the storage class is unable to save data, an Exception is thrown
    public function testCallByNameThrowsException()
    {
        $e = NULL;
        $this->storage->setSaveReturn(false);
        try {
            $response = $this->wrapper->callByName('test');
        } catch (PDOException $e) {
            // do nothing
        } catch (Exception $e) {
            // do nothing
        }
        $this->assertInstanceOf(PDOException::class, $e, self::ERROR_EXPECTED_EXCEPTION);
    }*/

}
