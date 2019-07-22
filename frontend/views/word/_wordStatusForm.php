<?php

/* @var $entity \common\entities\UsersWords*/
/* @var $preparedURl string*/

$form = \yii\widgets\ActiveForm::begin([
    'options' => [
        'data-pjax' => true,
    ],
]);

echo $form->field($entity, 'id')->hiddenInput(['value' => $entity->id])->label(false);

echo \common\widgets\WordStatusWidget::widget([
    'entity' => $entity,
    'preparedURl' => $preparedURl
]);

\yii\widgets\ActiveForm::end();

?>
