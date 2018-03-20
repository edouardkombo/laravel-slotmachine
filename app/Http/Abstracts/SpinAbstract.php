<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/03/18
 * Time: 14:46
 */

namespace App\Http\Abstracts;

use App\Http\Interfaces\SpinInterface;
use App\Http\Abstracts\MapAbstract;

abstract class SpinAbstract extends MapAbstract implements SpinInterface
{
    /**
     * @var array $paylines
     */
    public $paylines = [];

    /**
     * @var array $payouts
     */
    public $payouts = [];

    /**
     * @var array $config
     */
    public $config = [];

    /**
     * @var array $matrix
     */
    public $matrix = [];

    /**
     * @var integer $bet
     */
    public $bet = 100;


    /**
     * Get valid Paylines
     *
     * @return array
     */
    public function getPaylines()
    {
        $result = [];
        foreach ($this->config['paylines'] as $keyLine => $payline) {
            $paylineAsString = implode(',', array_keys($payline));
            $result[$paylineAsString] = [];
            foreach ($payline as $key => $points) {
                $result[$paylineAsString][] = $this->matrix[$points[0]][$points[1]];
            }
        }

        return $this->paylines = $result;
    }

    /**
     * Gat associated payouts
     *
     * @return array
     */
    public function getPayouts()
    {
        try {
            if (empty($this->paylines)) {
                throw new \Exception('You must call the paylines method first before calling this method.');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        $result = [];
        $result['paylines'] = [];
        $result['total_win'] = 0;

        $payoutsConfig = $this->config['payouts'];

        foreach ($this->paylines as $paylineKey => $payline) {

            $paylineAsString = implode(',', $payline);

            foreach($payoutsConfig as $payoutMethod => $payoutMethodValues) {
                //Search for number of occurences
                if ($payoutMethod === 'occurences') {
                    $maxOccurence = max(array_count_values($payline));

                    if (in_array($maxOccurence, array_keys($payoutsConfig[$payoutMethod]))) {
                        $result['paylines'][$paylineKey] = $maxOccurence;
                        $result['total_win'] += ($payoutsConfig[$payoutMethod][$maxOccurence] * $this->bet)/100;
                    }
                }

                foreach ($payoutMethodValues as $payoutKey => $value) {
                    //Search Symbols
                    if ($payoutMethod === 'symbols') {
                        if (strpos($paylineAsString, $payoutKey) !== false) {
                            $result['paylines'][] = $paylineKey;
                            $result['total_win'] += ($value * $this->bet)/100;
                        }
                    }
                }
            }
        }

        return $this->payouts = $result;
    }

    /**
     * Get the map in a single array
     *
     * @return array
     */
    private function getBoard()
    {
        $board = [];
        foreach ($this->matrix as $key => $line) {
            foreach ($line as $k => $row) {
                $board[] = $row;
            }
        }

        return $board;
    }

    /**
     * Decorate end result
     *
     * @return array
     */
    private function decorate()
    {
        $board = $this->getBoard();

        $this->payouts['bet_amount'] = $this->bet;
        $this->payouts['board'] = $board;

        return $this->payouts;
    }

    /**
     * Map the shuffled result(s) into a multidimensional array
     *
     * @return array
     */
    public function spin()
    {
        $this->getPaylines();
        $this->getPayouts();

        return $this->decorate();
    }
}