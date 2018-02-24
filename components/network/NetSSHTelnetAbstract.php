<?php

namespace app\components\network;

use app\components\network\NetworkAbstract;
use app\components\network\NetworkInterface;
use app\components\custom\NamedException;

/**
 * Description of NetSSHTelnetAbstract
 *
 * @author shriram
 */
abstract class NetSSHTelnetAbstract extends NetworkAbstract implements NetworkInterface {

    public $waitTimeOut = 220;
    public $userPromptWait = 15;
    public $pushWaitPerCommand = 3;
    public $defaultPushWaitPerCommand = 3;
    public $minimumPushWait = 160;
    public $preventExit;
    public $currentMode;
    public $start;
    public $jumpedHosts = [];
    public $currentHost;
    public $jumpedHostsStatus = [];
    protected $_commandStart;
    protected $str;
    protected $_limit;
    protected $_hostname;
    protected $_terminalChar;
    protected $terminalChars = ["#", ">", "$"]; // removed "$"
    protected $_terminate = ["% Authentication failed", "timeout expired!", "Connection closed by foreign host.", "Wait timeout reached.", "Login incorrect"];

    protected abstract function login();

    public function resetPushWaitPerCommand() {
        $this->pushWaitPerCommand = $this->defaultPushWaitPerCommand;
    }

    public abstract function connect();

    public function init() {
        try {
            parent::init();
        } catch (NamedException $ex) {
            throw $ex;
        }
    }

    public function collect($commands) {
        $outPut = [];
        try {
            if (!$this->isConnected()) {
                $this->connect();
            }

            if (!$this->isLoggedIn()) {
                $this->login();
            }
            if ($this->isLoggedIn()) {
                if (!is_array($commands)) {
                    $commands = explode("\n", $commands);
                }
                $name = '';
                try {
                    foreach ($commands as $key => $command) {
                        if (is_array($command)) {
                            if (!empty($command['name']) && !empty($command['command'])) {
                                $name = $command['name'];
                                if (!empty($command['waitTimeOut']) && is_numeric($command['waitTimeOut'])) {
                                    $outPut[$command['name']] = $this->fetchOne($command['command'], $command['waitTimeOut']);
                                } else {
                                    $outPut[$command['name']] = $this->fetchOne($command['command']);
                                }
                            }
                        } else {
                            $name = $command;
                            $outPut[$command] = $this->fetchOne($command);
                        }
                    }
                    $outPut['status'] = TRUE;
                } catch (NamedException $ex) {
                    $outPut['reason'] = "Fail : [$name] " . $ex->getMessage();
                }
            } else {
                $outPut['status'] = FALSE;
                $outPut['reason'] = "Fail : Current session is not active.";
            }
        } catch (NamedException $ex) {
            $outPut['status'] = FALSE;
            $outPut['reason'] = "Fail : " . $ex->getMessage();
        }
        return $outPut;
    }

    protected function strRs($str = "", $commandPrefix = '', $waitTimeOut = 0) {
        if ($waitTimeOut == 0) {
            $waitTimeOut = $this->waitTimeOut;
        }
        $this->str = $str;
        $this->_commandStart = microtime(TRUE);
        $strTemp = '';
        $pregreg = '[>#$]\s*' . $commandPrefix . '\s*$';
        while (1) {
            if (preg_match('/' . $pregreg . '/', $strTemp)) {
                if (preg_match('/[\r\n]*(.*?)\(([config|admin]).*\)' . $pregreg . '/', $this->str, $match)) {
                    $this->preventExit = FALSE;
                    $this->currentHost = $match[1];
                    $this->currentMode = 'terminal';
                    if (strpos($match[2], 'admin') !== FALSE) {
                        $this->currentMode = 'admin';
                    }
                    break;
                }
                if (preg_match('/[\r\n]*(.*?)' . $pregreg . '/', $this->str, $match)) {
                    if (in_array($match[1], $this->jumpedHosts)) {
                        if (!empty($this->jumpedHosts[0]) && $match[1] == $this->jumpedHosts[0]) {
                            $this->preventExit = TRUE;
                        } else {
                            $this->preventExit = FALSE;
                        }
                        $this->currentHost = $match[1];
                        $this->currentMode = 'normal';
                        break;
                    }
                }
            }

            if (microtime(true) - $this->_commandStart >= $waitTimeOut) {
                throw new NamedException("Wait timeout reached.");
            }
            $strTemp = stream_get_contents($this->_socket);
            $this->str .= $strTemp;
            $this->log($strTemp);
//            foreach ($this->_terminate as $terminate) {
//                $checkString = substr($str, -1 * strlen($terminate));
//                if (strpos($checkString, $terminate) !== FALSE) {
//                    throw new NamedException($terminate);
//                }
//            }
            if (empty($strTemp)) {
//                sleep(1);
            }
        }
        return $this->str;
    }

