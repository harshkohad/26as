<?php

namespace app\components;

use yii\rbac\DbManager;
use Yii;
use yii\db\Query;

/**
 * Description of AccessDbManager
 *
 * @author shriram
 */
class AccessDbManager extends DbManager {

    public static $userAssigments = [];
    public static $authItems = [];
    public static $authParents = [];

    /**
     * @inheritdoc
     */
    public function getAssignments($userId) {
        if (empty($userId)) {
            return [];
        }
        if (!empty(static::$userAssigments[$userId])) {
            return static::$userAssigments[$userId];
        }
        $query = (new Query)
                ->from($this->assignmentTable)
                ->where(['user_id' => (string) $userId]);

        $assignments = [];
        foreach ($query->all($this->db) as $row) {
            $assignments[$row['item_name']] = new \yii\rbac\Assignment([
                'userId' => $row['user_id'],
                'roleName' => $row['item_name'],
                'createdAt' => $row['created_at'],
            ]);
        }
        static::$userAssigments[$userId] = $assignments;
        return $assignments;
    }

    protected function checkAccessRecursive($user, $itemName, $params, $assignments) {
        if (($item = $this->getItem($itemName)) === null) {
            return false;
        }

        Yii::trace($item instanceof Role ? "Checking role: $itemName" : "Checking permission: $itemName", __METHOD__);

        if (!$this->executeRule($user, $item, $params)) {
            return false;
        }

        if (isset($assignments[$itemName]) || in_array($itemName, $this->defaultRoles)) {
            return true;
        }
        $parents = $this->getParents($itemName);
        foreach ($parents as $parent) {
            if ($this->checkAccessRecursive($user, $parent, $params, $assignments)) {
                return true;
            }
        }

        return false;
    }

    public function getParents($itemName) {
        if (empty(static::$authParents)) {
            $this->loadParents();
        }
        if (!empty(static::$authParents[$itemName])) {
            return static::$authParents[$itemName];
        }
        return [];
    }

    public function loadParents() {
        $query = new Query;
        $parents = $query
                ->from($this->itemChildTable)
                ->all($this->db);
        if (!empty($parents)) {
            foreach ($parents as $parent) {
                static::$authParents[$parent['child']][] = $parent['parent'];
            }
        }
    }

    /**
     * @inheritdoc
     */
    protected function getItem($name) {
        if (empty($name)) {
            return null;
        }
        if (!empty($this->items[$name])) {
            return $this->items[$name];
        }
        if (empty(static::$authItems)) {
            $rows = (new Query)->from($this->itemTable)
                    ->all($this->db);
            $this->arrangeAuthItems($rows);
        }
        if (empty(static::$authItems[$name])) {
            return null;
        }
        return $this->populateItem(static::$authItems[$name]);
    }

    public function arrangeAuthItems($rows) {
        foreach ($rows as $row) {
            if (!empty($row['name'])) {
                static::$authItems[$row['name']] = $row;
            }
        }
    }

}
