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
\Comments\Assets\CommentsAsset::register($this);
?>
<div class="col-md-8 step comments handlebars-comments-container" data-comments-table="<?=$table?>" data-comments-id="<?=$id?>">
    <div class="progress" style="margin-bottom:0;">
        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
            <span class="sr-only"><?=Yii::t('comments', 'Loading')?></span>
        </div>
    </div>
</div>
