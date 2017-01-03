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

    public $content;

    public static function begin($config = [])
    {
        ob_start();
        return parent::begin($config);
    }

    public static function end()
    {
        if (!empty(static::$stack)) {
            $widget = end(static::$stack);
            $widget->content = ob_end_clean();
        }
        return parent::end();
    }

    public function run()
    {
        return $this->render('@Comments/resources/views/comments',[
            'table' => $this->table,
            'id' => $this->object_id,
            'content' => $this->content
        ]);
    }
}