<?php

namespace app\components\network;

use app\components\network;
use app\components\custom\NamedException;

/**
 * Description of Telnet
 *
 * @author ShriRam
 */
class NetTelnet extends network\NetSSHTelnetAbstract {

    public $port = 23;

    protected function login() {
        try {
            if (!$this->isConnected()) {
                $this->connect();
            }
            if ($this->isConnected() && !$this->isLoggedIn() && ($prompt = $this->getUserPrompt($this->userPromptWait)) !== FALSE) {
                if (!empty($this->getPassword()) && !empty($this->getUsername())) {
                    $this->log("Applying User : {$this->getUsername()}\n");
                    if ($prompt === 'user') {
                        fwrite($this->_socket, "{$this->getUsername()}\r\n{$this->getPassword()}\r\n");
                    } else {
                        fwrite($this->_socket, "{$this->getPassword()}\r\n");
                    }
                    $str = $this->_validateLogin("");
                    if (in_array($str, $this->_terminate)) {
                        @fclose($this->_socket);
                        throw new NamedException("Fail : " . $str);
                    }
                    $credential = [];
                    if (!empty($this->getEnable_password())) {
                        $credential['enable_password'] = $this->getEnable_password();
                    }
                    $this->setTerminalChar($credential);
                } else {
                    throw new NamedException("Fail : No Device Credentials Are Available.");
                }
            } else {
                if (!$this->_isLoggedIn) {
                    return "Fail : User promt not found.";
                    throw new NamedException("Fail : User promt not found.");
                }
            }
        } catch (NamedException $ex) {
            throw $ex;
        }
        return $this->_isLoggedIn = TRUE;
    }

    public function connect() {
        try {
            $this->_commandStart = microtime(TRUE);
            $ip = $this->getHost();
            $port = $this->getPort();
            if (empty($port)) {
                $port = 23;
            }
//            if ($this->isRechable()) {
            if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                $this->_socket = @stream_socket_client("tcp://[{$ip}]:{$port}", $errno, $errorMessage, 2);
            } else {
                $this->_socket = @stream_socket_client("tcp://{$ip}:{$port}", $errno, $errorMessage, 2);
            }
            if ($this->_socket === FALSE) {
                $this->_isConnected = FALSE;
                $this->throwException("CanNotConnect", "Fail : Unable to connect [ $errorMessage ]");
            } else {
                $this->_isLoggedIn = FALSE;
                $this->_isConnected = TRUE;
                $this->start = microtime(TRUE);
                stream_set_blocking($this->_socket, FALSE);
                if ($this->login()) {
                    return TRUE;
                }
            }
//            } else {
//                $this->_isConnected = FALSE;
//                $this->_isLoggedIn = FALSE;
//                throw new NamedException("Fail : Device is not rechable.");
//            }
        } catch (NamedException $ex) {
            throw $ex;
        }
    }

    public function close() {
        if (!empty($this->_socket)) {
            @fwrite($this->_socket, "exit\n");
            @fclose($this->_socket);
        }
    }

    public function __destruct() {
        $this->close();
    }

    private function _validateLogin($str = "") {
        try {
            $this->_commandStart = microtime(TRUE);
            while (!in_array(substr($str, -1), $this->terminalChars)) {
                if (microtime(true) - $this->_commandStart >= $this->waitTimeOut) {
                    throw new NamedException("Wait timeout reached.");
                }
                while ($ch = fgetc($this->_socket)) {
                    $str .= $ch;
                    $this->log($ch);
                    $checkString = substr($str, -34);
                    if (preg_match('/[Uu]sername:/', $str) || preg_match('/[Ll]ogin:/', $str) || (preg_match('/[Pp]assword:/', $str) && !preg_match("/" . $this->getUsername() . "\\s+[Pp]assword:/", $str))) {
                        $this->throwException("AuthenticationFailed", "% Authentication failed");
                    }
                    foreach ($this->_terminate as $terminate) {
                        $checkString = substr($str, -1 * strlen($terminate));
                        if (strpos($checkString, $terminate) !== FALSE) {
                            throw new NamedException($terminate);
                        }
                    }
                    if (in_array($ch, $this->terminalChars)) {
                        break;
                    }
                }
                if ($ch == '0') {
                    $this->log($ch);
                    $str .= $ch;
                }
            }
            return $str;
        } catch (NamedException $exc) {
            throw $exc;
        }
    }

    private function getUserPrompt() {
        $str = '';
        while (!(preg_match('/[Uu]sername:/', $str) || preg_match('/[Ll]ogin:/', $str) || preg_match('/[Pp]assword:/', $str))) {
            if (microtime(true) - $this->_commandStart >= $this->userPromptWait) {
                return FALSE;
            }
            while ($ch = fgetc($this->_socket)) {
                $str .= $ch;
                $this->log($ch);
                if (preg_match('/[Uu]sername:/', $str) || preg_match('/[Ll]ogin:/', $str) || preg_match('/[Pp]assword:/', $str)) {
                    break;
                }
            }
            if ($ch == '0') {
                $str .= $ch;
                $this->log($ch);
            }
        }
        if (preg_match('/[Uu]sername:/', $str) || preg_match('/[Ll]ogin:/', $str)) {
            return 'user';
        } else {
            return 'password';
        }
    }

    public function init() {
        try {
            parent::init();
        } catch (NamedException $ex) {
            throw $ex;
        }
    }

}
