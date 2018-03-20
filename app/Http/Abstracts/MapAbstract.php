<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/03/18
 * Time: 14:46
 */

namespace App\Http\Abstracts;

use App\Http\Interfaces\MapInterface;
use App\Http\Strategies\Map\MapStrategy;

abstract class MapAbstract extends MapStrategy implements MapInterface
{
    /**
     * Map the shuffled result(s) into a multidimensional array
     *
     * @param array $faces
     * @param array $config Game config
     * @return array
     */
    public function map(array $faces, array $config)
    {
        return $this->get($faces, $config)->execute();
    }
}