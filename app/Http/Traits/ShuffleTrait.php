<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/03/18
 * Time: 16:09
 */

namespace App\Http\Traits;


trait ShuffleTrait
{
    /**
     * @var array $faces
     */
    protected $faces = [];

    /**
     * @var int $number
     */
    protected $number = 0;

    /**
     * Shared method for shuffling faces
     *
     * 1. Sort values of faces and keep only the maximum number of rows allowed
     * 2. Flip the indexes
     * 3. Return the matching keys
     * 4. Get the values and reset keys
     *
     * @return mixed
     */
    function shuffle()
    {
        $result = false;

        if ($this->number < count($this->faces)) {
            $result = array_values( array_intersect_key( $this->faces, array_flip(array_rand($this->faces, $this->number))) );
        }

        return $result;
    }
}