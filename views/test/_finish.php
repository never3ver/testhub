<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="finish-item">

    <?= HtmlPurifier::process($model->qdescription) ?>    

</div>