    public function tunnel($ip, $credential, $protocol = 'ssh') {
        try {
            if (!$this->isConnected()) {
                $this->connect();
            }

            if (!$this->isLoggedIn()) {
                $this->login();
            }
            if ($this->isLoggedIn()) {
                $isRechable = $this->checkRechability($ip);
                if (!$isRechable) {
                    throw new NamedException("Target is not rechable");
                }
                $str = '';
                $command = $this->getTunnelCommand($protocol, $ip, $credential);
                $callback = '';
                if ($command != FALSE) {
                    $this->log($command . "\n");
                    $this->getCurrentMode();
                    @fwrite($this->_socket, "{$command}\n");
                    while (1) {
                        $strTemp = @stream_get_contents($this->_socket);
                        $str .= $strTemp;
                        $this->log($strTemp);
                        if (preg_match('/[Uu]sername:/', $str)) {
                            @fwrite($this->_socket, $credential['username'] . "\n" . $credential['password'] . "\n");
                            $callback = 'validateUsername';
                            break;
                        }
                        if (preg_match('/[Ll]ogin:/', $str)) {
                            @fwrite($this->_socket, $credential['username'] . "\n" . $credential['password'] . "\n");
                            $callback = 'validateUsername';
                            break;
                        }
                        if (preg_match('/[Pp]assword:/', $str)) {
                            @fwrite($this->_socket, $credential['password'] . "\n");
                            $callback = 'validatePassword';
                            break;
                        }
                        if (preg_match("/[\r\n]*.*?[^>#$][>#$]\\s*$/", $str) || preg_match("/\(([config|admin]).*\)[>#$]\\s*$/", $str)) {
                            return FALSE;
                        }
                    }
                }
                if (method_exists($this, $callback)) {
                    return $this->$callback($credential);
                }
            }
        } catch (NamedException $ex) {
            $this->log($ex->getMessage() . "\n");
//            throw $ex;
        }
        return FALSE;
    }

    public function getCurrentHost() {
        $st = $this->getCurrentMode();
        if ($st != FALSE)
            return $this->currentHost;
        return FALSE;
    }

    protected function validatePassword($credential = []) {
        $pass = TRUE;
        $str = '';
        while (1) {
            $strTemp = @stream_get_contents($this->_socket);
            $this->log($strTemp);
            $str .= $strTemp;
            if (preg_match('/[Pp]assword:/', $str)) {
                @fwrite($this->_socket, chr(3));
                $pass = FALSE;
                $str = '';
            }
            if (preg_match('/%Permission denied/', $str) || preg_match('/closed/', $str)) {
                $pass = FALSE;
                $str = '';
                break;
            }
            if (preg_match('/\(([config|admin]).*\)[>#$]\s*$/', $str)) {
                $pass = FALSE;
                break;
            }
            if (preg_match('/[>#$]\s*$/', $str, $match)) {
                break;
            }
            sleep(1);
        }
        if ($pass) {
            $this->setTerminalChar($credential);
            $pass = $this->currentHost;
        }
        return $pass;
    }

    protected function validateUsername($credential = []) {
        $pass = TRUE;
        while (1) {
            $strTemp = @stream_get_contents($this->_socket);
            $this->log($strTemp);
            if (preg_match('/[Uu]sername:/', $strTemp)) {
                @fwrite($this->_socket, chr(3));
                $strTemp = '';
                $pass = FALSE;
            }
            if (preg_match('/[Ll]ogin:/', $strTemp)) {
                @fwrite($this->_socket, chr(3));
                $strTemp = '';
                $pass = FALSE;
            }
            if (preg_match("/\(([config|admin]).*\)[>#$]\\s*$/", $strTemp)) {
                break;
                $pass = FALSE;
            }
            if (preg_match("/[>#$]\\s*$/", $strTemp)) {
                break;
            }
            sleep(1);
        }
        if ($pass) {
            $this->setTerminalChar($credential);
            $pass = $this->currentHost;
        }
        return $pass;
    }

