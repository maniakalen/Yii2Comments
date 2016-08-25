<?php

namespace Comments\Common\Models;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property string $table_relation
 * @property integer $table_relation_id
 * @property integer $user_id
 * @property string $created_at
 * @property string $content
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['table_relation', 'content'], 'string'],
            [['table_relation_id', 'user_id'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table_relation' => 'Table Relation',
            'table_relation_id' => 'Table Relation ID',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'content' => 'Content',
        ];
    }
}
