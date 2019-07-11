<?php

namespace backend\controllers;

use common\models\Sentence;
use common\models\SentencesWords;
use common\models\Word;
use Yii;
use common\models\Text;
use backend\models\TextSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TextController implements the CRUD actions for Text model.
 */
class TextController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Text models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TextSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Text model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Text model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $textModel = new Text();

        if ($textModel->load(Yii::$app->request->post()) && $textModel->save()) {
            /**
             * @var string[] $sentences
             */
            preg_match_all('([A-Z]{1}[\w\d\s\-\,\;]+[\.\!]{1})', $textModel->content, $sentences);

            foreach ($sentences[0] as $_s) {
                $model = new Sentence();
                $model->content = $_s;
                $model->text_id=$textModel->id;
                //$model->refresh();
                $model->save();
                preg_match_all('(\w+)', $_s, $words);
                foreach ($words[0] as $_w) {
                    $word = Word::findOne(['content'=>$_w]);
                    if (!$word) {
                        $word = new Word();
                        $word->content = $_w;
                    }
                    $word->count++;
                    $word->save();

                    $sentence_word = new SentencesWords();

                    $sentence_word->sentence_id = $model->id;
                    $sentence_word->word_id = $word->id;
                    $sentence_word->save();
                }
            }
            return $this->redirect(['view', 'id' => $textModel->id]);
        }

        return $this->render('create', [
            'model' => $textModel,
        ]);
    }

    /**
     * Updates an existing Text model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Text model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Text model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Text the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Text::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
