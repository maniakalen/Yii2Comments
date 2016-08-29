<?php
/** $Id: - $ */
namespace Comments\Widgets;
/**
 * ---------  Begin Version Control Data----------------------------------------
 * $LastChangedDate: - $
 * $Revision: - $
 * $LastChangedBy: - $
 * $Author: - $
 * ---------  End Version Control Data -----------------------------------------
 */
class CommentsWidget extends \yii\base\Widget
{
    public function run()
    {
        return $this->render('@comments/resources/views/comments');
    }
}