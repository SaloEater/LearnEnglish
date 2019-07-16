<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Text */

$this->title = 'Create Text';
$this->params['breadcrumbs'][] = ['label' => 'Texts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
