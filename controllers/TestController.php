<?php

namespace app\controllers;

use app\models\Answer;
use app\models\Question;
use app\models\QuestionSearch;
use app\models\Tag;
use app\models\Test;
use app\models\TestSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * TestController implements the CRUD actions for Test model.
 */
class TestController extends Controller
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
     * Lists all Test models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Test model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $newQuestion = new Question();
        $newQuestion->test_id = $id;
        $searchModel = new QuestionSearch();
        $query = Question::find()->where(['test_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if ($newQuestion->load(Yii::$app->request->post()) && $newQuestion->save()) {
            if (!Yii::$app->request->isPjax) {
                return $this->redirect(['test/view', 'id' => $id]);
            }
        } else {
            return $this->render('view', [
                        'model' => $this->findModel($id),
                        'newQuestion' => $newQuestion,
                        'questions' => $this->findQuestions($id),
                        'dataProvider' => $dataProvider,
                        'searchModel' => $searchModel,
            ]);
        }
    }

    /**
     * Creates a new Test model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Test();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Test model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = Test::findOne($id);
        $questions = $this->findQuestions($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'questions' => $questions,
            ]);
        }
    }

    public function actionPass($id, $questionIndex)
    {
        $model = Test::findOne($id);
        $answer = new Answer();
        $questionModel = new Question();
        $questionModel->test_id = $id;
        $questionObjectsArray = $this->findQuestions($id);
        $questionsCount = count($questionObjectsArray);
        $question = $questionObjectsArray[$questionIndex];
        $answers = $this->findAnswers($question);

        if (Yii::$app->request->post()) {
            if ($answers[Yii::$app->request->post()['Answer']['body']]['is_correct'] == TRUE) {
                $this->fillSession(TRUE, $questionIndex);
                $this->chooseRedirect($id, $questionIndex, $questionsCount);
            } else {
                $this->fillSession(FALSE, $questionIndex);
                $this->chooseRedirect($id, $questionIndex, $questionsCount);
            }
        }

        return $this->render('pass', [
                    'model' => $this->findModel($id),
                    'question' => $question,
                    'answers' => $answers,
                    'answer' => $answer,
                    'questionIndex' => $questionIndex,
        ]);
    }

    public function actionFinish($id)
    {
        $session = Yii::$app->session;
        $answeredQuestions = $session['questions'];
        $session->destroy();
        
        $correct = $this->countValues($answeredQuestions, TRUE);
        $count = count($answeredQuestions);
        $incorrect = array_keys($answeredQuestions, TRUE);
        $questions = $this->findQuestions($id);
        $provider = array_intersect_key($questions, $incorrect);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $provider,
            'pagination' => ['pageSize' => 20],
        ]);

        return $this->render('finish', [
                    'correct' => $correct,
                    'count' => $count,
                    'incorrect' => $incorrect,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing Test model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Test model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Test the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Test::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findQuestions($id)
    {
        if ($model = $this->findModel($id)) {
            $questionAQ = $model->getQuestions($id);
            $questions = $questionAQ->all();
            if ($questions !== null) {
                return $questions;
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findAnswers($question)
    {
        $answersAQ = $question->getAnswers($question->id);
        $answers = $answersAQ->all();
        if ($answers !== null) {
            return $answers;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function fillSession($bool, $questionIndex)
    {
        $session = Yii::$app->session;
        $questions = $session['questions'];
        $questions[$questionIndex] = $bool;
        $session['questions'] = $questions;
    }

    protected function chooseRedirect($id, $questionIndex, $questionsCount)
    {
        $questionIndex++;
        if ($questionIndex < $questionsCount) {
            return Yii::$app->response->redirect(['test/pass', 'id' => $id, 'questionIndex' => $questionIndex]);
        } else {
            return Yii::$app->response->redirect(['test/finish', 'id' => $id]);
        }
    }

    protected function countValues($answeredQuestions, $bool)
    {
        $i = 0;
        foreach ($answeredQuestions as $value) {
            if ($value == $bool) {
                $i++;
            }
        }
        return $i;
    }

    public function actionSetTags($id)
    {
        $test = $this->findModel($id);
        $selectedTags = $test->getSelectedTags();
        $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');

        if (Yii::$app->request->isPost) {
            $tags = Yii::$app->request->post('tags');
            $test->saveTags($tags);
            return$this->redirect(['view', 'id' => $test->id]);
        }

        return $this->render('tags', [
                    'selectedTags' => $selectedTags,
                    'tags' => $tags,
        ]);
    }

}
