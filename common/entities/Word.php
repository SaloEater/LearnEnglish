<?php

namespace common\entities;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "word".
 *
 * @property int $id
 * @property string $content
 * @property int $count
 * @property int $order
 *
 * @property FormsWords[] $formsWords
 * @property Form[] $forms
 * @property SentencesWords[] $sentencesWords
 * @property Sentence[] $sentences
 * @property Translation[] $translations
 * @property UsersWords[] $usersWords
 * @property User[] $users
 */
class Word extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'word';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count', 'order'], 'integer'],
            [['content'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'count' => 'Count',
            'order' => 'Order',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getFormsWords()
    {
        return $this->hasMany(FormsWords::className(), ['word_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getForms()
    {
        return $this->hasMany(Form::className(), ['id' => 'form_id'])->viaTable('forms_words', ['word_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getSentencesWords()
    {
        return $this->hasMany(SentencesWords::className(), ['word_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getSentences()
    {
        return $this->hasMany(Sentence::className(), ['id' => 'sentence_id'])->viaTable('sentences_words', ['word_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(Translation::className(), ['word_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getUsersWords()
    {
        return $this->hasMany(UsersWords::className(), ['word_id' => 'id']);
    }

    /**
     * @return ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('users_words', ['word_id' => 'id']);
    }
}
