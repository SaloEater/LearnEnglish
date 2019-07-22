<?php


namespace common\services;


use common\entities\UsersWords;
use common\entities\Word;

class UsersWordsService extends WordUsersWordsService
{

    /**
     * @param int $user_id
     * @param int $word_id
     * @return usersWords|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public function getLink(int $user_id, int $word_id)
    {
        try {
            $user = $this->userswords->getByIDs($user_id, $word_id);
        } catch(\DomainException $e) {
            $user = $this->createWithIDs($user_id, $word_id);
        }
        return $user;
    }

    /**
     * @param int $user_id
     * @param int $word_id
     * @return usersWords
     */
    public function createWithIDs(int $user_id, int $word_id)
    {
        $userswords = new usersWords();
        $userswords->word_id = $word_id;
        $userswords->user_id = $user_id;
        $this->save($userswords, false);
        return $userswords;
    }

    /**
     * @param UsersWords $usersWords
     * todo не забудь добавить метод SetOrder
     */
    public function save(UsersWords $usersWords, $increment = true)
    {
        if ($increment) {
            $usersWords->count++;
            $this->setOrder($usersWords);
        }
        if (!$usersWords->save()) {
            throw new \RuntimeException('UsersWords saving error');
        }
    }

    public function setOrder(UsersWords $usersWords)
    {
        $usersWords = $this->order($usersWords, "userswords");
        return $usersWords;
    }
}