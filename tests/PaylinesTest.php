<?php

class PaylinesTest extends TestCase
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
        $stub->matrix = $this->matrix;

        $this->spin = $stub;
    }

    /**
     * Assert that payline matches expected result
     *
     * @return void
     */
    public function testPaylineMatchesExpectedResult()
    {
        $map = $this->spin->getPaylines();

        $this->assertEquals(count($map), count(array_keys(json_decode($this->paylines, true))));

        $this->assertArrayHasKey('0,3,6,9,12', $map);
        $this->assertArrayHasKey('1,4,7,10,13', $map);
        $this->assertArrayHasKey('2,5,8,11,14', $map);
        $this->assertArrayHasKey('0,4,8,10,12', $map);
        $this->assertArrayHasKey('2,4,6,10,14', $map);

        $this->assertEquals($map['0,3,6,9,12'], ['j','j','j','q','k']);
        $this->assertEquals($map['1,4,7,10,13'], ['cat','j','q','monkey','bird']);
        $this->assertEquals($map['2,5,8,11,14'], ['bird','bird','j','q','a']);
        $this->assertEquals($map['0,4,8,10,12'], ['j','j','j','monkey','k']);
        $this->assertEquals($map['2,4,6,10,14'], ['bird','j','j','monkey','a']);
    }

}