    public function getCurrentMode() {
        try {
            if (!$this->isConnected()) {
                $this->connect();
            }
            if (!$this->isLoggedIn()) {
                $this->login();
            }
            if ($this->isLoggedIn()) {
                $start = microtime(TRUE);
                $str = '';
                @fwrite($this->_socket, "\n");
                $this->log("Getting current user mode\n");
                $this->strRs('', '', 3);
            }
        } catch (Exception $ex) {
            return FALSE;
        }
        return $this->currentMode;
    }

    protected function getTunnelCommand($protocol, $ip, $credential) {
        try {
            if (!empty($credential['username']) && !empty($credential['password'])) {
                if ($protocol == 'telnet') {
                    return "telnet {$ip}";
                }
//            if ($this->getCurrentMode() == 'terminal') {
//                $output = $this->sendCommand('exit');
//            }
                if ($protocol == 'ssh') {
                    $output = $this->sendCommand('ssh ?');
                    if (preg_match('/-l\s*Log in using this user name/i', $output)) {
                        return "ssh -l {$credential['username']} $ip";
                    }
                    if (preg_match('/A\.B\.C\.D\s*IPv4\s*\(A\.B\.C\.D\)\s*address/i', $output)) {
                        return "ssh {$ip} username {$credential['username']}";
                    }
                    $this->getCurrentMode();
                }
            }
        } catch (NamedException $ex) {
            $this->log($ex->getMessage());
        }
        return FALSE;
    }

    protected function enablePrompt($credential = []) {
        if (!empty($credential['enable_password']) && $this->_terminalChar == '>') {
            @fwrite($this->_socket, "en\n{$credential['enable_password']}\n");
            $str = "";
            $terminalChar = '';
            $this->_commandStart = microtime(TRUE);
            while (1) {
                if (microtime(true) - $this->_commandStart >= $this->waitTimeOut) {
                    @fclose($this->_socket);
                    $this->log("Fail: Wait timeout reached.");
                    throw new NamedException("Fail: Wait timeout reached.");
                }
                $strTemp = @stream_get_contents($this->_socket);
                $this->log($strTemp);
                $str .= $strTemp;
                if (preg_match("/.*?[>#$]\\s*$/m", $str)) {
                    break;
                }
                sleep(2);
            }
            if (strpos($str, '>')) {
                $this->_terminalChar = '>';
            }
            if (strpos($str, '#')) {
                $this->_terminalChar = '#';
            }

            if (strpos($str, '$')) {
                $this->_terminalChar = '$';
            }
        }
    }

    protected function setTerminalChar($credential = []) {
        @fwrite($this->_socket, "\nterminal length 0\n");
        //    @fwrite($this->_socket, "\nset cli screen-length 0\n");
        $str = "";
        $terminalChar = '';
        $start = FALSE;
        $this->_commandStart = microtime(TRUE);
        while (1) {
            if (microtime(true) - $this->_commandStart >= $this->waitTimeOut) {
                @fclose($this->_socket);
                $this->log("Fail: Wait timeout reached.");
                throw new NamedException("Fail: Wait timeout reached.");
            }
            $strTemp = @stream_get_contents($this->_socket);
            $str .= $strTemp;
            $this->log($strTemp);
            if (preg_match('/[>#$]\s*terminal length 0/', $str, $match, PREG_OFFSET_CAPTURE)) {
                $str = substr($str, $match[0][1] + strlen($match[0][0]));
                $start = TRUE;
            }
            if ($start && strpos($str, '#')) {
                $this->_terminalChar = '#';
                break;
            }
            if ($start && strpos($str, '>')) {
                $this->_terminalChar = '>';
                break;
            }
            if ($start && strpos($str, '$')) {
                $this->_terminalChar = '$';
                break;
            }
            if (microtime(true) - $this->_commandStart > 12) {
                $this->log("\nPutting another : terminal length 0\n");
                @fwrite($this->_socket, "\nterminal length 0\n");
            }
            sleep(1);
        }
        $cells = explode("\n", $str);
        $this->_limit = trim(array_pop($cells), " \t\n\r\0\x0B");
        $this->_hostname = substr($this->_limit, 0, strlen($this->_limit) - 1);
        $this->enablePrompt($credential);
        $this->currentHost = $this->_hostname;
        $this->jumpedHostsStatus[$this->_hostname]['hostname'] = $this->_hostname;
        $this->jumpedHostsStatus[$this->_hostname]['terminal_char'] = $this->_terminalChar;
        $this->jumpedHostsStatus[$this->_hostname]['is_enabled'] = $this->_terminalChar == '>' ? FALSE : TRUE;
        $this->jumpedHosts[] = $this->_hostname;
        $this->log("Prompt : $this->_limit\n");
    }

