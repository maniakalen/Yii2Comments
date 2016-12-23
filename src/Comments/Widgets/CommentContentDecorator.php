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

namespace Comments\Widgets;


use yii\widgets\ContentDecorator;

class CommentContentDecorator extends ContentDecorator
{
    public function init()
    {
        if (!$this->viewFile) {
            $this->viewFile = '@Comments/resources/views/comments';
        }
        parent::init();
    }
}