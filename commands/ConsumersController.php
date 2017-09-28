<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

/**
 * ConsumersController - Manage consumers
 *
 * @author pratik
 */
class ConsumersController extends Controller {

    /**
     * Auto start consumers
     */
    public function actionAutoStart() {
        $consumers = Yii::$app->params['consumers'];
        $basePath = Yii::$app->getBasePath();
        foreach ($consumers as $consumer) {
            $command = $consumer['command'];
            $limit = $consumer['limit'];
            $output = array();
            $execCmd = "php -f " . $basePath . DIRECTORY_SEPARATOR . "yii " . $command . " >> /var/log/consumers.log 2>&1 &";
            @exec("ps aux | grep '{$command}' | wc -l", $output);
            $runningCount = (int) $output[0] - 2;
            if ($runningCount < $limit) {
                for ($i = (int) $runningCount; $i < $limit; $i++) {
                    print "\nStarting worker: \n" . $execCmd;
                    @exec($execCmd);
                }
            }
        }
    }

}
