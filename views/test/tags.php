<?php

use yii\bootstrap\Html;
use yii\widgets\ActiveForm;
?>

<div class="test-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::dropDownList('tags', $selectedTags, $tags, ['class' => 'form-control', 'multiple' => TRUE]); ?>

    <div class="form-group">

        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']); ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>

