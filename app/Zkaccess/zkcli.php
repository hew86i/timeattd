<?php

namespace App\Zkaccess;

use App\Connected;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Test class for to be event driven
 * real time minitoring using command
 * line interface
 */
class zkcli
{
    private $connected_device;
    private $process;
    private $cmd_path;

    public function construct_command()
    {
        $this->cmd_path = base_path('public') . '\\zk-command-line -cmd:Connect_Net -ip:';
    }

    public function __construct()
    {
        $this->construct_command();

        $this->connected_device = Connected::find(1);
        $this->process = new Process($this->cmd_path . $this->connected_device['ip_address']);
        // dd($this->process);

    }
    /**
     * Parse the output var.
     * @param  string $output general output
     * @return string         true or false as string
     */
    public function parseOutput($output)
    {
        $parsed = explode("||", $output);
        // $parsed[0] will hold only true or false
        return $parsed[0];
    }

    public function run()
    {
        $this->process->run();
        if (!$this->process->isSuccessful()) {
            throw new ProcessFailedException($this->process);
        }
        echo $this->parseOutput($this->process->getOutput());
        // echo $this->process->getOutput();
    }

}
