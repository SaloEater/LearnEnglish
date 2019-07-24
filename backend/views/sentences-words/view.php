<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\entities\SentencesWords */

$this->title = $model->sentence_id;
$this->params['breadcrumbs'][] = ['label' => 'Sentences Words', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="sentences-words-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'sentence_id' => $model->sentence_id, 'word_id' => $model->word_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'sentence_id' => $model->sentence_id, 'word_id' => $model->word_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sentence_id',
            'word_id',
        ],
    ]) ?>

</div>
