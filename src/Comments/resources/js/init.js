/**
 * Created by peter.georgiev on 01/09/2016.
 */
$(document).ready(function() {
    window.yii = window.yii || {};
    window.yii.comments = window.yii.comments || {"data" : [], "order" : "4"};
    $('div.handlebars-comments-container').each(function() {
        var table = $(this).data('commentsTable');
        var id = $(this).data('commentsId');
        var url = '/c/comments/list/' + table + '/' + id + '.html';
        $.ajax({
            dataType: 'json',
            accepts: {
                text: "application/json"
            },
            "method": "GET",
            "url": url
        }).done(function(data) {
            if (data.length) {
                yii.comments.data = data;
                var template = compileTemplate('script#handlebars-comments');
                $(this).data('handlebarsTemplate', template);
                var comments = $('<div/>').addClass('comments-container');
                comments.html(template(data));
                $(this).html(comments);
                $(this).append(compileTemplate('script#handlebars-comments-form')([]));
            }
        }.bind(this));
    });
    $('body').on('click', 'button#comment_save', function() {
        var url = $(this).data('submitUrl');
        var container = $(this).closest('div.handlebars-comments-container');
        var table = container.data('commentsTable');
        var id = container.data('commentsId');
        $.ajax({
            dataType: 'json',
            accepts: {
                text: "application/json"
            },
            "method": "POST",
            "url": url,
            'data' : {
                content: $(this).parent().find('textarea').val(),
                table_relation: table,
                table_relation_id: id,
            }
        }).done(function(data) {
            if (typeof yii.comments.order == 'undefined' || yii.comments.order == 4) {
                yii.comments.data.push(data);
            } else {
                yii.comments.data.unshift(data);
            }
            var container = $(this).closest('div.handlebars-comments-container');
            var template = container.data('handlebarsTemplate');
            if (typeof template != 'undefined') {
                $('div.comments-container', container).html(template(yii.comments.data));
            }
        }.bind(this));
        return false;
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