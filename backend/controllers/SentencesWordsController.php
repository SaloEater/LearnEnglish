<?php

namespace backend\controllers;

use backend\models\SentencesWordsSearch;
use common\entities\SentencesWords;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * SentencesWordsController implements the CRUD actions for SentencesWords model.
 */
class SentencesWordsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return ['access' => [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'actions' => ['index', 'view'],
                    'allow' => true,
                ],
                [
                    'actions' => ['create', 'update', 'delete'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SentencesWords models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SentencesWordsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SentencesWords model.
     * @param integer $sentence_id
     * @param integer $word_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($sentence_id, $word_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($sentence_id, $word_id),
        ]);
    }

    /**
     * Creates a new SentencesWords model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SentencesWords();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'sentence_id' => $model->sentence_id, 'word_id' => $model->word_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SentencesWords model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $sentence_id
     * @param integer $word_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($sentence_id, $word_id)
    {
        $model = $this->findModel($sentence_id, $word_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'sentence_id' => $model->sentence_id, 'word_id' => $model->word_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SentencesWords model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $sentence_id
     * @param integer $word_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($sentence_id, $word_id)
    {
        $this->findModel($sentence_id, $word_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SentencesWords model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $sentence_id
     * @param integer $word_id
     * @return SentencesWords the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($sentence_id, $word_id)
    {
        if (($model = SentencesWords::findOne(['sentence_id' => $sentence_id, 'word_id' => $word_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
