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
?>
{{#each this}}
<div class="comment">
    <h4>{{author}}<span class="date">{{date}}</span></h4>
    <div>
        <img src="/img/quots.png" />
        <p>{{text}}</p>
    </div>
</div>
{{/each}}
<div>
    <button name="comment_save" class="btn btn-primary" type="submit">
        <i class="glyphicon glyphicon-ok-sign"></i><?=Yii::t('comments', 'Submit comment')?>
    </button>
</div>
