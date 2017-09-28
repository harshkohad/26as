<?php

namespace app\models;

use app\models\JobMaster;
use mdm\admin\models\User;
use yii\mongodb\file\ActiveRecord;

/**
 * Description of JobMaster
 *
 * @author pratik
 */
class JobMaster extends ActiveRecord {

    const JOB_STAUS_PENDING = 'pending';
    const JOB_STAUS_RUNNING = 'running';
    const JOB_STAUS_FAILED = 'failed';
    const JOB_STAUS_CANCELLED = 'cancelled';
    const JOB_STAUS_COMPLETE = 'complete';

    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName() {
        return 'job_master_collection';
    }

    public function rules() {
        return [
            [['action', 'data', 'user_id', 'status'], 'required'],
        ];
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes() {
        return ['_id', 'action', 'data', 'status', 'user_id', 'created_at', 'modified_at', 'result', 'config'];
    }

    /**
     * Create new job
     * 
     * @param array $jobDetails ['action' => '','status' => '','user_id' => 0,'data' => '']
     * @return _id
     */
    public static function createJob($jobDetails = []) {
        $model = new JobMaster();
        $jobDetails['created_at'] = date("Y-m-d H:i:s");
        $jobDetails['modified_at'] = date("Y-m-d H:i:s");
        $model->setAttributes($jobDetails, false);
        if ($model->save(false)) {
            return $model->_id;
        }
        return FALSE;
    }

    /**
     * Returns Job Details
     * 
     * @param string $job_id
     * @param array
     */
    public static function getJobDetails($job_id) {
        return JobMaster::findOne(['_id' => $job_id]);
    }

    /**
     * Update Job Status
     * 
     * @param string $job_id
     * @param string $status
     * @return integer update row count
     */
    public static function updateJobStatus($job_id, $status) {
        return JobMaster::updateAll(['status' => $status, 'modified_at' => date("Y-m-d H:i:s")], ['_id' => $job_id]);
    }

    public function getUsername(){
        $user_id = $this->user_id;
        $user = User::findOne(['id' => $user_id]);
        return !empty($user->username) ? $user->username : NULL;
    }
}
