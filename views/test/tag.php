<?php

use yii\helpers\HtmlPurifier;
?>

<div class="tag-view">
    <?= HtmlPurifier::process($model->title) ?>    
</div>