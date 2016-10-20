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
                $(this).html(comments);
                $(this).append(compileTemplate('script#handlebars-comments-form')([]));
                renderComments(data);
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
            var order_asc = typeof yii.comments.order == 'undefined' || yii.comments.order == 4;
            if (order_asc) {
                yii.comments.data.push(data);
            } else {
                yii.comments.data.unshift(data);
            }
            var items = yii.comments.data;
            renderComments(items)
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
var renderComments = function(data) {
    if (typeof yii.comments.pageSize == 'number' && yii.comments.pageSize > 0) {
        data = order_asc?data.slice(-yii.comments.pageSize):data.slice(0,yii.comments.pageSize);
    }
    var container = $(this).closest('div.handlebars-comments-container');
    var template = container.data('handlebarsTemplate');
    if (typeof template != 'undefined') {
        $('div.comments-container', container).html(template(data));
    }
};