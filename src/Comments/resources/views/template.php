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
    <h4>{{this.author}}<span class="date">{{this.date}}</span></h4>
    <div>
        <img src="/img/quots.png" />
        <p>{{this.text}}</p>
    </div>
</div>
{{/each}}
<div>
    <div class="form-group">
    <textarea></textarea>
    </div>
    <button name="comment_save" id="comment_save" class="btn btn-primary"
            type="button" data-submit-url="/c/comments/add.html">
        <i class="glyphicon glyphicon-ok-sign"></i><?=Yii::t('comments', 'Submit comment')?>
    </button>
</div>