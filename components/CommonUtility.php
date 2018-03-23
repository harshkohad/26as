<?php

namespace app\components;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Fill;
use yii\base\Component;
use mdm\admin\models\UserDetails;
use app\models\AppSettings;
use app\models\Notifications;
use yii;
use mdm\admin\components\Helper;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CommonUtility extends Component {

    /**
     * 
     * @param type $header
     * @param type $data
     * @param type $fileName
     * Use for Download data in CSV Format
     * Developer: Mahesh Solanki
     */
    public static function downloadDataInCSV($header = array(), $data = array(), $fileName = 'datafile') {
        ob_get_clean();
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename={$fileName}.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        $file = fopen('php://output', 'w');
        fputcsv($file, $header);
        foreach ($data as $row) {
            fputcsv($file, $row);
        }
        $file = fopen('php://output', 'w');
        exit();
    }

    /**
     * Generate and download excel
     * 
     * @param type $header
     * @param type $arraydata
     * @param string $options
     */
    public static function downloadExcel($header, $arraydata, $options = []) {
        $type = 'Excel5';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        if (!empty($options['creator'])) {
            $objPHPExcel->getProperties()->setCreator($options['creator']);
        }
        if (!empty($options['type'])) {
            $type = $options['type'];
        }
        if (!empty($options['title'])) {
            $objPHPExcel->getActiveSheet()->setTitle($options['title']);
        }
        if (!empty($header)) {
            $cell_name = 'A';
            foreach ($header as $headerName) {
                $prev_cell_name = $cell_name;
                $objPHPExcel->getActiveSheet()->SetCellValue($cell_name . '1', $headerName);
                $cell_name++;
            }
            if (!empty($options['col_bg_color'])) {
                $objPHPExcel->getActiveSheet()->getStyle('A1:' . $prev_cell_name . '1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB($options['col_bg_color']);
            }
            if (!empty($options['col_font_bold'])) {
                $objPHPExcel->getActiveSheet()->getStyle('A1:' . $prev_cell_name . '1')->getFont()->setBold(true);
            }
        }
        $rowNo = 1;
        if (!empty($arraydata)) {
            foreach ($arraydata as $data) {
                $cell_name = 'A';
                $rowNo++;
                foreach ($data as $key => $value) {
                    $objPHPExcel->getActiveSheet()->SetCellValue($cell_name . $rowNo, $value);
                    $cell_name++;
                }
            }
        }
        if (empty($options['filename'])) {
            $fileName = 'File_' . date("Y-m-d") . '.xls';
        } else {
            $fileName = $options['filename'];
        }
        ob_get_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $type);
        $objWriter->save('php://output');
        exit(0);
    }

    /**
     * 
     * @param type $dst
     * @param type $mode
     * @param type $recursive
     * Use for Create Directory if its not Exist
     * Developer: Mahesh Solanki
     */
    public static function createDirectory($dst, $mode = null, $recursive = false) {
        if ($mode === null)
            $mode = 0777;
        $prevDir = dirname($dst);
        if ($recursive && !is_dir($dst) && !is_dir($prevDir))
            self::createDirectory(dirname($dst), $mode, true);
        $res = mkdir($dst, $mode);
        @chmod($dst, $mode);
        return $res;
    }

    /**
     * Convert HTML to Text
     * 
     * @param string $html
     * @param string $encoding
     * @return string
     */
    public static function convertHtmlToText($html, $encoding = 'UTF-8') {
        $html = str_replace("&nbsp;", "[[SPACE]]", $html);
        $textContent = strip_tags($html);
        $textContent = array_map('trim', explode("\n", $textContent));
        $textContent = str_replace("[[SPACE]]", chr(32), $textContent);
        $textContent = implode("\n", $textContent);
        $textContent = html_entity_decode($textContent, ENT_QUOTES, $encoding);
        return $textContent;
    }

    public function getCreaterDropdown($tabelName = '') {
        $output = [];
        if ($tabelName == 'tbl_integration_master') {
            $output = UserDetails::find()->select("CONCAT(`first_name` ,space(1), `last_name`) AS first_name, `user_id`")->join("INNER JOIN", "{$tabelName} as e ON (`user_id` = e.integrated_by)")->groupBy(['integrated_by'])->all();
            if (!empty($output)) {
                return \yii\helpers\ArrayHelper::map($output, 'user_id', 'first_name');
            }
            return \yii\helpers\ArrayHelper::map($output, null, null);
        }
        $output = UserDetails::find()->select("CONCAT(`first_name` ,space(1), `last_name`) AS first_name, `user_id`")->join("INNER JOIN", "{$tabelName} as e ON (`user_id` = e.created_by)")->groupBy(['created_by'])->all();
        if (!empty($output)) {
            return \yii\helpers\ArrayHelper::map($output, 'user_id', 'first_name');
        }
        return \yii\helpers\ArrayHelper::map($output, null, null);
    }

    public static function getCreatedByName($model, $attribute = 'created_by') {
        if (property_exists($model, $attribute)) {
            $outout = UserDetails::find()->where(['user_id' => $model->{$attribute}])->one();
            if (!empty($outout)) {
                return $outout->first_name . " " . $outout->last_name;
            }
            return NULL;
        }
        return null;
    }

    public static function getCreatedByNameById($user_id) {
        $outout = UserDetails::find()->where(['user_id' => $user_id])->one();
        if (!empty($outout)) {
            return $outout->first_name . " " . $outout->last_name;
        }
        return NULL;
    }

    // Top menu and left menu hide
    public static function validateUserRoutes($route = NULL) {
        if (!empty($route) && Helper::checkRoute($route)) {
            return TRUE;
        }
        return FALSE;
    }

    public static function validateUserRole($route = NULL) {
        if (!empty($route) && Helper::checkRoute($route)) {
            return TRUE;
        }
        return FALSE;
    }

    public static function checkAuditMode() {
        $where_cond = ['is_deleted' => 0];

        $AppSettings = AppSettings::findOne(1);

        $is_audit_mode = $AppSettings->audit_mode;

        if ($is_audit_mode) {
            $where_cond = "'is_deleted' = 0 AND 'created_on' >= now()-interval $AppSettings->show_period month";
        }

        return $where_cond;
    }

    function time_elapsed_string($datetime, $full = false) {
        $now = new \DateTime;
        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full)
            $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public static function getNotifications() {
        $user_id = Yii::$app->user->getId();
        $notifications = Notifications::find()->where(['user_id' => $user_id])->all();

        $return_data = '';

        $count = count($notifications);
        $return_data .= '<a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-bell-o"></i>
                <span class="badge bg-warning">' . $count . '</span>
            </a>';
        $return_data .= '<ul class="dropdown-menu extended inbox">
                <li>
                    <p>Notifications</p>
                </li>';

        if (!empty($notifications)) {
            foreach ($notifications as $notification_data) {
                $return_data .= '<li>
                    <a href="#">                        
                        <span class="subject">
                            <span class="from">' . self::getCreatedByNameById($notification_data['created_by']) . '</span>
                            <span class="time">' . self::time_elapsed_string($notification_data['notification_created_at']) . '</span>
                        </span>
                        <span class="message">
                            ' . $notification_data['message'] . '
                        </span>
                    </a>
                </li>';
            }
        }

        $return_data .= '</ul>';

        return $return_data;
    }

}
