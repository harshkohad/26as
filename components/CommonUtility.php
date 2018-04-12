<?php

namespace app\components;

use yii;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Fill;
use yii\base\Component;
use mdm\admin\models\UserDetails;
use app\models\AppSettings;
use app\models\Notifications;
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

    public static function time_elapsed_string($datetime, $full = false) {
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

    public function getCountryDropdown() {
        $countryArray = [
            ['name' => 'Afghanistan', 'value' => 'Afghanistan'],
            ['name' => 'Aland Islands', 'value' => 'Aland Islands'],
            ['name' => 'Albania', 'value' => 'Albania'],
            ['name' => 'Algeria', 'value' => 'Algeria'],
            ['name' => 'American Samoa', 'value' => 'American Samoa'],
            ['name' => 'Andorra', 'value' => 'Andorra'],
            ['name' => 'Angola', 'value' => 'Angola'],
            ['name' => 'Anguilla', 'value' => 'Anguilla'],
            ['name' => 'Antarctica', 'value' => 'Antarctica'],
            ['name' => 'Antigua & Barbuda', 'value' => 'Antigua & Barbuda'],
            ['name' => 'Argentina', 'value' => 'Argentina'],
            ['name' => 'Armenia', 'value' => 'Armenia'],
            ['name' => 'Aruba', 'value' => 'Aruba'],
            ['name' => 'Ascension Island', 'value' => 'Ascension Island'],
            ['name' => 'Australia', 'value' => 'Australia'],
            ['name' => 'Austria', 'value' => 'Austria'],
            ['name' => 'Azerbaijan', 'value' => 'Azerbaijan'],
            ['name' => 'Bahamas', 'value' => 'Bahamas'],
            ['name' => 'Bahrain', 'value' => 'Bahrain'],
            ['name' => 'Bangladesh', 'value' => 'Bangladesh'],
            ['name' => 'Barbados', 'value' => 'Barbados'],
            ['name' => 'Belarus', 'value' => 'Belarus'],
            ['name' => 'Belgium', 'value' => 'Belgium'],
            ['name' => 'Belize', 'value' => 'Belize'],
            ['name' => 'Benin', 'value' => 'Benin'],
            ['name' => 'Bermuda', 'value' => 'Bermuda'],
            ['name' => 'Bhutan', 'value' => 'Bhutan'],
            ['name' => 'Bolivia', 'value' => 'Bolivia'],
            ['name' => 'Bosnia & Herzegovina', 'value' => 'Bosnia & Herzegovina'],
            ['name' => 'Botswana', 'value' => 'Botswana'],
            ['name' => 'Bouvet Island', 'value' => 'Bouvet Island'],
            ['name' => 'Brazil', 'value' => 'Brazil'],
            ['name' => 'British Indian Ocean Territory', 'value' => 'British Indian Ocean Territory'],
            ['name' => 'British Virgin Islands', 'value' => 'British Virgin Islands'],
            ['name' => 'Brunei', 'value' => 'Brunei'],
            ['name' => 'Bulgaria', 'value' => 'Bulgaria'],
            ['name' => 'Burkina Faso', 'value' => 'Burkina Faso'],
            ['name' => 'Burundi', 'value' => 'Burundi'],
            ['name' => 'Cambodia', 'value' => 'Cambodia'],
            ['name' => 'Cameroon', 'value' => 'Cameroon'],
            ['name' => 'Canada', 'value' => 'Canada'],
            ['name' => 'Canary Islands', 'value' => 'Canary Islands'],
            ['name' => 'Cape Verde', 'value' => 'Cape Verde'],
            ['name' => 'Caribbean Netherlands', 'value' => 'Caribbean Netherlands'],
            ['name' => 'Cayman Islands', 'value' => 'Cayman Islands'],
            ['name' => 'Central African Republic', 'value' => 'Central African Republic'],
            ['name' => 'Ceuta & Melilla', 'value' => 'Ceuta & Melilla'],
            ['name' => 'Chad', 'value' => 'Chad'],
            ['name' => 'Chile', 'value' => 'Chile'],
            ['name' => 'China', 'value' => 'China'],
            ['name' => 'Christmas Island', 'value' => 'Christmas Island'],
            ['name' => 'Clipperton Island', 'value' => 'Clipperton Island'],
            ['name' => 'Cocos Islands', 'value' => 'Cocos Islands'],
            ['name' => 'Colombia', 'value' => 'Colombia'],
            ['name' => 'Comoros', 'value' => 'Comoros'],
            ['name' => 'Congo (DRC)', 'value' => 'Congo (DRC)'],
            ['name' => 'Congo (Republic)', 'value' => 'Congo (Republic)'],
            ['name' => 'Cook Islands', 'value' => 'Cook Islands'],
            ['name' => 'Costa Rica', 'value' => 'Costa Rica'],
            ['name' => 'Cote d’Ivoire', 'value' => 'Cote d’Ivoire'],
            ['name' => 'Croatia', 'value' => 'Croatia'],
            ['name' => 'Cuba', 'value' => 'Cuba'],
            ['name' => 'Curacao', 'value' => 'Curacao'],
            ['name' => 'Cyprus', 'value' => 'Cyprus'],
            ['name' => 'Czech Republic', 'value' => 'Czech Republic'],
            ['name' => 'Denmark', 'value' => 'Denmark'],
            ['name' => 'Diego Garcia', 'value' => 'Diego Garcia'],
            ['name' => 'Djibouti', 'value' => 'Djibouti'],
            ['name' => 'Dominica', 'value' => 'Dominica'],
            ['name' => 'Dominican Republic', 'value' => 'Dominican Republic'],
            ['name' => 'Ecuador', 'value' => 'Ecuador'],
            ['name' => 'Egypt', 'value' => 'Egypt'],
            ['name' => 'El Salvador', 'value' => 'El Salvador'],
            ['name' => 'Equatorial Guinea', 'value' => 'Equatorial Guinea'],
            ['name' => 'Eritrea', 'value' => 'Eritrea'],
            ['name' => 'Estonia', 'value' => 'Estonia'],
            ['name' => 'Ethiopia', 'value' => 'Ethiopia'],
            ['name' => 'Falkland Islands', 'value' => 'Falkland Islands'],
            ['name' => 'Faroe Islands', 'value' => 'Faroe Islands'],
            ['name' => 'Fiji', 'value' => 'Fiji'],
            ['name' => 'Finland', 'value' => 'Finland'],
            ['name' => 'France', 'value' => 'France'],
            ['name' => 'French Guiana', 'value' => 'French Guiana'],
            ['name' => 'French Polynesia', 'value' => 'French Polynesia'],
            ['name' => 'French Southern Territories', 'value' => 'French Southern Territories'],
            ['name' => 'Gabon', 'value' => 'Gabon'],
            ['name' => 'Gambia', 'value' => 'Gambia'],
            ['name' => 'Georgia', 'value' => 'Georgia'],
            ['name' => 'Germany', 'value' => 'Germany'],
            ['name' => 'Ghana', 'value' => 'Ghana'],
            ['name' => 'Gibraltar', 'value' => 'Gibraltar'],
            ['name' => 'Greece', 'value' => 'Greece'],
            ['name' => 'Greenland', 'value' => 'Greenland'],
            ['name' => 'Grenada', 'value' => 'Grenada'],
            ['name' => 'Guadeloupe', 'value' => 'Guadeloupe'],
            ['name' => 'Guam', 'value' => 'Guam'],
            ['name' => 'Guatemala', 'value' => 'Guatemala'],
            ['name' => 'Guernsey', 'value' => 'Guernsey'],
            ['name' => 'Guinea', 'value' => 'Guinea'],
            ['name' => 'Guinea-Bissau', 'value' => 'Guinea-Bissau'],
            ['name' => 'Guyana', 'value' => 'Guyana'],
            ['name' => 'Haiti', 'value' => 'Haiti'],
            ['name' => 'Heard & McDonald Islands', 'value' => 'Heard & McDonald Islands'],
            ['name' => 'Honduras', 'value' => 'Honduras'],
            ['name' => 'Hong Kong', 'value' => 'Hong Kong'],
            ['name' => 'Hungary', 'value' => 'Hungary'],
            ['name' => 'Iceland', 'value' => 'Iceland'],
            ['name' => 'India', 'value' => 'India'],
            ['name' => 'Indonesia', 'value' => 'Indonesia'],
            ['name' => 'Iran', 'value' => 'Iran'],
            ['name' => 'Iraq', 'value' => 'Iraq'],
            ['name' => 'Ireland', 'value' => 'Ireland'],
            ['name' => 'Isle of Man', 'value' => 'Isle of Man'],
            ['name' => 'Israel', 'value' => 'Israel'],
            ['name' => 'Italy', 'value' => 'Italy'],
            ['name' => 'Jamaica', 'value' => 'Jamaica'],
            ['name' => 'Japan', 'value' => 'Japan'],
            ['name' => 'Jersey', 'value' => 'Jersey'],
            ['name' => 'Jordan', 'value' => 'Jordan'],
            ['name' => 'Kazakhstan', 'value' => 'Kazakhstan'],
            ['name' => 'Kenya', 'value' => 'Kenya'],
            ['name' => 'Kiribati', 'value' => 'Kiribati'],
            ['name' => 'Kosovo', 'value' => 'Kosovo'],
            ['name' => 'Kuwait', 'value' => 'Kuwait'],
            ['name' => 'Kyrgyzstan', 'value' => 'Kyrgyzstan'],
            ['name' => 'Laos', 'value' => 'Laos'],
            ['name' => 'Latvia', 'value' => 'Latvia'],
            ['name' => 'Lebanon', 'value' => 'Lebanon'],
            ['name' => 'Lesotho', 'value' => 'Lesotho'],
            ['name' => 'Liberia', 'value' => 'Liberia'],
            ['name' => 'Libya', 'value' => 'Libya'],
            ['name' => 'Liechtenstein', 'value' => 'Liechtenstein'],
            ['name' => 'Lithuania', 'value' => 'Lithuania'],
            ['name' => 'Luxembourg', 'value' => 'Luxembourg'],
            ['name' => 'Macau', 'value' => 'Macau'],
            ['name' => 'Macedonia', 'value' => 'Macedonia'],
            ['name' => 'Madagascar', 'value' => 'Madagascar'],
            ['name' => 'Malawi', 'value' => 'Malawi'],
            ['name' => 'Malaysia', 'value' => 'Malaysia'],
            ['name' => 'Maldives', 'value' => 'Maldives'],
            ['name' => 'Mali', 'value' => 'Mali'],
            ['name' => 'Malta', 'value' => 'Malta'],
            ['name' => 'Marshall Islands', 'value' => 'Marshall Islands'],
            ['name' => 'Martinique', 'value' => 'Martinique'],
            ['name' => 'Mauritania', 'value' => 'Mauritania'],
            ['name' => 'Mauritius', 'value' => 'Mauritius'],
            ['name' => 'Mayotte', 'value' => 'Mayotte'],
            ['name' => 'Mexico', 'value' => 'Mexico'],
            ['name' => 'Micronesia', 'value' => 'Micronesia'],
            ['name' => 'Moldova', 'value' => 'Moldova'],
            ['name' => 'Monaco', 'value' => 'Monaco'],
            ['name' => 'Mongolia', 'value' => 'Mongolia'],
            ['name' => 'Montenegro', 'value' => 'Montenegro'],
            ['name' => 'Montserrat', 'value' => 'Montserrat'],
            ['name' => 'Morocco', 'value' => 'Morocco'],
            ['name' => 'Mozambique', 'value' => 'Mozambique'],
            ['name' => 'Myanmar', 'value' => 'Myanmar'],
            ['name' => 'Namibia', 'value' => 'Namibia'],
            ['name' => 'Nauru', 'value' => 'Nauru'],
            ['name' => 'Nepal', 'value' => 'Nepal'],
            ['name' => 'Netherlands', 'value' => 'Netherlands'],
            ['name' => 'New Caledonia', 'value' => 'New Caledonia'],
            ['name' => 'New Zealand', 'value' => 'New Zealand'],
            ['name' => 'Nicaragua', 'value' => 'Nicaragua'],
            ['name' => 'Niger', 'value' => 'Niger'],
            ['name' => 'Nigeria', 'value' => 'Nigeria'],
            ['name' => 'Niue', 'value' => 'Niue'],
            ['name' => 'Norfolk Island', 'value' => 'Norfolk Island'],
            ['name' => 'Northern Mariana Islands', 'value' => 'Northern Mariana Islands'],
            ['name' => 'North Korea', 'value' => 'North Korea'],
            ['name' => 'Norway', 'value' => 'Norway'],
            ['name' => 'Oman', 'value' => 'Oman'],
            ['name' => 'Pakistan', 'value' => 'Pakistan'],
            ['name' => 'Palau', 'value' => 'Palau'],
            ['name' => 'Palestine', 'value' => 'Palestine'],
            ['name' => 'Panama', 'value' => 'Panama'],
            ['name' => 'Papua New Guinea', 'value' => 'Papua New Guinea'],
            ['name' => 'Paraguay', 'value' => 'Paraguay'],
            ['name' => 'Peru', 'value' => 'Peru'],
            ['name' => 'Philippines', 'value' => 'Philippines'],
            ['name' => 'Pitcairn Islands', 'value' => 'Pitcairn Islands'],
            ['name' => 'Poland', 'value' => 'Poland'],
            ['name' => 'Portugal', 'value' => 'Portugal'],
            ['name' => 'Puerto Rico', 'value' => 'Puerto Rico'],
            ['name' => 'Qatar', 'value' => 'Qatar'],
            ['name' => 'Reunion', 'value' => 'Reunion'],
            ['name' => 'Romania', 'value' => 'Romania'],
            ['name' => 'Russia', 'value' => 'Russia'],
            ['name' => 'Rwanda', 'value' => 'Rwanda'],
            ['name' => 'Samoa', 'value' => 'Samoa'],
            ['name' => 'San Marino', 'value' => 'San Marino'],
            ['name' => 'Sao Tome & Principe', 'value' => 'Sao Tome & Principe'],
            ['name' => 'Saudi Arabia', 'value' => 'Saudi Arabia'],
            ['name' => 'Senegal', 'value' => 'Senegal'],
            ['name' => 'Serbia', 'value' => 'Serbia'],
            ['name' => 'Seychelles', 'value' => 'Seychelles'],
            ['name' => 'Sierra Leone', 'value' => 'Sierra Leone'],
            ['name' => 'Singapore', 'value' => 'Singapore'],
            ['name' => 'Sint Maarten', 'value' => 'Sint Maarten'],
            ['name' => 'Slovakia (Slovensko)', 'value' => 'Slovakia (Slovensko)'],
            ['name' => 'Slovenia (Slovenija)', 'value' => 'Slovenia (Slovenija)'],
            ['name' => 'Solomon Islands', 'value' => 'Solomon Islands'],
            ['name' => 'Somalia', 'value' => 'Somalia'],
            ['name' => 'South Africa', 'value' => 'South Africa'],
            ['name' => 'South Georgia & South Sandwich Islands', 'value' => 'South Georgia & South Sandwich Islands'],
            ['name' => 'South Korea', 'value' => 'South Korea'],
            ['name' => 'South Sudan', 'value' => 'South Sudan'],
            ['name' => 'Spain', 'value' => 'Spain'],
            ['name' => 'Sri Lanka', 'value' => 'Sri Lanka'],
            ['name' => 'St. Barthelemy', 'value' => 'St. Barthelemy'],
            ['name' => 'St. Helena', 'value' => 'St. Helena'],
            ['name' => 'St. Kitts & Nevis', 'value' => 'St. Kitts & Nevis'],
            ['name' => 'St. Lucia', 'value' => 'St. Lucia'],
            ['name' => 'St. Martin', 'value' => 'St. Martin'],
            ['name' => 'St. Pierre & Miquelon', 'value' => 'St. Pierre & Miquelon'],
            ['name' => 'St. Vincent & Grenadines', 'value' => 'St. Vincent & Grenadines'],
            ['name' => 'Sudan', 'value' => 'Sudan'],
            ['name' => 'Suriname', 'value' => 'Suriname'],
            ['name' => 'Svalbard & Jan Mayen', 'value' => 'Svalbard & Jan Mayen'],
            ['name' => 'Swaziland', 'value' => 'Swaziland'],
            ['name' => 'Sweden', 'value' => 'Sweden'],
            ['name' => 'Switzerland', 'value' => 'Switzerland'],
            ['name' => 'Syria', 'value' => 'Syria'],
            ['name' => 'Taiwan', 'value' => 'Taiwan'],
            ['name' => 'Tajikistan', 'value' => 'Tajikistan'],
            ['name' => 'Tanzania', 'value' => 'Tanzania'],
            ['name' => 'Thailand', 'value' => 'Thailand'],
            ['name' => 'Timor-Leste', 'value' => 'Timor-Leste'],
            ['name' => 'Togo', 'value' => 'Togo'],
            ['name' => 'Tokelau', 'value' => 'Tokelau'],
            ['name' => 'Tonga', 'value' => 'Tonga'],
            ['name' => 'Trinidad & Tobago', 'value' => 'Trinidad & Tobago'],
            ['name' => 'Tristan da Cunha', 'value' => 'Tristan da Cunha'],
            ['name' => 'Tunisia', 'value' => 'Tunisia'],
            ['name' => 'Turkey', 'value' => 'Turkey'],
            ['name' => 'Turkmenistan', 'value' => 'Turkmenistan'],
            ['name' => 'Turks & Caicos Islands', 'value' => 'Turks & Caicos Islands'],
            ['name' => 'Tuvalu', 'value' => 'Tuvalu'],
            ['name' => 'U.S. Outlying Islands', 'value' => 'U.S. Outlying Islands'],
            ['name' => 'U.S. Virgin Islands', 'value' => 'U.S. Virgin Islands'],
            ['name' => 'Uganda', 'value' => 'Uganda'],
            ['name' => 'Ukraine', 'value' => 'Ukraine'],
            ['name' => 'United Arab Emirates', 'value' => 'United Arab Emirates'],
            ['name' => 'United Kingdom', 'value' => 'United Kingdom'],
            ['name' => 'United States', 'value' => 'United States'],
            ['name' => 'Uruguay', 'value' => 'Uruguay'],
            ['name' => 'Uzbekistan', 'value' => 'Uzbekistan'],
            ['name' => 'Vanuatu', 'value' => 'Vanuatu'],
            ['name' => 'Vatican City', 'value' => 'Vatican City'],
            ['name' => 'Venezuela', 'value' => 'Venezuela'],
            ['name' => 'Vietnam', 'value' => 'Vietnam'],
            ['name' => 'Wallis & Futuna', 'value' => 'Wallis & Futuna'],
            ['name' => 'Western Sahara', 'value' => 'Western Sahara'],
            ['name' => 'Yemen', 'value' => 'Yemen'],
            ['name' => 'Zambia', 'value' => 'Zambia'],
            ['name' => 'Zimbabwe', 'value' => 'Zimbabwe'],
        ];
        return \yii\helpers\ArrayHelper::map($countryArray, 'name', 'value');
    }

    public static function getNotifications() {
        $user_id = Yii::$app->user->getId();
        $notifications = Notifications::find()->where(['user_id' => $user_id, 'is_unread' => 1, 'type' => 0])->all();

        $return_data = '';

        $count = count($notifications);
        $return_data .= '<a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-bell-o"></i>
                <span class="badge bg-warning">' . $count . '</span>
            </a>';
        $return_data .= '<ul class="dropdown-menu extended inbox notifications">
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

        $return_data .= '<li><a href="#">See all notifications</a></li>';

        $return_data .= '</ul>';

        return $return_data;
    }

    public static function getAlerts() {
        $user_id = Yii::$app->user->getId();
        $alerts = Notifications::find()->where(['user_id' => $user_id, 'is_unread' => 1, 'type' => 1])->all();
        $return_data = '';
        $count = count($alerts);
        $return_data .= '<a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-exclamation-triangle"></i>
                <span class="badge bg-success">' . $count . '</span>
            </a>';
        $return_data .= '<ul class="dropdown-menu extended inbox alerts">
                <li>
                    <p>Alerts</p>
                </li>';
        if (!empty($alerts)) {
            foreach ($alerts as $alert_data) {
                $return_data .= '<li>
                    <a href="#">                        
                        <span class="subject">
                            <span class="from">' . self::getCreatedByNameById($alert_data['created_by']) . '</span>
                            <span class="time">' . self::time_elapsed_string($alert_data['notification_created_at']) . '</span>
                        </span>
                        <span class="message">
                            ' . $alert_data['message'] . '
                        </span>
                    </a>
                </li>';
            }
        }
        $return_data .= '<li><a href="#">See all alerts</a></li>';

        $return_data .= '</ul>';

        return $return_data;
    }

}
