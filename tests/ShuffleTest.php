<?php

class ShuffleTest extends TestCase
{
    use \App\Http\Traits\ShuffleTrait;

    /**
     * @var array
     */
    private $vendor = ['a','b','c','d','e','f','g','h'];

    /**
     * Assert that function can shuffle and downsize array
     *
     * @return void
     */
    public function testFunctionCanShuffleAndDownsizeArray()
    {
        $this->faces = $this->vendor;

        for ($i=0; $i<count($this->faces); $i++) {
            $this->number = rand(2, (count($this->faces)-1));
            $arr = $this->shuffle();

            $this->assertEquals($this->number, count($arr));
            $this->assertNotEquals($this->faces, $arr);
        }
    }

    /**
     * Assert that array length can not greater than actual faces array length
     *
     * @return void
     */
    public function testArrayLengthCanNotBeGreaterThanFaces()
    {
        $this->faces = $this->vendor;
        $this->number = rand(count($this->faces), count($this->faces)+20);

        $result = $this->shuffle();

        $this->assertEquals($result, false);
    }
}
