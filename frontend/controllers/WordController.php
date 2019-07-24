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
use yii\web\Response;

class WordController extends Controller
{
    private $userswordsService;

    public function __construct($id, $module,
                                UsersWordsService $userswordsService,
                                $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->userswordsService = $userswordsService;
    }

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
            $entity = $this->userswordsService->changeStatus($id);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'known' => $entity->status,
            ];
        }
        return [];
    }

}