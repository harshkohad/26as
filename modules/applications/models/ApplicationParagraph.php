<?php

namespace app\modules\applications\models;

use yii\data\ActiveDataProvider;
use Yii;

/**
 * This is the model class for table "tbl_application_paragraph".
 *
 * @property integer $id
 * @property string $name
 * @property integer $paragraph_type
 * @property resource $paragraph
 * @property string $created_at
 */
class ApplicationParagraph extends \yii\db\ActiveRecord {

    public $applicant_type = ['1' => 'Salaried', '2' => 'Self-employed'];
    public $designation = ['1' => 'Self', '2' => 'Manager', '3' => 'Accountant', '4' => 'HR', '5' => 'Staff', '6' => 'Security', '7' => 'Others'];
    public $type_of_business = ['1' => 'DIRECTORSHIP', '2' => 'PROPRIETOR', '3' => 'PARTNERSHIP'];
    public $ownership_status = ['1' => 'Rented', '2' => 'Owned', '3' => 'Parental', '4' => 'Other'];
    public $locality_type = ['1' => 'Gala', '2' => 'Shopline', '3' => 'Compound', '4' => 'Resi', '5' => 'Commercial', '6' => 'Other'];
    public $available_status = ['1' => 'Available for Verification', '2' => 'Door Locked', '3' => 'Shifted', '4' => 'Door Locked & Shifted'];
    public $relation = ['1' => 'Self', '2' => 'Father', '3' => 'Mother', '4' => 'Brother', '5' => 'Wife', '6' => 'Son', '7' => 'Daughter', '8' => 'Grandfather', '9' => 'Grand Mother', '10' => 'Uncle', '11' => 'Aunt', '12' => 'Cousin', '13' => 'Employee', '14' => 'Neighbour', '15' => 'Security Guard', '16' => 'NA'];
    public $total_family_members = ['1' => 'Self', '2' => 'Father', '3' => 'Mother', '4' => 'Brother', '5' => 'Wife', '6' => 'Son', '7' => 'Daughter', '8' => 'Grandfather', '9' => 'Grand Mother', '10' => 'Uncle', '11' => 'Aunt', '12' => 'Cousin', '13' => 'Employee', '14' => 'Neighbour', '15' => 'Security Guard', '16' => 'NA'];
    public $property_status = ['1' => 'Freshland', '2' => 'Redevelopment'];
    public $property_type = ['1' => 'Fresh Property', '2' => 'Old Sold Out'];

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_application_paragraph';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'paragraph', 'type_of_verification', 'door_status'], 'required'],
            [['paragraph'], 'string'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['door_status', 'type_of_verification'], 'integer', 'min' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'paragraph_type' => 'Paragraph Type',
            'paragraph' => 'Paragraph',
            'type_of_verification' => 'Type of Verification',
            'door_status' => 'Door Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {

        $query = ApplicationParagraph::find()->orderBy([
            'id' => SORT_DESC,
        ]);

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        } else {
            
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'name' => $this->name,
            'paragraph_type' => $this->paragraph_type,
            'paragraph' => $this->paragraph,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'modified_by' => $this->modified_by,
            'modified_at' => $this->modified_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'paragraph', $this->paragraph])
                ->andFilterWhere(['like', 'created_at', $this->created_at]);

        return $dataProvider;
    }

    public function getTypeOfVerification($id = '') {
        $verification = [
            1 => "Residence Verification",
            2 => "Business Verification",
            3 => "Office Verification",
            4 => "NOC (Business/Conditional)",
            5 => "Residence/Office Verification",
            6 => "Builder Profile",
            7 => "Property (APF)",
            8 => "Individual Property",
            9 => "NOC (Society)"
        ];
        if (empty($id))
            return $verification;
        if (isset($verification[$id]))
            return $verification[$id];
        return "";
    }

    public function getDoorLockedShif($id = '') {
        $verification = [
            1 => "Available for Verification",
            2 => "Door Locked",
            3 => "Shifted",
            4 => "Door Locked & Shifted",
        ];
        if (empty($id))
            return $verification;
        if (isset($verification[$id]))
            return $verification[$id];
        return "";
    }

    public function getTypeOfPragraph($id = '') {
        $verification = [
            0 => "Report",
            1 => "PDF"
        ];
        if (empty($id))
            return $verification;
        if (isset($verification[$id]))
            return $verification[$id];
        return "";
    }

    public function getParagraphType($model) {
        if ($model->paragraph_type == 0)
            return "Report";
        return "PDF";
    }

    public function getTypeOfVerificationStatus($model) {
        if (!empty($model->type_of_verification))
            return $this->getTypeOfVerification($model->type_of_verification);
        return "N/A";
    }

    public function getDoorStatus($model) {
        if (!empty($model->door_status))
            return $this->getDoorLockedShif($model->door_status);
        return "N/A";
    }

}
