<?php

use bjoernffm\e6b\IsaTable;

/**
 * @codeCoverageIgnore
 */
class DataTableTest extends PHPUnit_Framework_TestCase
{
    public function testInterpolateFactor1()
    {
        $table = new IsaTable();
        $factor = $table->interpolateFactor(0, 100, 3);
        $this->assertEquals(0.03, $factor);

        $factor = $table->interpolateFactor(10, 20, 18);
        $this->assertEquals(0.8, $factor);

        $factor = $table->interpolateFactor(10, 20, 10);
        $this->assertEquals(0, $factor);

        $factor = $table->interpolateFactor(10, 20, 20);
        $this->assertEquals(1, $factor);

        $factor = $table->interpolateFactor(10, 10, 10);
        $this->assertEquals(0, $factor);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInterpolateFactor2()
    {
        $table = new IsaTable();
        $table->interpolateFactor(0, 10, 11);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInterpolateFactor3()
    {
        $table = new IsaTable();
        $table->interpolateFactor(5, 10, 1);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInterpolateFactor4()
    {
        $table = new IsaTable();
        $table->interpolateFactor(12, 10, 1);
    }

    public function testGetDataByField()
    {
        $table = new IsaTable();
        $result = $table->getDataByField('altitudeInFeet', 1000);
        $this->assertEquals(339, round($result['speedOfSound']));
    }

    public function test__call()
    {
        $table = new IsaTable();
        $result = $table->getDataByAltitudeInFeet(1000);
        $this->assertEquals(305, round($result['altitudeInMeters']));
    }
}
