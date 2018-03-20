<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/03/18
 * Time: 14:46
 */

namespace App\Http\Strategies\Shuffle;

use App\Http\Strategies\Shuffle\ShufflePerLineStrategy;
use App\Http\Strategies\Shuffle\ShufflePerRowStrategy;

/**
 * This class is a driver describing the shuffle strategy
 * It has been designed for high scalability
 * You can adopt your own shuffle Strategies without modifying this code
 *
 * The shuffle method is defined in the trait
 *
 * Class ShuffleStrategy
 * @package App\Http\Strategies\Shuffle
 */
class ShuffleStrategy
{
    /**
     * @var mixed
     */
    private $strategy;

    /**
     * ShuffleStrategy get data.
     *
     * @param array $faces
     * @param array $config Game config
     * @return $this
     */
    public function get(array $faces, array $config)
    {
        //Follow this pattern to add new drivers to the strategy
        $strategyName = "App\Http\Strategies\Shuffle\ShufflePer" . ucfirst($config['strategy']['shuffle']) . "Strategy";

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
     * Returns an array of "reels" value or "slots" value, depending on the strategy
     * OPTIONALLY: You can add your own strategy
     *
     * @return array
     */
    public function execute()
    {
       return  $this->strategy->shuffle();
    }
}