    public function sendCommand($command) {
        $outPut = '';
        try {
            if (!$this->isConnected()) {
                $this->connect();
            }
            if (!$this->isLoggedIn()) {
                $this->login();
            }
            if ($this->isLoggedIn()) {
                $this->log("\nFetching output\n");
                $outPut = $this->fetchOne($command);
            } else {
                $outPut = "Fail : Current session is not active.";
            }
        } catch (NamedException $ex) {
            $outPut = "Fail : " . $ex->getMessage();
        }
        return $outPut;
    }

    protected function fetchOne($command, $waitTimeOut = 0) {
        $str = "";
        if ($waitTimeOut == 0) {
            $waitTimeOut = $this->waitTimeOut;
        }
        try {
            if (!empty($command)) {
                $commandPrefix = '';
                if (substr(trim($command, " \t\n\r\0\x0B"), -1) != '?') {
                    $newline = "\n";
                } else {
                    $commandPrefix = rtrim($command, '?');
                    $commandPrefix = preg_quote($commandPrefix, "/");
                }
                @fwrite($this->_socket, "{$command}{$newline}");
                $str = $this->strRs("", $commandPrefix, $waitTimeOut);
                $command = preg_quote($command, "/");
                $str = preg_replace(["/^{$command}[\r\n]*/", "/[\r\n]*.*?[>#$]\\s*{$commandPrefix}\\s*$/", "/[\r\n]*.*?\(([config|admin]).*?\)[>#$]\\s*{$commandPrefix}\\s*$/"], "", $str);
                $this->log($str);
            }
        } catch (NamedException $ex) {
            throw $ex;
        }
        return $str;
    }

    public function push($commands) {
        $this->_commandStart = microtime(TRUE);
        try {
            if (!$this->isConnected()) {
                $this->connect();
            }

            if (!$this->isLoggedIn()) {
                $this->login();
            }
            if ($this->isLoggedIn()) {
                if (!is_array($commands)) {
                    $commands = explode("\n", $commands);
                }
                $waitTime = $this->calculatePushWaitTime($commands);
                return $this->pushStr($commands, $waitTime);
            } else {
                $outPut['status'] = FALSE;
                $outPut['reason'] = "Fail : Current session is not active.";
            }
        } catch (NamedException $exc) {
            $outPut['status'] = FALSE;
            $outPut['reason'] = $exc->getMessage();
        }
        return $outPut;
    }

    public function pushCopyCommands($commands) {
        $this->_commandStart = microtime(TRUE);
        try {
            if (!$this->isConnected()) {
                $this->connect();
            }

            if (!$this->isLoggedIn()) {
                $this->login();
            }
            if ($this->isLoggedIn()) {
                if (!is_array($commands)) {
                    $commands = explode("\n", $commands);
                }
                if (in_array('exit', $commands)) {
                    throw new NamedException('Exit is not allowed in copy commands');
                }
                foreach ($commands as $command) {
                    @fwrite($this->_socket, $command . "\n");
                }
                $waitTime = $this->calculatePushWaitTime($commands);
                return $this->pushCopyStr($commands, $waitTime);
            } else {
                $outPut['status'] = FALSE;
                $outPut['reason'] = "Fail : Current session is not active.";
            }
        } catch (NamedException $exc) {
            $outPut['status'] = FALSE;
            $outPut['reason'] = $exc->getMessage();
        }
        return $outPut;
    }

