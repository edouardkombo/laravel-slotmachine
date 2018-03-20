<?php

class SlotMachineTest extends TestCase
{
    /**
     * @var array
     */
    public $config = [];

    /**
     * @var string
     */
    public $paylines = '{
      "0" :{
        "0" : [0,0],
        "3" : [0,1],
        "6" : [0,2],
        "9" : [0,3],
        "12" : [0,4]
      },
      "1" :{
        "1": [1,0],
        "4": [1,1],
        "7": [1,2],
        "10": [1,3],
        "13": [1,4]
      },
      "2" :{
        "2": [2,0],
        "5": [2,1],
        "8": [2,2],
        "11": [2,3],
        "14": [2,4]
      },
      "3" :{
        "0": [0,0],
        "4": [1,1],
        "8": [2,2],
        "10": [1,3],
        "12": [0,4]
      },
      "4" :{
        "2": [2,0],
        "4": [1,1],
        "6": [0,2],
        "10": [1,3],
        "14": [2,4]
      }
    }';

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
        $stub->config['paylines'] = json_decode($this->paylines, true);
        $stub->config['payouts'] = json_decode($this->payouts, true);
        $stub->matrix = $this->matrix;

        $this->spin = $stub;
    }

    /**
     * Assert that slot machine returns Json expected output format
     *
     * @return void
     */
    public function testSlotMachineJsonOutputFormat()
    {
        $map = $this->spin->spin();

        $this->assertEquals(count($map), 4);

        $this->assertArrayHasKey('paylines', $map);
        $this->assertArrayHasKey('total_win', $map);
        $this->assertArrayHasKey('bet_amount', $map);
        $this->assertArrayHasKey('board', $map);

        $this->assertEquals(count($map['paylines']), 2);
        $this->assertArrayHasKey('0,3,6,9,12', $map['paylines']);
        $this->assertArrayHasKey('0,4,8,10,12', $map['paylines']);

        $this->assertEquals($map['paylines']['0,3,6,9,12'], 3);
        $this->assertEquals($map['paylines']['0,4,8,10,12'], 3);

        $this->assertEquals($map['total_win'], 40);
        $this->assertEquals($map['bet_amount'], 100);

        $this->assertEquals($map['board'], ['j','j','j','q','k','cat','j','q','monkey','bird','bird','bird','j','q','a']);
    }

}
