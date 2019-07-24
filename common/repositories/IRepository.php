<?php

namespace common\repositories;

use yii\db\ActiveRecord;

class IRepository
{
    /**
     * @param ActiveRecord $record
     * @param array $condition
     * @return ActiveRecord|null
     */
    protected function findBy(ActiveRecord $record, array $condition)
    {
        return $record::find()->where($condition)->limit(1)->one();
    }

    /**
     * @param ActiveRecord $record
     * @param array $condition
     * @return ActiveRecord
     * @throws NotFoundException
     */
    protected function getBy(ActiveRecord $record, array $condition): ActiveRecord
    {
        if (!($object = $this->findBy($record, $condition))) {
            throw new NotFoundException(($record::className())."'s is not found");
        }

        return $object;
    }

    /**
     * @param ActiveRecord $record
     * @param array $condition
     * @return array(ActiveRecord)|null
     */
    protected function findAll(ActiveRecord $record, array $condition)
    {
        return $record::find()->where($condition)->all();
    }

    /**
     * @param ActiveRecord $record
     * @param array $condition
     * @return array(ActiveRecord)
     * @throws NotFoundException
     */
    protected function getAll(ActiveRecord $record, array $condition): ActiveRecord
    {
        if (!($objects = $this->findAll($record, $condition))) {
            throw new NotFoundException(($record::className())." is not found");
        }

        return $objects;
    }


}