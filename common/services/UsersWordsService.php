<?php


namespace common\services;


use common\entities\UsersWords;
use common\entities\Word;
use common\repositories\UsersWordsRepository;

class UsersWordsService
{
    private $userswords;

    public function __construct(UsersWordsRepository $userswords)
    {
        $this->userswords = $userswords;
    }

    public function changeStatus($id)
    {
        $item = $this->userswords->getById($id);
        $item->status = (int)!(bool)$item->status;
        $this->save($item, false);
        return $item;
    }

    /**
     * @param int $user_id
     * @param int $word_id
     * @return UsersWords|\yii\db\ActiveRecord
     * @throws \yii\web\NotFoundHttpException
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
        $count = $usersWords->count;
        $beforeUS = $this->userswords->countLinksBeforeUs($count);
        $items = $this->userswords->countLinksOnLevel($count);
        foreach ($items as $item) {
            $wordContent = ($usersWords->word->content);
            $gotWordContent = (Word::findOne($item['word_id']))->content;
            if ((strcmp($wordContent, $gotWordContent)) == 1) {
                $beforeUS++;
            }
        }
        if ($usersWords->order) {
            $b = \Yii::$app->db->createCommand('UPDATE `users_words` SET `order`=`order`+1 WHERE `order`<' . $usersWords->order . ' AND ' . '`order`>' . $beforeUS);
            $b->execute();
        } else {
            $b = \Yii::$app->db->createCommand('UPDATE `users_words` SET `order`=`order`+1 WHERE `order`>' . $beforeUS);
            $b->execute();
        }
        $usersWords->order = $beforeUS+1;
        return $usersWords;
    }
}