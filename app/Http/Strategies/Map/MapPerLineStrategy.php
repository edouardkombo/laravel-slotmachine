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
 * Class MapPerLineStrategy
 *
 * Map the 2 dimensional array on a per line strategy
 *
 * Ex:
 * reels = number of horizontal symbols (Lines)
 * slots = number of rows (Rows)
 * If reels=5 and slots=3
 * We will loop 3 times, and each time, we will 'directly' assign 5 shuffled values from faces to the array
 *
 * @package App\Http\Strategies\Map
 */
class MapPerLineStrategy extends ShuffleAbstract
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
        for ($i=0; $i<$this->dimensions['slots']; $i++) {
            for ($j=0; $j<$this->dimensions['reels']; $j++) {
                $map[$i] = $this->shuffle($this->faces, $this->config);
            }
        }
        return $map;
    }
}