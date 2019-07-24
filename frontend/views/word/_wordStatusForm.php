<?php

/* @var $entity UsersWords*/

use common\entities\UsersWords;
use common\widgets\WordStatusWidget;
use yii\widgets\ActiveForm;

/* @var $preparedURl string*/

$form = ActiveForm::begin([
    'options' => [
        'data-pjax' => true,
    ],
]);

echo $form->field($entity, 'id')->hiddenInput(['value' => $entity->id])->label(false);

echo WordStatusWidget::widget([
    'entity' => $entity,
    'preparedURl' => $preparedURl
]);

ActiveForm::end();

?>
