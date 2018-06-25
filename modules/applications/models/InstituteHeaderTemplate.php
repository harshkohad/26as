<?php

namespace app\modules\applications\models;

use yii\data\ActiveDataProvider;
use Yii;
use yii\bootstrap\Html;
use yii\helpers\Url;
use PHPExcel_Style_Fill;

/**
 * This is the model class for table "tbl_institute_header_template".
 *
 * @property integer $id
 * @property string $header
 * @property string $fields
 * @property string $final_fields
 * @property string $created_at
 * @property integer $created_by
 * @property integer $institute_id
 */
class InstituteHeaderTemplate extends \yii\db\ActiveRecord {

    public $name = '';
    public $view = '';
    public $start_date = '';
    public $end_date = '';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_institute_header_template';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['fields', 'final_fields'], 'string'],
            [['created_at'], 'safe'],
            [['institute_id'], 'required'],
            [['created_by', 'institute_id'], 'integer'],
            [['header'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'header' => 'Header',
            'fields' => 'Fields',
            'final_fields' => 'Final Fields',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'institute_id' => 'Institute ID',
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search() {
        $query = InstituteHeaderTemplate::find();

        $query->join('INNER JOIN', 'tbl_institutes', 'tbl_institutes.id=tbl_institute_header_template.institute_id');
        $query->select(['tbl_institutes.name', 'institute_id']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'institute_id' => $this->institute_id
        ]);
        return $dataProvider;
    }

    public function getJsonInput() {
        $sql = "SELECT column_name FROM `information_schema`.`columns` where table_name='tbl_applications' AND column_name NOT IN('id','application_id','created_by','created_on','update_by','updated_on')
                union SELECT column_name FROM `information_schema`.`columns` where table_name='tbl_applications_busi' AND column_name NOT IN('id','application_id','created_by','created_on','update_by','updated_on')
                union SELECT column_name FROM `information_schema`.`columns` where table_name='tbl_applications_resi' AND column_name NOT IN('id','application_id','created_by','created_on','update_by','updated_on')
                union SELECT column_name FROM `information_schema`.`columns` where table_name='tbl_applications_office' AND column_name NOT IN('id','application_id','created_by','created_on','update_by','updated_on')
                union SELECT column_name FROM `information_schema`.`columns` where table_name='tbl_applications_resi_office' AND column_name NOT IN('id','application_id','created_by','created_on','update_by','updated_on')
                union SELECT column_name FROM `information_schema`.`columns` where table_name='tbl_applications_indiv_property' AND column_name NOT IN('id','application_id','created_by','created_on','update_by','updated_on')
                union SELECT column_name FROM `information_schema`.`columns` where table_name='tbl_applications_noc_busi' AND column_name NOT IN('id','application_id','created_by','created_on','update_by','updated_on')
                union SELECT column_name FROM `information_schema`.`columns` where table_name='tbl_applications_noc_soc' AND column_name NOT IN('id','application_id','created_by','created_on','update_by','updated_on')
                union SELECT column_name FROM `information_schema`.`columns` where table_name='tbl_applications_property_apf' AND column_name NOT IN('id','application_id','created_by','created_on','update_by','updated_on')
                union SELECT column_name FROM `information_schema`.`columns` where table_name='tbl_applications_builder_profile' AND column_name NOT IN('id','application_id','created_by','created_on','update_by','updated_on');";
        $results = Yii::$app->db->createCommand($sql)->queryAll();
        $data = array();
        $ignoreArray = array('id', 'application_id', 'profile_id', 'created_by', 'created_on', 'updated_by', 'updated_on', 'is_deleted');
        foreach ($results as $key => $value) {
            if (!in_array($value['column_name'], $ignoreArray))
                $data[] = array('id' => $value['column_name'], 'name' => $value['column_name']);
        }
        return json_encode($data);
    }

    public function getViewButton($model) {
        $links = "";
        $links .= Html::a('<i class="glyphicon glyphicon-edit"></i>', Url::toRoute(['institute-header-template/next-template-form', 'id' => $model->institute_id]), ['data-method' => 'post']);
        return $links;
    }

    public function downloadFile($header, $arraydata) {
        if (!empty($arraydata)) {
            $objPHPExcel = new \PHPExcel();
            $sheet = 0;
            $objPHPExcel->setActiveSheetIndex($sheet);
            $row = 2;


            if (!empty($header)) {
                $cell_name = 'A';
                foreach ($header as $headerName) {
                    $prev_cell_name = $cell_name;
                    $objPHPExcel->getActiveSheet()->SetCellValue($cell_name . '1', $headerName);
                    $cell_name++;
                }
                $objPHPExcel->getActiveSheet()->getStyle('A1:' . $prev_cell_name . '1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCCCC');
                $objPHPExcel->getActiveSheet()->getStyle('A1:' . $prev_cell_name . '1')->getFont()->setBold(true);
            }
            $rowNo = 1;
            foreach ($arraydata as $data) {
                $cell_name = 'A';
                $rowNo++;
                foreach ($data as $key => $value) {
                    $objPHPExcel->getActiveSheet()->SetCellValue($cell_name . $rowNo, $value);
                    $cell_name++;
                }
            }

            header('Content-Type: application/vnd.ms-excel');
            $filename = "Institutes_Data_" . date("d-m-Y-His") . ".xls";
            header('Content-Disposition: attachment;filename=' . $filename . ' ');
            header('Cache-Control: max-age=0');
            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
        }
        return false;
    }

    public function downloadCsvFile($institute_id, $start_date = '', $end_date = '') {
        if (!empty($institute_id)) {
            $modelTemplate = new InstituteHeaderTemplate();
            $teplateData = $modelTemplate->findOne(['institute_id' => $institute_id]);
            if (!empty($teplateData)) {
                $fields = $teplateData['final_fields'];
                $fields = json_decode($fields);
                $select = "";
                $srno = 1;
                $header[] = "Sr.No";
                $busi = $resi = $office = $resi_office = 'application_id';
                $application = "id";
                foreach ($fields as $key => $value) {
                    $header[] = $key;

                    if (preg_match("/(,)/", $value)) {
                        $explode = explode(",", $value);
                        if (is_array($explode)) {
                            foreach ($explode as $exp) {
                                if (empty($exp))
                                    continue;
                                if (preg_match("/resi_/", $value) && !preg_match("/resi_office_/", $value)) {
                                    $resi .=",$value";
                                } elseif (preg_match("/office_/", $value)) {
                                    $office .=",$value";
                                } elseif (preg_match("/busi_/", $value)) {
                                    $busi .=",$value";
                                } elseif (preg_match("/resi_office_/", $value)) {
                                    $resi_office .=",$value";
                                } else {
                                    $application .= ",$value";
                                }
                            }
                        }

                        $value = str_replace(",", ",' ',", $value);
                    } else {
                        if (preg_match("/resi_/", $value) && !preg_match("/resi_office_/", $value)) {
                            $resi .=",$value";
                        } elseif (preg_match("/office_/", $value)) {
                            $office .=",$value";
                        } elseif (preg_match("/busi_/", $value)) {
                            $busi .=",$value";
                        } elseif (preg_match("/resi_office_/", $value)) {
                            $resi_office .=",$value";
                        } else {
                            $application .= ",$value";
                        }
                    }
                }


                $header[] = "Remarks";
                $where = "";
                $resiData = $busiData = $officeData = $resiOffice = [];
                $finalData = [];
                if (!empty($start_date))
                    $where .= " AND date(created_on)>='{$start_date}'";
                if (!empty($end_date))
                    $where .= " AND date(created_on)<='{$end_date}'";
                if (!empty($application)) {
                    $sql = "select $application from tbl_applications where institute_id=$institute_id $where";
                    $results = Yii::$app->db->createCommand($sql)->queryAll();
                    if (!empty($results)) {
                        foreach ($results as $resVal) {
                            foreach ($resVal as $key => $value) {
                                $finalData[$resVal['id']][$key] = $value;
                            }
                        }
                    }
                }

                if (!empty($resi)) {
                    $sql = "select $resi from tbl_applications_resi";
                    $results = Yii::$app->db->createCommand($sql)->queryAll();
                    if (!empty($results)) {
                        foreach ($results as $resVal) {
                            foreach ($resVal as $key => $value) {
                                $finalData[$resVal['application_id']][$key] = $value;
                            }
                        }
                    }
                }
                if (!empty($office)) {
                    $sql = "select $office from tbl_applications_office";
                    $results = Yii::$app->db->createCommand($sql)->queryAll();
                    if (!empty($results)) {
                        foreach ($results as $resVal) {
                            foreach ($resVal as $key => $value) {
                                $finalData[$resVal['application_id']][$key] = $value;
                            }
                        }
                    }
                }
                if (!empty($busi)) {
                    $sql = "select $busi from tbl_applications_busi";
                    $results = Yii::$app->db->createCommand($sql)->queryAll();
                    if (!empty($results)) {
                        foreach ($results as $resVal) {
                            foreach ($resVal as $key => $value) {
                                $finalData[$resVal['application_id']][$key] = $value;
                            }
                        }
                    }
                }
                if (!empty($resi_office)) {
                    $sql = "select $resi_office from tbl_applications_resi_office";
                    $results = Yii::$app->db->createCommand($sql)->queryAll();
                    if (!empty($results)) {
                        foreach ($results as $resVal) {
                            foreach ($resVal as $key => $value) {
                                $finalData[$resVal['application_id']][$key] = $value;
                            }
                        }
                    }
                }


                if (!empty($finalData)) {
                    foreach ($finalData as $key => $finalDataDtl) {
                        $finalData[$key]['Remarks'] = $this->getReport($key);
                    }
                }
                $id = 1;
                $finalResult = [];
                if (!empty($finalData)) {
                    foreach ($finalData as $key => $value) {
                        $finalResult[$key]["Sr.No"] = $id;
                        $temp = [];
                        foreach ($fields as $key1 => $field) {
                            $finalResult [$key][$key1] = "";
                            if (preg_match("/(,)/", $field)) {
                                $explode = explode(",", $field);
                                foreach ($explode as $expl) {
                                    $finalResult[$key][$key1] .= " " . $value[$expl];
                                }
                            } else {
                                $finalResult [$key][$key1] = $value[$field];
                            }
                        }
                        $finalResult [$key]['Remarks'] = $value["Remarks"];

                        $id ++;
                    }
                }
                
                return ['data' => $finalResult, 'columns' => $header];
                $isDownload = $this->downloadFile($header, $results);
                return true;
            }
        }
        return false;
    }

    public function getReport($id) {
        $sql = "select resi_status,resi_available_status from tbl_applications_resi where application_id=$id";
        $result = Yii::$app->db->createCommand($sql)->queryOne();
        $paragraph = "";
        $model = new ApplicationParagraph();
        $sourceIds = $model->getTypeOfVerification();
        if (!empty($result)) {
            if ($result['resi_status'] == 1)
                $paragraph .= $this->getParagraph(array_search("Residence Verification", $sourceIds), $result['resi_available_status'], $id, 'tbl_applications_resi');
        }
        $sql = "select busi_status,busi_available_status from tbl_applications_busi where application_id=$id";
        $result = Yii::$app->db->createCommand($sql)->queryOne();
        if (!empty($result)) {
            if ($result['busi_status'] == 1)
                $paragraph .= $this->getParagraph(array_search("Business Verification", $sourceIds), $result['busi_available_status'], $id, 'tbl_applications_busi');
        }
        $sql = "select office_status,office_available_status from tbl_applications_office where application_id=$id";
        $result = Yii::$app->db->createCommand($sql)->queryOne();
        if (!empty($result)) {
            if ($result['office_status'] == 1)
                $paragraph .= $this->getParagraph(array_search("Office Verification", $sourceIds), $result['office_available_status'], $id, 'tbl_applications_office');
        }
        $sql = "select resi_office_status,resi_office_available_status from tbl_applications_resi_office where application_id=$id";
        $result = Yii::$app->db->createCommand($sql)->queryOne();
        if (!empty($result)) {
            if ($result['resi_office_status'] == 1)
                $paragraph .= $this->getParagraph(array_search("Residence/Office Verification", $sourceIds), $result['resi_office_available_status'], $id, 'tbl_applications_resi_office');
        }
        if (empty($paragraph))
            $paragraph = "N/A";
        return $paragraph;
    }

    public function getParagraph($source, $doorStatus, $recordId, $source_table = '') {
        $model = new ApplicationParagraph();
        $loantypes = new LoanTypes();
        $sql = "SELECT paragraph from tbl_application_paragraph where type_of_verification=$source AND door_status=$doorStatus";
        $result = Yii::$app->db->createCommand($sql)->queryOne();
        $replacedPara = "";
        $other_select = "application_id";
        $application_select = "id";
        if (!empty($result)) {
            $paragraph = $result['paragraph'];
            if (preg_match_all('/{+(.*?)}/', $paragraph, $matches)) {
                if (!empty($matches)) {
                    foreach ($matches[1] as $match) {
                        if (preg_match("/resi_/", $match) OR preg_match("/resi_office_/", $match) OR preg_match("/busi_/", $match) OR preg_match("/office_/", $match)) {
                            $other_select .= ",$match";
                        } else {
                            $application_select .= ",$match";
                        }
                    }
                }
            }
            $finalResult = [];
            if (!empty($application_select)) {
                $sql = "select $application_select from tbl_applications where id=$recordId";
                $results = Yii::$app->db->createCommand($sql)->queryOne();
                if (!empty($results)) {
                    foreach ($results as $key => $val) {
                        $finalResult[$key] = $val;
                    }
                }
            }
            if (!empty($other_select)) {
                $sql = "select $other_select from $source_table where application_id=$recordId";
                $results = Yii::$app->db->createCommand($sql)->queryOne();
                if (!empty($results)) {
                    foreach ($results as $key => $val) {
                        $finalResult[$key] = $val;
                    }
                }
            }
            $results = $finalResult;
            if (!empty($results)) {
                foreach ($results as $field => $value) {
                    $fieldVar = "{" . $field . "}";
                    if ($field == 'applicant_type') {
                        $results[$field] = $model->applicant_type[$results[$field]];
                    } elseif ($field == 'loan_type_id') {
                        $loans = $loantypes->find()->where(['id' => $results[$field]])->asArray()->one();
                        $results[$fieldVar] = $loans['loan_name'];
                    } elseif (preg_match("/designation/", $field)) {
                        $results[$fieldVar] = (isset($model->designation[$results[$field]]) ? $model->designation[$results[$field]] : "");
                    } elseif (preg_match("/type_of_business/", $field)) {
                        $results[$fieldVar] = (isset($model->type_of_business[$results[$field]]) ? $model->type_of_business[$results[$field]] : "");
                    } elseif (preg_match("/ownership_status/", $field)) {
                        $results[$fieldVar] = (isset($model->ownership_status[$results[$field]]) ? $model->ownership_status[$results[$field]] : "");
                    } elseif (preg_match("/locality_type/", $field)) {
                        $results[$fieldVar] = (isset($model->locality_type[$results[$field]]) ? $model->locality_type[$results[$field]] : "");
                    } elseif (preg_match("/available_status/", $field)) {
                        $results[$fieldVar] = (isset($model->available_status[$results[$field]]) ? $model->available_status[$results[$field]] : "");
                    } elseif (preg_match("/property_status/", $field)) {
                        $results[$fieldVar] = (isset($model->property_status[$results[$field]]) ? $model->property_status[$results[$field]] : "");
                    } elseif (preg_match("/property_type/", $field)) {
                        $results[$fieldVar] = (isset($model->property_type[$results[$field]]) ? $model->property_type[$results[$field]] : "");
                    } else {
                        $results[$fieldVar] = $value;
                    }
                    unset($results[$field]);
                }
                $keys = array_keys($results);
                $values = array_values($results);
            }
            $replacedPara = str_replace($keys, $values, $paragraph) . PHP_EOL;
        }
        return $replacedPara;
    }

}
