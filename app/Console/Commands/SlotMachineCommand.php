<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/03/18
 * Time: 14:13
 */

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use App\SlotMachine;
use App\Http\Controllers\SlotMachineController;

/**
 * Class SlotMachineCommand
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class SlotMachineCommand extends Command
{
    private $slotMachine;

    protected $filesystem;

    public function __construct(SlotMachineController $slotMachine)
    {
        parent::__construct();
        $this->slotMachine = $slotMachine;
    }

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "slot-machine:spin";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Spin the slot machine";


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $slotMachine = $this->slotMachine->play();

        } catch (Exception $e) {
            $this->error($e);
        }
    }
}