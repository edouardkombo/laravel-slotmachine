<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/03/18
 * Time: 14:46
 */

namespace App\Http\Interfaces;

use phpDocumentor\Reflection\Types\Integer;

interface ShuffleInterface
{
    /**
     * Shuffle faces and extract an exact number of rows
     *
     * @param array $faces
     * @param array $config Game config
     * @return array
     */
    function shuffle(array $faces, array $config);
}