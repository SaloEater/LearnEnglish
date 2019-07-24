<?php

/* @var $this yii\web\View */
/* @var $model common\entities\Text */

use common\widgets\translatable\TranslatableTextWidget; ?>
<div class="text-view">

    <?= TranslatableTextWidget::widget([
            'text' => $model
    ])?>

</div>
