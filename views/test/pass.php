<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Test */

$this->title = 'Pass the Test';
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-pass">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo $this->render('_pass', [
        'model' => $model,
        'question' => $question,
        'answers' => $answers,
        'answer' => $answer,
        'questionIndex' => $questionIndex,
    ])
    ?>

</div>