    private function pushStrOneByOne($commands, $waitTime) {
        $this->start = microtime(TRUE);
        $str = "";
        $preventExit = FALSE;
        $strFinal = '';
        foreach ($commands as $command) {
            $newline = '';
            $commandPrefix = '';
            if (substr(trim($command, " \t\n\r\0\x0B"), -1) != '?') {
                $newline = "\n";
            } else {
                $commandPrefix = rtrim($command, '?');
            }
            $strFinal .= $str;
            $str = "";
            if ($preventExit && trim($command, " \n\t\r\0\x0B") === 'exit') {
                $this->log("\nPreventing exit\n");
                @fwrite($this->_socket, $command . $newline);
                sleep(2);
                $strFinal .= "exit";
                $this->_isConnected = FALSE;
                $this->_isLoggedIn = FALSE;
                break;
            }
            @fwrite($this->_socket, $command . $newline);
            while (1) {
                if (microtime(true) - $this->start >= $waitTime) {
                    @fclose($this->_socket);
                    $outPut['status'] = FALSE;
                    $outPut['output'] = $strFinal;
                }
                $strTemp = @stream_get_contents($this->_socket);
                $this->log($strTemp);
                $str .= $strTemp;
                if (preg_match("/[\r\n]*(.*?)\(([config|admin]).*\)[>#$]\\s*{$commandPrefix}\\s*$/", $str, $match)) {
                    $this->preventExit = FALSE;
                    $this->currentHost = $match[1];
                    break;
                }
                if (preg_match("/[\r\n]*(.*?)[>#$]\\s*{$commandPrefix}\\s*$/", $str, $match)) {
                    if (in_array($match[1], $this->jumpedHosts)) {
                        if (!empty($this->jumpedHosts[0]) && $match[1] == $this->jumpedHosts[0]) {
                            $this->preventExit = TRUE;
                        } else {
                            $this->preventExit = FALSE;
                        }
                        $this->currentHost = $match[1];
                        break;
                    }
                }
                sleep(0.1);
            }
        }
        $strFinal .= $str;
        $strFinal = $this->_truncate($strFinal);
        $outPut['status'] = TRUE;
        $outPut['output'] = $strFinal;
        return $outPut;
    }

    private function readUptoPushed($waitTime) {
        $strTemp = '';
        while (1) {
            if (microtime(true) - $this->_commandStart >= $waitTime) {
                @fclose($this->_socket);
                $this->_isConnected = FALSE;
                $this->_isLoggedIn = FALSE;
                $this->str = preg_replace('/\s*pushed_successfully\s*/', '', $this->str);
                throw new NamedException("Fail: Wait timeout reached.");
            }
            $strTemp = @stream_get_contents($this->_socket);
            $this->str .= $strTemp;
            $this->log($strTemp);
            if ($strTemp !== '' && strstr($this->str, "pushed_successfully") !== FALSE) {
                if (preg_match('/[\r\n]*(.*?)\(([config|admin]).*?\)[>#$]\s*pushed_successfully/', $this->str, $match)) {
                    $this->preventExit = FALSE;
                    $this->currentHost = $match[1];
                    $this->currentMode = 'terminal';
                    if (strpos($match[2], 'admin') !== FALSE) {
                        $this->currentMode = 'admin';
                    }
                    break;
                }
                if ((preg_match('/[\r\n]*(.*?)[>#$]\s*pushed_successfully/', $this->str, $match))) {
                    if (!empty($this->jumpedHosts[0])) {
                        if ($match[1] == $this->jumpedHosts[0]) {
                            $this->preventExit = TRUE;
                        } else {
                            $this->preventExit = FALSE;
                        }
                    }
                    $this->currentHost = $match[1];
                    $this->currentMode = 'normal';
                    break;
                }
            }
            if (empty($strTemp)) {
//                sleep(0.01);
            }
        }
        $parts = preg_split('/[\r\n]*.*?[>#$]\s*pushed_successfully/', $this->str);
        if (count($parts) == 2) {
            $this->str = preg_replace('/\s*pushed_successfully\s*/', '', $parts[0]);
            $temp = $parts[1];
            while (!(preg_match('/[\r\n]*.*?\(([config|admin]).*?\)[>#$]\s*$/', $temp) || preg_match('/\s*.*?[>#$]\s*/', $temp))) {
                if (microtime(true) - $this->_commandStart >= $waitTime) {
                    @fclose($this->_socket);
                    $this->_isConnected = FALSE;
                    $this->_isLoggedIn = FALSE;
                    throw new NamedException("Fail: Wait timeout reached.");
                }
                $temp = @stream_get_contents($this->_socket);
            }
            if (empty($temp)) {
                sleep(1);
            }
        } else {
            $this->str = preg_replace('/\s*pushed_successfully\s*/', '', $this->str);
        }
    }

