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
    <h4>{{this.author}}<span class="date">{{this.created_at}}</span></h4>
    <div>
        <img src="/img/quots.png" />
        <p>{{this.text}}</p>
    </div>
</div>
{{/each}}
