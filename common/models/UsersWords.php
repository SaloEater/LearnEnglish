<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "users_words".
 *
 * @property int $id
 * @property int $user_id
 * @property int $word_id
 * @property int $count
 * @property int $order
 * @property int $status
 *
 * @property User $user
 * @property Word $word
 */
class UsersWords extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_words';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'word_id', 'count', 'order', 'status'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['word_id'], 'exist', 'skipOnError' => true, 'targetClass' => Word::className(), 'targetAttribute' => ['word_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'word_id' => 'Word ID',
            'count' => 'Count',
            'order' => 'Order',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWord()
    {
        return $this->hasOne(Word::className(), ['id' => 'word_id']);
    }
}