    protected function pushCopyStr($waitTime) {
        $this->str = '';
        $this->_commandStart = microtime(TRUE);
        $preventExit = FALSE;
        try {
            $this->strRs('', '', $waitTime);
        } catch (NamedException $ex) {
            @fclose($this->_socket);
            $this->_isConnected = FALSE;
            $this->_isLoggedIn = FALSE;
            $outPut['status'] = FALSE;
            $outPut['reason'] = $ex->getMessage();
            $outPut['output'] = $this->_truncate($this->str);
            return $outPut;
        }
        $outPut['status'] = TRUE;
        $outPut['output'] = $this->_truncate($this->str);
        return $outPut;
    }

    protected function pushStr($commands, $waitTime) {
        $this->str = '';
        $this->_commandStart = microtime(TRUE);
        $str = "";
        $preventExit = FALSE;
        try {
            foreach ($commands as $key => $command) {
                $str = "";
                $comm = trim($command, " \n\t\r\0\x0B");
                if (!(strlen($comm) < 7 && (substr($comm, 0, 2) == 'ex' || substr($comm, 0, 4) == 'relo'))) {
                    @fwrite($this->_socket, $command . "\n");
                } else {
                    @fwrite($this->_socket, "\n\n\npushed_successfully\n");
                    $this->readUptoPushed($waitTime);
//                    stream_set_blocking($this->_socket, TRUE);
                    @fwrite($this->_socket, "$command\n");
                    @fflush($this->_socket);
                    $this->str = $this->_truncate($this->str);
                    if ($this->preventExit) {
                        $this->_isConnected = FALSE;
                        $this->_isLoggedIn = FALSE;
                        sleep(3);
                        if (substr($comm, 0, 2) == 'ex') {
                            $outPut['status'] = TRUE;
                            $outPut['output'] = $this->str . "exit\n";
                            return $outPut;
                        }
                        if (substr($comm, 0, 4) == 'relo') {
                            $length = count($commands);
                            if (($key + 1) < $length) {
                                while (($key + 1) < $length) {
                                    try {
                                        @fwrite($this->_socket, $commands[++$key] . "\n");
                                    } catch (\Exception $ex) {
                                        $this->str = $this->str . "\n" . $ex->getMessage() . "\n";
                                        break;
                                    }
                                }
                            }
                            sleep(4);
                            try {
                                $this->str = $this->str . @stream_get_contents($this->_socket);
                            } catch (\Exception $ex) {
                                $this->str = $this->str . "\n" . $ex->getMessage();
                            }
                            $outPut['status'] = TRUE;
                            $outPut['output'] = $this->str;
                            return $outPut;
                        }
                    } else {
                        stream_set_blocking($this->_socket, FALSE);
                    }
                }
            }
            sleep(2);
            @fwrite($this->_socket, "\n\n\npushed_successfully\n");
            $this->readUptoPushed($waitTime);
        } catch (NamedException $ex) {
            $outPut['status'] = FALSE;
            $outPut['reason'] = $ex->getMessage();
            $outPut['output'] = $this->_truncate($this->str);
            return $outPut;
        }
        $outPut['status'] = TRUE;
        $outPut['output'] = $this->_truncate($this->str);
        return $outPut;
    }

    protected function _truncate($str) {
        $lines = explode("\n", $str);
        $revLines = array_reverse($lines);
        foreach ($revLines as $key => $line) {
            if (preg_match('/[\r\n]*(.*?)[>#$]\s*$/', $line) && !empty($revLines[$key + 1]) && preg_match('/[\r\n]*(.*?)[>#$]\s*$/', $revLines[$key + 1])) {
                array_pop($lines);
            } else {
                break;
            }
        }
        return rtrim(implode("\n", $lines), " \t\n\r\0\x0B");
    }

    public function setBlocking() {
        stream_set_blocking($this->_socket, TRUE);
    }

    public function setUnblocking() {
        stream_set_blocking($this->_socket, FALSE);
    }

    public function write($command) {
        @fwrite($this->_socket, $command);
    }

    public function read() {
        return fread($this->_socket, 1024);
    }

    protected function calculatePushWaitTime($commands = []) {
        $waitTime = count($commands);
        $waitTime = $waitTime * $this->pushWaitPerCommand;
        if ($waitTime < $this->minimumPushWait) {
            $waitTime = $this->minimumPushWait;
        }
        $count = 0;
        foreach ($commands as $command) {
            if (trim($command, " \t\n\r\0\x0B") == 'exit') {
                $count++;
            }
        }
        $waitTime = $waitTime + $count * 5;
        return $waitTime;
    }

}
