<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\entities\Sentence */

$this->title = 'Create Sentence';
$this->params['breadcrumbs'][] = ['label' => 'Sentences', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sentence-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
