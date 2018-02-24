<?php

namespace app\components\network;

use app\components\network;
use app\components\custom\NamedException;

/**
 * Description of NetSSH
 *
 * @author ShriRam
 */
class NetSSH extends network\NetSSHTelnetAbstract {

    private $_con;
    public $port = 22;

    protected function login() {
        try {
            if (!$this->isConnected()) {
                $this->connect();
            }
            if ($this->isConnected() && !$this->isLoggedIn()) {
                if (!empty($this->getPassword()) && !empty($this->getUsername())) {
                    $this->log("Using : " . $this->getUsername() . "\n");
                    if (@ssh2_auth_password($this->_socket, $this->getUsername(), $this->getPassword())) {
                        if (!($this->_socket = @ssh2_shell($this->_socket, "xterm"))) {
                            @fclose($this->_socket);
                            $this->log("Fail: Shell stdio");
                            throw new NamedException("fail: Shell stdio");
                        } else {
                            $credential = [];
                            if (!empty($this->getEnable_password())) {
                                $credential['enable_password'] = $this->getEnable_password();
                            }
                            $this->setTerminalChar($credential);
                            return $this->_isLoggedIn = TRUE;
                        }
                    } else {
                        $this->log("Fail: Authentication failed");
                        $this->throwException("AuthenticationFailed", "Fail: Authentication failed");
                    }
                } else {
                    throw new NamedException("Fail : No Device Credentials Are Available.");
                }
            }
        } catch (NamedException $ex) {
            throw $ex;
        }
        return $this->_isLoggedIn;
    }

    public function connect() {
        try {
            $ip = $this->getHost();
            $port = $this->getPort();
            if (empty($port)) {
                $port = 22;
            }
            $this->log("Connecting {$ip}....\n");
//            if ($this->isRechable()) {
            if (!($this->_socket = @ssh2_connect($ip, $port))) {
                $this->_isConnected = FALSE;
                $this->log("Fail: unable to establish connection");
                $this->throwException("CanNotConnect", "Fail: unable to establish connection");
            } else {
                $this->_isLoggedIn = FALSE;
                $this->log("Connection established\n");
                $this->_isConnected = TRUE;
                $this->start = microtime(TRUE);
                $this->login();
                return TRUE;
            }
//            } else {
//                $this->_isConnected = FALSE;
//                $this->_isLoggedIn = FALSE;
//                throw new NamedException("Fail : Device is not rechable.");
//                return "Fail : Device is not rechable.";
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
        if (!empty($this->_con))
            @fclose($this->_con);
    }

    public function __destruct() {
        $this->close();
    }

    public function isConnected() {
        if ($this->_isConnected) {
//            $metaData = stream_get_meta_data($this->_con);
//            if (empty($metaData['timed_out'])) {
            return TRUE;
//            }
//            else {
//                $metaData = stream_get_meta_data($this->_con);
//                if (empty($metaData['timed_out'])) {
//                    return TRUE;
//                }
//            }
        }
        return FALSE;
    }

    public function init() {
        try {
            parent::init();
        } catch (NamedException $ex) {
            throw $ex;
        }
    }

}
