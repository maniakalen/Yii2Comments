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
<?php if (isset($content)): ?>
<?php echo $content; ?>
<?php else: ?>
<div class="comment">
    <h4>{{this.author}}<span class="date">{{this.created_at}}</span></h4>
    <div class="content">
        <p>{{this.text}}</p>
    </div>
</div>
<?php endif ?>
{{/each}}
