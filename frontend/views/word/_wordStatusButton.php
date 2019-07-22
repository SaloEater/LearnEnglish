<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 22.07.2019
 * Time: 9:18
 */

/* @var $entity \common\entities\UsersWords*/
/* @var $preparedURl string*/

\yii\widgets\Pjax::begin([
    'enablePushState' => false,
    'submitEvent' => 'click'
]);
\yii\widgets\ActiveForm::begin([
    'options' => [
        'data-pjax' => true,
    ],
]);

echo \common\widgets\WordStatusWidget::widget([
    'entity' => $entity,
    'preparedURl' => $preparedURl
]);

\yii\widgets\ActiveForm::end();

\yii\widgets\Pjax::end();

?>

