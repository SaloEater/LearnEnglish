<?php
namespace common\repositories;
use common\entities\Word;
use yii\db\Query;
use yii\web\NotFoundHttpException;

class WordRepository extends IRepository
{
    public function __construct()
    {
        $this->type = new Word();
    }

    /**
     * @param string $content
     * @return \yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public function getByContent(string $content)
    {
        $word = $this->getBy([
            'content' => $content
        ]);

        return $word;
    }

    public function countItemsBeforeUs($count)
    {
        return (new Query())
            ->from('word')
            ->where(['>', 'count', $count])
            ->count();
    }

    public function countItemsOnLevel($count)
    {
        return (new Query())
            ->select('*')
            ->from('word')
            ->where(['count' => $count])
            ->all();
    }

    public function updateOrders(int $beforeUs, $order = false)
    {
        if ($order) {
            $b = \Yii::$app->db->createCommand('UPDATE `word` SET `order`=`order`+1 WHERE `order`<' . $order . ' AND ' . '`order`>' . $beforeUs);
            $result = $b->execute();
        } else {
            $b = \Yii::$app->db->createCommand('UPDATE `word` SET `order`=`order`+1 WHERE `order`>' . $beforeUs);
            $result = $b->execute();
        }
        return $result;
    }
}