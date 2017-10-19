<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Question */
/* @var $form ActiveForm */
?>
<div class="test-question">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'answers') ?>
        <?= $form->field($model, 'test_id') ?>
        <?= $form->field($model, 'qdescription') ?>
        <?= $form->field($model, 'correct_answer') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- test-question -->
