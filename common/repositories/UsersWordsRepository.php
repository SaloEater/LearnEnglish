<?php


namespace common\repositories;


use common\entities\UsersWords;
use yii\db\Query;
use yii\web\NotFoundHttpException;

class UsersWordsRepository extends IRepository
{
    public function __construct()
    {
        $this->type = new UsersWords();
    }

    /**
     * @param int $user_id
     * @param int $word_id
     * @return \yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public function getByIDs(int $user_id, int $word_id)
    {
        if (!$uw = $this->getBy([
            'user_id' => $user_id,
            'word_id' => $word_id
        ])) {
            throw new NotFoundHttpException('Form is not found');
        }

        return $uw;
    }

    public function countLinksBeforeUs($count)
    {
        return (new Query())
            ->from('users_words')
            ->where(['>', 'count', $count])
            ->count();
    }

    public function countLinksOnLevel($count)
    {
        return (new Query())
            ->select('*')
            ->from('users_words')
            ->where(['count' => $count])
            ->all();
    }
}