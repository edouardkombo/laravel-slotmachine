<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/03/18
 * Time: 14:46
 */

namespace App\Http\Strategies\Shuffle;

/**
 * Class ShufflePerLineStrategy
 *
 * Shuffle the faces and extract "reels" number of values
 *
 * @package App\Http\Strategies\Shuffle
 */
class ShufflePerLineStrategy
{
    use \App\Http\Traits\ShuffleTrait;

    /**
     * ShufflePerRowStrategy constructor.
     *
     * @param array $faces
     * @param array $config Game config
     */
    public function __construct(array $faces, array $config)
    {
        $this->faces = $faces;
        $this->number = $config['dimensions']['reels'];
    }
}