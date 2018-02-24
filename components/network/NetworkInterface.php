<?php

namespace app\components\network;

/**
 *
 * @author ShriRam
 */
interface NetworkInterface {

    public function connect();

    public function collect($commands);

    public function push($commands);

    public function sendCommand($command);
}
