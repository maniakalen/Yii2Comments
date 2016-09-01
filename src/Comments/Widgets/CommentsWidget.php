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
    public $table;
    public $object_id;
    public function run()
    {
        return $this->render('@Comments/resources/views/comments',['table' => $this->table, 'id' => $this->object_id]);
    }
}