<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "form".
 *
 * @property int $id
 * @property string $content
 * @property int $count
 *
 * @property FormsWords[] $formsWords
 * @property Word[] $words
 */
class Form extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'form';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count'], 'integer'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormsWords()
    {
        return $this->hasMany(FormsWords::className(), ['form_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWords()
    {
        return $this->hasMany(Word::className(), ['id' => 'word_id'])->viaTable('forms_words', ['form_id' => 'id']);
    }
}
