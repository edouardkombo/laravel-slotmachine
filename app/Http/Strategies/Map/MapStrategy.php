<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/03/18
 * Time: 14:46
 */

namespace App\Http\Strategies\Map;

use App\Http\Strategies\Map\MapPerLineStrategy;
use App\Http\Strategies\Map\MapPerRowStrategy;

/**
 * Class MapStrategy
 *
 * Map the multidimensional array following a specific strategy
 *
 * @package App\Http\Strategies\Map
 */
class MapStrategy
{
    /**
     * @var mixed
     */
    protected $strategy;

    /**
     * MapStrategy get params
     *
     * @param array $faces
     * @param array $config Game config
     * @return $this
     */
    public function get(array $faces, array $config)
    {
        //Follow this pattern to add new drivers to the Strategies
        $strategyName = "App\Http\Strategies\Map\MapPer" . ucfirst($config['strategy']['map']) . "Strategy";

        try {

            $this->strategy = new $strategyName($faces, $config);

            if (gettype($this->strategy) !== 'object') {
                throw new \Exception('Class '. __NAMESPACE__ .'\\'. $strategyName.'.php not found!');
            }

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return $this;
    }

    /**
     * Returns a full 2 dimensional array depending on the strategy
     * OPTIONALLY: You can add your own strategy
     *
     * @return array
     */
    public function execute()
    {
       return  $this->strategy->map();
    }
}