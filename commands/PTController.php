<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\commands;

use yii\console\Controller;
use Yii;

/**
 * Description of PTController
 *
 * @author shriram
 */
class PTController extends Controller {

    public function actionC() {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $data = [
//            'port' => 22,
            'protocol' => 'ssh',
            'username' => 'infadmin',
            'password' => 'Select@987',
            'log' => TRUE
        ];
        try {
            $net = Yii::$app->net->getTransportObj('192.168.1.1', $data);
            echo "Output:\n\n";
            $ot = $net->collect([ ['name' => 'sh_c1', 'command' => 'show clock'],
                ['name' => 'sh_c', 'command' => 'show run'],
//                ['name' => 'sh_mem', 'command' => 'show mem'],
//                ['name' => 'show ip int bri', 'command' => 'show ip int bri'],
//                ['name' => 'config t1', 'command' => 'config t'],
//                ['name' => 'do show isis neigh', 'command' => 'do show isis neigh'],
//                ['name' => 'end', 'command' => 'end'],
//                ['name' => 'config t2', 'command' => 'config t'],
//                ['name' => 'do show ip int bri', 'command' => 'do show ip int bri'],
//                ['name' => 'exit', 'command' => 'exit'],
//                ['name' => 'show users', 'command' => 'show users'],
                ['name' => 'sh_c2', 'command' => 'show clock']]);
//            print_r($ot);
//            $ot = $net->push("\nshow mem\n");
            file_put_contents('sh_mem.txt', $ot['sh_c']);
            echo "\n" . $ot['sh_c1'] . "\n" . $ot['sh_c2'] . "\n";
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function actionP() {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $data = [
//            'port' => 22,
            'protocol' => 'ssh',
            'username' => 'infadmin',
            'password' => 'Select@987',
            'log' => true
        ];
        try {
            $net = Yii::$app->net->getTransportObj('192.168.1.1', $data);
            echo "Output:\n\n";
            $ot = $net->push("show clock\nshow run\nshow mem\nshow ip int bri\n"
                    . "config t\ndo show isis neigh\nend\nconfig t\ndo show ip int bri\nexit\nshow users"
                    . "\nshow clock\n");
            $flag = $net->tunnel('192.168.33.33', ['username' => 'cisco', 'password' => 'cisco'], 'telnet');
            if ($flag) {
                $ot1 = $net->push("show clock\nshow run\nshow mem\nshow ip int bri\n"
                        . "config t\ndo show isis neigh\nend\nconfig t\ndo show ip int bri\nexit\nshow users"
                        . "\nshow clock\n");
                $ot['output'] .= "\n\n\n##############192.168.33.33##############\n\n\n\n" . $ot1['output'];
                print_r($net->push("exit\nshow ip int bri\nshow clock"));
                print_r($net->push("show ip int bri\nshow clock"));
            }
//            $ot = $net->push("\nshow mem\n");
            file_put_contents('sh_mem.txt', $ot['output']);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

}
