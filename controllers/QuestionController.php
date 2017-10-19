<?php

namespace app\controllers;

use app\models\Answer;
use app\models\Question;
use app\models\QuestionSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Question models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Question model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $newAnswer = new Answer();
        $newAnswer->question_id = $id;
        $query = Answer::find()->where(['question_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($newAnswer->load(Yii::$app->request->post()) && $newAnswer->save()) {
            if (!Yii::$app->request->isPjax) {
                return $this->redirect(['question/view', 'id' => $id]);
            }
        } else {
            return $this->render('view', [
                        'model' => $this->findModel($id),
                        'newAnswer' => $newAnswer,
                        'answers' => $this->findAnswers($id),
                        'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Creates a new Question model.
     * If creation is successful, the browser will be redirected to the 'test/view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Question();
        $model->test_id = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (!Yii::$app->request->isPjax) {
                return $this->redirect(['test/view', 'id' => $id]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
                        'id' => $id,
            ]);
        }
    }

    /**
     * Updates an existing Question model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $answers = $this->findAnswers($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['test/view', 'id' => $model->test_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'answers' => $answers,
            ]);
        }
    }

    /**
     * Deletes an existing Question model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['test/view', 'id' => $model->test_id]);
    }

    /**
     * Finds the Question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Question the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findAnswers($id)
    {
        if ($model = $this->findModel($id)) {
            $answerAQ = $model->getAnswers($id);
            $answers = $answerAQ->all();

            if ($answers !== null) {
                return $answers;
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
