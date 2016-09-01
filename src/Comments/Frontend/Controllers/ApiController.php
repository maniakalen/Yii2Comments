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


use yii\rest\ActiveController;

class ApiController extends ActiveController
{
    public $modelClass = 'Comments\Common\Models\Comments';
}