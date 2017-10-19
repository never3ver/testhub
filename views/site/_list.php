<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<div class="news-item">
    <h2><a href="http://testhub/test/pass?id=<?= $model->id ?>&questionIndex=0"><?= Html::encode($model->title) ?></a></h2>
    <?= HtmlPurifier::process($model->description) ?>    
</div>