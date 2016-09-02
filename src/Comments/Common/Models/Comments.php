<?php

namespace Comments\Common\Models;
use yii\helpers\ArrayHelper;

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
    public $author;
    public $date;
    public $text;
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
            [['created_at', 'author', 'date','text'], 'safe'],
        ];
    }
    public function fields()
    {
        return ArrayHelper::merge(parent::extraFields(), ['author' => 'author', 'date' => 'date', 'text' => 'text']);
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
