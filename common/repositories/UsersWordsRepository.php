<?php


namespace common\repositories;


use common\entities\UsersWords;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\web\NotFoundHttpException;

class UsersWordsRepository extends IRepository
{
    private $innerRecord;

    public function __construct(UsersWords $innerRecord)
    {
        $this->innerRecord = $innerRecord;
    }

    public function getById(int $id)
    {
        $item = $this->getBy($this->innerRecord, [
            'id' => $id
        ]);
        return $item;
    }

    /**
     * @param int $user_id
     * @param int $word_id
     * @return ActiveRecord
     * @throws NotFoundHttpException
     */
    public function getByIDs(int $user_id, int $word_id)
    {
        if (!$uw = $this->getBy($this->innerRecord, [
            'user_id' => $user_id,
            'word_id' => $word_id
        ])) {
            throw new NotFoundHttpException('Form is not found');
        }

        return $uw;
    }

    public function countItemsBeforeUs($count)
    {
        return (new Query())
            ->from('users_words')
            ->where(['>', 'count', $count])
            ->count();
    }

    public function countItemsOnLevel($count)
    {
        return (new Query())
            ->select('*')
            ->from('users_words')
            ->where(['count' => $count])
            ->all();
    }

    public function updateOrders(int $beforeUs, $order = false)
    {
        if ($order) {
            $b = Yii::$app->db->createCommand('UPDATE `users_words` SET `order`=`order`+1 WHERE `order`<' . $order . ' AND ' . '`order`>' . $beforeUs);
            $result = $b->execute();
        } else {
            $b = Yii::$app->db->createCommand('UPDATE `users_words` SET `order`=`order`+1 WHERE `order`>' . $beforeUs);
            $result = $b->execute();
        }
        return $result;
    }
}