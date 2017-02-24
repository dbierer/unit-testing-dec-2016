<?php

class UserTest extends PHPUnit_Framework_TestCase
{

    protected $db;
    protected $stmt;

    public function setup()
    {
        // Create our dependencies
        $this->db = Mockery::mock('PDO');
        $this->stmt = Mockery::mock('PDOStatement');
    }

    /**
     * @test
     */
    public function fetchAllReturnsExpectedResults()
    {
        // Our PDOStatement needs an execute method that returns a boolean
        $this->stmt->shouldReceive('execute')->andReturn(true);

        // Our PDOStatement needs a fetchAll method that returns an array
        $users = [
            ['id' => 1, 'email' => 'chartjes@grumpy-learning.com'],
            ['id' => 2, 'email' => 'info@example.com']
        ];
        $this->stmt->shouldReceive('fetchAll')->andReturn($users);

        // Our DB needs to return the PDOStatement
        $this->db->shouldReceive('prepare')->andReturn($this->stmt);

        /**
         * Create a new User object that takes the test double we created as
         * a constructor argument
         */
        $user = new User($this->db);
        $response = $user->getAll();

        $this->assertEquals($users, $response);
    }

    /**
     * @test
     */
    public function getAllActiveWorks()
    {
        $this->stmt->shouldReceive('execute')->andReturn(true);
        $users = [
            ['id' => 1, 'email' => 'foo@bar.com', 'is_active' => 1],
            ['id' => 2, 'email' => 'bar@bar.com', 'is_active' => 0],
            ['id' => 3, 'email' => 'baz@bar.com', 'is_active' => 1]
        ];
        $expected = [
            ['id' => 1, 'email' => 'foo@bar.com'],
            ['id' => 3, 'email' => 'baz@bar.com']
        ];
        $this->stmt->shouldReceive('fetchAll')->andReturn($users);
        $this->db->shouldReceive('prepare')->andReturn($this->stmt);


        $user = new User($this->db);
        $response = $user->getAllActive();


        $this->assertEquals($expected, $response);
    }
}
