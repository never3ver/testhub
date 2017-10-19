<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property string $qdescription
 * @property integer $test_id
 *
 * @property Test $testId
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_id'], 'integer'],
            [['qdescription'], 'string', 'max' => 255],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['test_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'qdescription' => 'Description',
            'test_id' => 'Id of Test',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }
    
     public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['question_id' => 'id']);
    }
}
