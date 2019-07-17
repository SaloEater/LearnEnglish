<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\entities\SentencesWords */

$this->title = 'Update Sentences Words: ' . $model->sentence_id;
$this->params['breadcrumbs'][] = ['label' => 'Sentences Words', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sentence_id, 'url' => ['view', 'sentence_id' => $model->sentence_id, 'word_id' => $model->word_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sentences-words-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
