<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\entities\UsersWords */

$this->title = 'Create Users Words';
$this->params['breadcrumbs'][] = ['label' => 'Users Words', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-words-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
