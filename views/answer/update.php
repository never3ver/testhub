<?php

use app\models\Question;
use app\models\Test;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Answer */

$questionInstance = Question::findOne($model->question_id);
$this->title = 'Update Answer';
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ["test/index"]];
$this->params['breadcrumbs'][] = ['label' => 'Test', 'url' => ['test/view', 'id' => $questionInstance->test_id]];
$this->params['breadcrumbs'][] = ['label' => 'Question', 'url' => ['question/view', 'id' => $model->question_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="answer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
