<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/03/18
 * Time: 14:46
 */

namespace App\Http\Interfaces;

interface MapInterface
{
    /**
     * Map the shuffled result(s) into a multidimensional array
     *
     * @param array $faces
     * @param array $config Game config
     * @return array
     */
    function map(array $faces, array $config);
}