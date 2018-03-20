<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/03/18
 * Time: 14:46
 */

namespace App\Http\Abstracts;

use App\Http\Interfaces\ShuffleInterface;
use App\Http\Strategies\Shuffle\ShuffleStrategy;

abstract class ShuffleAbstract extends ShuffleStrategy implements ShuffleInterface
{
    /**
     * Shuffle faces and extract values depending on strategy
     *
     * @param array $faces
     * @param array $config Game config
     * @return array
     */
    public function shuffle(array $faces, array $config)
    {
        return $this->get($faces, $config)->execute();
    }
}