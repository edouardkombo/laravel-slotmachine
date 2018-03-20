<?php

class PayoutsTest extends TestCase
{
    /**
     * @var array
     */
    public $config = [];

    /**
     * @var string
     */
    public $paylines = array (
      "0,3,6,9,12" => ["j","j","j","q","k"],
      "1,4,7,10,13" => ["cat","j","q","monkey","bird"],
      "2,5,8,11,14" => ["bird","bird","j","q","a"],
      "0,4,8,10,12" => ["j","j","j","monkey","k"],
      "2,4,6,10,14" => ["bird","j","j","monkey","a"]
    );

    /**
     * @var string
     */
    public $payouts = '{
      "occurences": {
        "3": 20,
        "4": 200,
        "5": 1000
      },
      "symbols": {
        "monkey,monkey,monkey": 2000
      }
    }';

    /**
     * @var array
     */
    public $matrix = [['j','j','j','q','k'],['cat','j','q','monkey','bird'],['bird','bird','j','q','a']];

    /**
     * @var mixed
     */
    public $spin;

    /**
     * @throws ReflectionException
     */
    public function setUp()
    {
        $stub = $this->getMockForAbstractClass('App\Http\Abstracts\SpinAbstract');
        $stub->config = [];
        $stub->paylines = $this->paylines;
        $stub->config['payouts'] = json_decode($this->payouts, true);
        $stub->matrix = $this->matrix;

        $this->spin = $stub;
    }

    /**
     * Assert that payouts matches expected result
     *
     * @return void
     */
    public function testPayoutsMatchesExpectedResult()
    {
        $map = $this->spin->getPayouts();

        $this->assertEquals(count($map), 2);

        $this->assertArrayHasKey('paylines', $map);
        $this->assertArrayHasKey('total_win', $map);

        $this->assertEquals(count($map['paylines']), 2);
        $this->assertArrayHasKey('0,3,6,9,12', $map['paylines']);
        $this->assertArrayHasKey('0,4,8,10,12', $map['paylines']);

        $this->assertEquals($map['paylines']['0,3,6,9,12'], 3);
        $this->assertEquals($map['paylines']['0,4,8,10,12'], 3);
        $this->assertEquals($map['total_win'], 40);
    }

}
