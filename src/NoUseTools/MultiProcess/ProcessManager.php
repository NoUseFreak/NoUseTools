<?php
/**
 * This file is part of the NoUseTools package.
 *
 * (c) Dries De Peuter <dries@nousefreak.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NoUseTools\MultiProcess;

class ProcessManager implements \Countable
{
    protected $processes = array();
    protected $isChild = false;

    public function __construct()
    {
        pcntl_signal(SIGTERM, array($this, 'signalHandler'));
        pcntl_signal(SIGINT, array($this, 'signalHandler'));
        pcntl_signal(SIGCHLD, array($this, 'signalHandler'));
    }

    public function count()
    {
        return count($this->processes);
    }

    public function signalHandler($signal)
    {
        // Don't do anything if we're not in the parent process
        if ($this->isChild) {
            return;
        }

        switch ($signal) {
            case SIGINT:
            case SIGTERM:
                echo "\nUser terminated the application\n";
                // Kill all child processes before terminating the parent
                $this->killAll();
                exit(0);
            case SIGCHLD:
                // Reap a child process
                $this->reapChild();
        }
    }

    public function killAll()
    {
        foreach ($this->processes as $pid => $is_running) {
            posix_kill($pid, SIGKILL);
        }
    }

    public function forkChild($callback, $data)
    {
        $pid = pcntl_fork();
        switch ($pid) {
            case 0:
                // Child process
                $this->isChild = true;
                call_user_func_array($callback, $data);
                posix_kill(posix_getppid(), SIGCHLD);
                exit;
            case -1:
                // Parent process, fork failed
                throw new \Exception("Out of memory!");
            default:
                // Parent process, fork succeeded
                $this->processes[$pid] = true;
                return $pid;
        }
    }

    public function reapChild()
    {
        // Check if any child process has terminated,
        // and if so remove it from memory
        $pid = pcntl_wait($status, WNOHANG);
        if ($pid < 0) {
            throw new \Exception("Out of memory");
        }
        elseif ($pid > 0) {
            unset($this->processes[$pid]);
        }
    }
}
