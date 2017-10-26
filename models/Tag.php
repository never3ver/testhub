<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $title
 *
 * @property TestTag[] $testTags
 */
class Tag extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestTags()
    {
        return $this->hasMany(TestTag::className(), ['tag_id' => 'id']);
    }

    public function getTests()
    {
        return $this->hasMany(Test::className(), ['id' => 'test_id'])
                        ->viaTable('test_tag', ['tag_id' => 'id']);
    }

}
