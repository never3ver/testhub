<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "anonuser".
 *
 * @property integer $id
 * @property string $cookie
 */
class Anonuser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'anonuser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cookie'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cookie' => 'Cookie',
        ];
    }
}
