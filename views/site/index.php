
<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ListView;

$this->title = 'TestHub';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>TestHub</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-8">
                <h2>Test your knowledges.</h2>

                <?php
                $script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refreshButton").click(); }, 1000);
});
JS;
                $this->registerJs($script);
                ?>
                <?php Pjax::begin(); ?>
                <h1>Now: <?= $time ?></h1>                
                <?= Html::a("Refresh", ['site/index'], ['class' => 'btn btn-lg btn-primary', 'id' => 'refreshButton', 'class' => 'hidden']) ?>
                <?php Pjax::end(); ?>

                <?=
                ListView::widget([
                    'dataProvider' => $listDataProvider,
                    'itemView' => '_list',
                    'summary' => '',
                ]);
                ?>

                <p><a class="btn btn-default" href="http://testhub/test/">All tests &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>About this site.</h2>

                <p>TestHub is a service, that lets you easily create tests and check their results in a convenient interface.
                    You don't need to register in order to create or pass the test, but we advise you to do so, because in 
                    this case you'll have the opportunity to manage your tests.</p>

                <p>Welcome to TestHub community!</p>

                <p><a class="btn btn-default" href="http://testhub/test/create">Create test &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
