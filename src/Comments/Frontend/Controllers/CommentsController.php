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


use yii\web\Controller;

class CommentsController extends Controller
{
    public function actions()
    {
        return [
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => 'Comments\Common\Models\Comments',
            ],
        ];
    }
}