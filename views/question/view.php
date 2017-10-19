<?php

use app\models\Question;
use app\models\Test;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Question */

$this->title = $model->qdescription;
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ["test/index"]];
$this->params['breadcrumbs'][] = ['label' => 'Test', 'url' => ["test/view?id=$model->test_id"]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="answer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'qdescription',
            'test_id',
        ],
    ])
    ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'body',
            'is_correct',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $url = Url::to(['answer/update', 'id' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title' => Yii::t('yii', 'Update'), 'data-pjax' => '0']);
                    },
                    'delete' => function($url, $model) {
                        $url = Url::to(['answer/delete', 'id' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'title' => 'delete',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this item?',
                                        'method' => 'post',
                                    ],
//                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
//                                    'data-method' => 'post',],
                        ]);
                    },
                ],
            ],
        ],
    ]);
    ?>


    <?php echo $this->render('@app/views/answer/create', ['model' => $newAnswer, 'id' => $model->id]); ?>

    <?php // echo Html::a('Add answer', ['answer/create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>

</div>
