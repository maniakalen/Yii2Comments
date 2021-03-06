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


use yii\base\InvalidCallException;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class ApiController extends ActiveController
{
    public $modelClass = 'Comments\Common\Models\Comments';
    public $pagination = ['pageSize' => 20];
    public function beforeAction($action)
    {
        $params = \Yii::$app->getRequest()->getBodyParams();
        $params['user_id'] = \Yii::$app->user->id;
        \Yii::$app->getRequest()->setBodyParams($params);
        return parent::beforeAction($action);
    }

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'index' => [
                'prepareDataProvider' => function() {
                    $request = \Yii::$app->request;
                    $table = $request->get('table');
                    $id = $request->get('id');
                    if (!$table || !$id) {
                        throw new InvalidCallException('Configuration missing');
                    }
                    /* @var $modelClass \yii\db\BaseActiveRecord */
                    $modelClass = $this->modelClass;
                    $userEntity = \Yii::$app->user->identity;

                    $model = \Yii::createObject($modelClass);
                    $order = isset($model->defaultOrder)?$model->defaultOrder:null;
                    $query = $modelClass::find()
                        ->select(['author' => 'u.name', 'created_at' => $modelClass::tableName().'.created_at', 'text' => 'content'])
                        ->leftJoin(['u' => $userEntity::tableName()], $modelClass::tableName() . '.user_id = u.id')
                        ->where([
                            $modelClass::tableName().'.table_relation' => $table,
                            $modelClass::tableName().'.table_relation_id' => $id
                        ]);
                    if ($order) {
                        $query->orderBy($order);
                    }
                    return new ActiveDataProvider([
                        'query' => $query,
                        'pagination' => ['pageSize' => 0],
                    ]);
                }
            ]
        ]);
    }
}