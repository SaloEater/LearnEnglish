<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 22.07.2019
 * Time: 9:18
 */

use common\widgets\WordStatusWidget;

/* @var $id int */
/* @var $status bool*/
/* @var $view \yii\web\View */

\yii\widgets\Pjax::begin([
    'enablePushState' => false,
    'submitEvent' => 'click'
]);

echo WordStatusWidget::widget([
    'id' => $id,
    'status' => $status
]);

/*echo $view->render('_wordStatusForm', [
   'entity' => $entity,
   'preparedURl' => $preparedURl,
    'view' => $view
]);*/

\yii\widgets\Pjax::end();

?>

