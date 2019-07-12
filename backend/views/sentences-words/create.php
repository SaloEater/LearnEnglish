<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SentencesWords */

$this->title = 'Create Sentences Words';
$this->params['breadcrumbs'][] = ['label' => 'Sentences Words', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sentences-words-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
