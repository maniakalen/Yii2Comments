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
    <textarea cols="8" rows="5"></textarea>
    <button name="comment_save" id="comment_save" class="btn btn-primary" type="submit" data-submit-url="/comments/add/<?=$table?>/<?=$id?>.html">
        <i class="glyphicon glyphicon-ok-sign"></i><?=Yii::t('comments', 'Submit comment')?>
    </button>
</div>
