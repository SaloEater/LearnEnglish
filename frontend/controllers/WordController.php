<?php


namespace frontend\controllers;

use backend\models\MegaUsersWordsSearch;
use common\services\UsersWordsService;
use common\widgets\WordStatusWidget;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;

class WordController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['status'],
                        'allow' => true
                    ],
                    [
                        'actions' => ['index', 'changestatus'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'status' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $queryParams = Yii::$app->request->queryParams;

        /*$preparedURl = Url::to('/word/index') . '?';

        if (isset($queryParams['MegaUsersWordsSearch'])) {
            foreach ($queryParams['MegaUsersWordsSearch'] as $param=>$value) {
                $preparedURl .= 'MegaUsersWordsSearch['.$param.']='.$value.'&';
            }
        }

        if (isset($queryParams['sort'])) {
            $preparedURl .= 'sort=' . $queryParams['sort'];
        }*/

        //
        /*if (Yii::$app->request->isAjax && isset(Yii::$app->request->post()['UsersWords'])) {
            $id = Yii::$app->request->post()['UsersWords']['id'];
            $entity = (new UsersWordsService())->changeStatus($id);



            $lol = $this->renderAjax('_wordStatusForm',[
                'entity' => $entity,
                'preparedURl' => $preparedURl
            ]);
            return $lol;
        }*/
        $filterModel = new MegaUsersWordsSearch();

        $dataProvider = $filterModel->search($queryParams);

        return $this->render('index', [
            'filterModel' => $filterModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionStatus()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $id = $data['id'];
            $entity = (new UsersWordsService())->changeStatus($id);
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'known' => $entity->status,
            ];
        }
    }

}