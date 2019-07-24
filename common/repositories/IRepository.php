<?php

namespace common\repositories;

use yii\db\ActiveRecord;

class IRepository
{
    /**
     * @var $type ActiveRecord
     */
    protected $type;

    //TODO Доделать find методы

    protected function getBy(ActiveRecord $model, array $condition): ActiveRecord
    {
        $object = $model::find()->andWhere($condition)->limit(1)->one();
        return $this->found($object);
    }
    protected function found($object)
    {
        if (!$object) {
            throw new NotFoundException(($this->type::className())." is not found");
        }
        return $object;
    }
    protected function getSome(array $condition): array
    {
        $objects = $this->type::find()->andWhere($condition)->all();
        return $this->found($objects);
    }
}