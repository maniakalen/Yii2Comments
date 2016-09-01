/**
 * Created by peter.georgiev on 01/09/2016.
 */
$(document).ready(function() {
    $('div.handlebars-comments-container').each(function() {
        var table = $(this).data('commentsTable');
        var id = $(this).data('commentsId');
        var url = '/comments/list/' + table + '/' + id + '.html';
        $.ajax({
            "method": "GET",
            "url": url
        }).done(function(data) {
            console.debug(data);
        });
    });
});