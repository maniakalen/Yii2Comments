/**
 * Created by peter.georgiev on 01/09/2016.
 */
$(document).ready(function() {
    $('div.handlebars-comments-container').each(function() {
        var table = $(this).data('commentsTable');
        var id = $(this).data('commentsId');
        var url = '/comments/list/' + table + '/' + id + '.html';
        $.ajax({
            dataType: 'json',
            accepts: {
                text: "application/json"
            },
            "method": "GET",
            "url": url
        }).done(function(data) {
            if (data.length) {
                var template = compileTemplate('script#handlebars-comments');
                $(this).html(template(data));
            }
        }.bind(this));
    });
    $('body').on('click', 'button#comment_save', function() {
        var url = $(this).data('submitUrl');
        $.ajax({
            dataType: 'json',
            accepts: {
                text: "application/json"
            },
            "method": "POST",
            "url": url,
            'data' : {content: $(this).parent().find('textarea').val()}
        }).done(function(data) {
            console.debug(data);
        });
    });
});
var compileTemplate = function(selector) {
    if (typeof window.templates == 'undefined') {
        window.templates = {};
    }
    if (typeof window.templates[selector] == 'undefined') {
        var source = $(selector).html();
        window.templates[selector] = Handlebars.compile(source);
    }
    return window.templates[selector];
};