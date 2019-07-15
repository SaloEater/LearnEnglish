<?php

namespace common\repositories;

use yii\db\ActiveRecord;

class IRepository
{
    protected $type;

    protected function getBy(array $condition): ActiveRecord
    {
        $object = $this->type::find()->andWhere($condition)->limit(1)->one();
        return $this->found($object);
    }
    protected function found($object)
    {
        if (!$object) {
            throw new \DomainException(($this->type)." is not found");
        }
        return $object;
    }
    protected function getSome(array $condition): array
    {
        $objects = $this->type::find()->andWhere($condition)->all();
        return $this->found($objects);
    }
}