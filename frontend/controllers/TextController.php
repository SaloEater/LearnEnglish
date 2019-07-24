<?php


namespace frontend\controllers;

use common\entities\Text;
use common\repositories\TextRepository;
use common\services\TextParser;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class TextController extends Controller
{

    private $textRepository;

    public function __construct($id, $module,
                                TextRepository $textRepository,
                                $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->textRepository = $textRepository;
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
                        'actions' => ['add', 'view', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
           'query' => Text::find()->where(['created_by' => Yii::$app->user->id]),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionAdd()
    {
        $text = new Text();

        if ($text->load(Yii::$app->request->post()) && $text->save()) {
            Yii::createObject(TextParser::class)->parseTextFromModel($text);
            $this->redirect('index');
        }

        return $this->render('create', [
            'model' => $text,
        ]);
    }

    public function actionView($id = 0)
    {
        if (!$id) {
            return $this->redirect('/profile');
        }

        $text = $this->textRepository->getById($id);

        return $this->render('view', [
            'model' => $text
        ]);
    }
}