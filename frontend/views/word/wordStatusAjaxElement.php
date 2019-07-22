<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 22.07.2019
 * Time: 9:18
 */

/* @var $entity \common\entities\UsersWords*/
/* @var $preparedURl string*/
/* @var $view \yii\web\View */

\yii\widgets\Pjax::begin([
    'enablePushState' => false,
    'submitEvent' => 'click'
]);

echo $view->render('_wordStatusForm', [
   'entity' => $entity,
   'preparedURl' => $preparedURl,
    'view' => $view
]);

\yii\widgets\Pjax::end();

?>

