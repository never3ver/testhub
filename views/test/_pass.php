<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Test */
/* @var $question app\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-form">

    <h5><strong><?= $model->title ?></strong></h5>
    <h5><strong><?= $model->description ?></strong></h5>
    <h5><strong><?= $question->qdescription ?></strong></h5>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($answer, 'body')->radioList(ArrayHelper::getColumn($answers, 'body'))->label(FALSE); ?>

    <h1><?= $questionIndex ?></h1>

    <div class="form-group">  
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>