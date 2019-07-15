<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "forms_words".
 *
 * @property int $form_id
 * @property int $word_id
 *
 * @property Form $form
 * @property Word $word
 */
class FormsWords extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'forms_words';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['form_id', 'word_id'], 'required'],
            [['form_id', 'word_id'], 'integer'],
            [['form_id', 'word_id'], 'unique', 'targetAttribute' => ['form_id', 'word_id']],
            [['form_id'], 'exist', 'skipOnError' => true, 'targetClass' => Form::className(), 'targetAttribute' => ['form_id' => 'id']],
            [['word_id'], 'exist', 'skipOnError' => true, 'targetClass' => Word::className(), 'targetAttribute' => ['word_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'form_id' => 'Form ID',
            'word_id' => 'Word ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForm()
    {
        return $this->hasOne(Form::className(), ['id' => 'form_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWord()
    {
        return $this->hasOne(Word::className(), ['id' => 'word_id']);
    }
}
