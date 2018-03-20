<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/03/18
 * Time: 14:46
 */

namespace App\Http\Strategies\Map;

use App\Http\Abstracts\ShuffleAbstract;

/**
 * Class MapPerRowStrategy
 *
 * Map the 2 dimensional array on a per row strategy
 *
 * Ex:
 * reels = number of horizontal symbols (Lines)
 * slots = number of rows (Rows)
 * If reels=5 and slots=3
 * We will loop 5 times, and each time, we will 'directly' assign 3 shuffled values vertically
 *
 * @package App\Http\Strategies\Map
 */
class MapPerRowStrategy extends ShuffleAbstract
{
    /**
     * @var array $config
     */
    private $config = [];

    /**
     * @var array $dimensions
     */
    private $dimensions = [];

    /**
     * @var array $faces
     */
    private $faces = [];

    /**
     * MapPerRowStrategy constructor.
     *
     * @param array $faces
     * @param array $config Game config
     */
    public function __construct(array $faces, array $config)
    {
        $this->faces = $faces;
        $this->config = $config;
        $this->dimensions = $config['dimensions'];
    }

    /**
     * We reuse the shuffle method defined in the trait
     *
     * @return array
     */
    function map()
    {
        $map = [];
        for ($i=0; $i<$this->dimensions['reels']; $i++) {
            $shuffledRow = $this->shuffle($this->faces, $this->config);
            foreach ($shuffledRow as $key => $val) {
                $map[$key][$i] = $shuffledRow[$key];
            }
        }
        return $map;
    }
}