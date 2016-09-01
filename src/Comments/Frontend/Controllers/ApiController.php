<?php
/** $Id: - $ */
/**
 * ---------  Begin Version Control Data----------------------------------------
 * $LastChangedDate: - $
 * $Revision: - $
 * $LastChangedBy: - $
 * $Author: - $
 * ---------  End Version Control Data -----------------------------------------
 */

namespace Comments\Frontend\Controllers;


use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class ApiController extends ActiveController
{
    public $modelClass = 'Comments\Common\Models\Comments';
    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'index' => [
                'prepareDataProvider' => function() {
                    /* @var $modelClass \yii\db\BaseActiveRecord */
                    $modelClass = $this->modelClass;
                    $userEntity = \Yii::$app->user->identity;
                    return new ActiveDataProvider([
                        'query' => $modelClass::find()
                            ->select(['author' => 'u.name', 'date' => $modelClass::tableName().'.created_at', 'text' => 'content'])
                            ->leftJoin(['u' => $userEntity::tableName()], $modelClass::tableName() . '.user_id = u.id'),
                    ]);
                }
            ]
        ]);
    }
}