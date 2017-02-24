<?php

class WidgetStorageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
     public function storesSingleWidgetAsExpected()
     {
         // Create a WidgetApiWrapper double that returns a data set
         $widgetData = [
             'name' => 'grumpy-learning',
             'price' => '100.10',
             'date' => '2016-08-06 14:00:00'
         ];
         $wrapper = Mockery::mock('WidgetApiWrapper');
         $wrapper->shouldReceive('callByName')->andReturn($widgetData);

         // Create doubles for PDO and PDOStatement
         $stmt = Mockery::mock('PDOStatement');
         $stmt->shouldReceive('execute')->andReturn(true);

         // We need to bind :name, :price, and :date
         $stmt->shouldReceive('bindParam')->andReturn(true);
         $stmt->shouldReceive('bindParam')->andReturn(true);
         $stmt->shouldReceive('bindParam')->andReturn(true);

         $db = Mockery::mock('PDO');
         $db->shouldReceive('prepare')->andReturn($stmt);

         $storage = new WidgetStorage($db, $wrapper);
         $data = $wrapper->callByName('grumpy-learning');

         $this->assertTrue($storage->save($data));

         // Do a getByNameAndDate() call and verify records match
         $stmt = Mockery::mock('PDOStatement');
         $stmt->shouldReceive('execute')->andReturn(true);
         $stmt->shouldReceive('bindParam')->andReturn(true);
         $stmt->shouldReceive('bindParam')->andReturn(true);

         $row = $widgetData;
         $row['id'] = uniqid();
         $stmt->shouldReceive('fetch')->andReturn($row);
         $db = Mockery::mock('PDO');
         $db->shouldReceive('prepare')->andReturn($stmt);

         $storage = new WidgetStorage($db, $wrapper);
         $record = $storage->getByNameAndDate('grumpy-learning', '2016-08-06 14:00:00');
         $this->assertEquals($row, $record);
     }
}
