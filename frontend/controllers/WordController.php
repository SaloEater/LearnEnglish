<?php


namespace frontend\controllers;

use backend\models\MegaUsersWordsSearch;
use common\services\UsersWordsService;
use common\widgets\WordStatusWidget;
use Yii;
use yii\filters\AccessControl;
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
                        'actions' => ['index', 'changestatus'],
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

    public function actionIndex($id = null)
    {
        $queryParams = Yii::$app->request->queryParams;

        $preparedURl = Url::to('/word/index') . '?';

        if (isset($queryParams['MegaUsersWordsSearch'])) {
            foreach ($queryParams['MegaUsersWordsSearch'] as $param=>$value) {
                $preparedURl .= 'MegaUsersWordsSearch['.$param.']='.$value.'&';
            }
        }

        if (isset($queryParams['sort'])) {
            $preparedURl .= 'sort=' . $queryParams['sort'];
        }

        /*
         * $preparedURl = Url::to('');
         *
         * if (strpos($preparedURl, '?')) {
            if (($idParamIndex = strpos($preparedURl, 'id'))) {
                $buffer = substr($preparedURl, 0, $idParamIndex);
                $buffer = trim($buffer, '&');
                if (($nextParamPos = strpos($preparedURl, '&', $idParamIndex))) {
                    $buffer .= substr($preparedURl, $nextParamPos, strlen($preparedURl)+1);
                }
                $preparedURl = $buffer;
                unset($_GET['id']);
            }
            if (($idParamIndex = strpos($preparedURl, 'pjax'))) {
                $buffer = substr($preparedURl, 0, $idParamIndex);
                $buffer = trim($buffer, '&');
                if (($nextParamPos = strpos($preparedURl, '&', $idParamIndex))) {
                    $buffer .= substr($preparedURl, $nextParamPos, strlen($preparedURl)+1);
                }
                $preparedURl = $buffer;
                unset($_GET['id']);
            }
        } else {
            $preparedURl.= '?';
        }*/

        die(print_r(Yii::$app->request));
        if (Yii::$app->request->isAjax) {
            $entity = (new UsersWordsService())->changeStatus(Yii::$app->request->post());
            $lol = WordStatusWidget::widget([
                'entity' => $entity,
                'preparedURl' => $preparedURl
            ]);
            return $lol;
        }
        $filterModel = new MegaUsersWordsSearch();

        $dataProvider = $filterModel->search($queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'filterModel'=> $filterModel,
            'preparedURl' => $preparedURl,
        ]);
    }

}