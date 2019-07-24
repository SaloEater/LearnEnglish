<?php
namespace common\repositories;
use common\entities\Word;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\web\NotFoundHttpException;

class WordRepository extends IRepository
{
    private $innerRecord;

    public function __construct(Word $innerRecord)
    {
        $this->innerRecord = $innerRecord;
    }

    public function getById($id)
    {
        $word = $this->getBy($this->innerRecord, ['id' => $id]);

        return $word;
    }

    /**
     * @param string $content
     * @return ActiveRecord
     */
    public function getByContent(string $content)
    {
        $word = $this->getBy($this->innerRecord, [
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
            $b = Yii::$app->db->createCommand('UPDATE `word` SET `order`=`order`+1 WHERE `order`<' . $order . ' AND ' . '`order`>' . $beforeUs);
            $result = $b->execute();
        } else {
            $b = Yii::$app->db->createCommand('UPDATE `word` SET `order`=`order`+1 WHERE `order`>' . $beforeUs);
            $result = $b->execute();
        }
        return $result;
    }
}