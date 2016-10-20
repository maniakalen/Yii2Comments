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


use Comments\Common\Models\Comments;
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
        $model = \Yii::createObject(Comments::className());
        \Yii::$app->getView()->registerJs('
            yii = yii || {"comments" : {}}; 
            yii.comments = yii.comments || {"data" : [], "order" : "'. $model->defaultOrder.'"};
        ');
        return parent::beforeAction($action);
    }

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'index' => [
                'prepareDataProvider' => function() {
                    /* @var $modelClass \yii\db\BaseActiveRecord */
                    $modelClass = $this->modelClass;
                    $userEntity = \Yii::$app->user->identity;

                    $model = \Yii::createObject($modelClass);
                    $order = isset($model->defaultOrder)?$model->defaultOrder:null;
                    $query = $modelClass::find()
                        ->select(['author' => 'u.name', 'date' => $modelClass::tableName().'.created_at', 'text' => 'content'])
                        ->leftJoin(['u' => $userEntity::tableName()], $modelClass::tableName() . '.user_id = u.id');
                    if ($order) {
                        $query->orderBy($order);
                    }
                    return new ActiveDataProvider([
                        'query' => $query,
                        'pagination' => $this->pagination,
                    ]);
                }
            ]
        ]);
    }
}