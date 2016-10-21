/**
 * Created by peter.georgiev on 01/09/2016.
 */
$(document).ready(function() {
    window.yii = window.yii || {};
    window.yii.comments = window.yii.comments || {"data" : [], "order" : "4"};
    window.yii.comments.compileTemplate = function(selector) {
        if (typeof window.templates == 'undefined') {
            window.templates = {};
        }
        if (typeof window.templates[selector] == 'undefined') {
            var source = $(selector).html();
            window.templates[selector] = Handlebars.compile(source);
        }
        return window.templates[selector];
    };
    window.yii.comments.renderComments = function(data, page) {
        data = yii.comments.getDataPage(data,page);
        var container = $(this).closest('div.handlebars-comments-container');
        var template = container.data('handlebarsTemplate');
        if (typeof template != 'undefined') {
            $('div.comments-container', container).html(template(data));
        }
    };
    window.yii.comments.isOrderAsc = function() {
        return typeof yii.comments.order == 'undefined' || yii.comments.order == 4;
    };
    window.yii.comments.getDataPage = function(data, page) {
        page = page || 1;
        if (typeof yii.comments.pageSize == 'number' && yii.comments.pageSize > 0) {
            if (data.length < yii.comments.pageSize) {
                return data;
            }
            var from, to;
            if (yii.comments.isOrderAsc()) {
                from = -(yii.comments.pageSize*page);
                to = page-1;
                if (to == 0) {
                    data = data.slice(from);
                } else {
                    data = data.slice(from, -(yii.comments.pageSize*to));
                }
            } else {
                from = Math.min(data.length, Math.max(0, yii.comments.pageSize*(page-1)));
                to = Math.min(data.length, Math.max(from, yii.comments.pageSize*page));
                data = data.slice(from, to);
            }
        }
        return data;
    };
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
                var template = yii.comments.compileTemplate('script#handlebars-comments');
                $(this).data('handlebarsTemplate', template);
                var comments = $('<div/>').addClass('comments-container');
                $(this).html(comments);
                var numPages = Math.ceil(yii.comments.data.length / yii.comments.pageSize);
                if (typeof yii.comments.pageSize == 'number' && yii.comments.pageSize > 0 && numPages > 1) {
                    $(this).data('commentsPage', 1)
                        .data('commentsDownDisabled', !yii.comments.isOrderAsc())
                        .data('commentsUpDisabled', yii.comments.isOrderAsc());

                    var scrollUp = $('<a/>')
                        .html("<span class='glyphicon glyphicon-chevron-up' />")
                        .addClass('btn btn-default up');

                    var scrollDown = $('<a/>')
                        .html("<span class='glyphicon glyphicon-chevron-down' />")
                        .addClass('btn btn-default down');

                    var goBack = function() {
                        var parent = $(this).parent();
                        if (parent.data('commentsUpDisabled')) {
                            return false;
                        }
                        var page = parseInt(parent.data('commentsPage'));
                        page -= 1;
                        if (parent.data('commentsDownDisabled')) {
                            parent.data('commentsDownDisabled', false);
                            $('a', parent).removeClass('disabled');
                        }
                        if (page <= 1) {
                            parent.data('commentsUpDisabled', true);
                            $(this).addClass('disabled');
                        }

                        if (!isNaN(page)) {
                            parent.data('commentsPage', Math.max(1,page))
                            yii.comments.renderComments.bind(comments,yii.comments.data,page).call();
                        }
                    };
                    var goForward = function() {
                        var parent = $(this).parent();
                        if (parent.data('commentsDownDisabled')) {
                            return false;
                        }
                        var page = parseInt(parent.data('commentsPage'));
                        page +=1;
                        page = Math.min(page, numPages);
                        if (parent.data('commentsUpDisabled')) {
                            parent.data('commentsUpDisabled', false);
                            $('a', parent).removeClass('disabled');
                        }
                        if (page >= numPages) {
                            parent.data('commentsDownDisabled', true);
                            $(this).addClass('disabled');
                        }

                        if (!isNaN(page)) {
                            parent.data('commentsPage', page);
                            yii.comments.renderComments.bind(comments,yii.comments.data,page).call();
                        }
                    };
                    scrollUp.on('click', yii.comments.isOrderAsc()?goForward:goBack);
                    scrollDown.on('click', yii.comments.isOrderAsc()?goBack:goForward);
                    if (yii.comments.isOrderAsc()) {
                        scrollDown.addClass('disabled');
                    } else {
                        scrollUp.addClass('disabled');
                    }
                    comments.before(scrollUp);
                    comments.after(scrollDown);
                }
                $(this).append(yii.comments.compileTemplate('script#handlebars-comments-form')([]));
                yii.comments.renderComments.bind(comments,data, 1).call();
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
                table_relation_id: id
            }
        }).done(function(data) {
            if (yii.comments.isOrderAsc()) {
                yii.comments.data.push(data);
            } else {
                yii.comments.data.unshift(data);
            }
            var items = yii.comments.data;
            yii.comments.renderComments.bind(this,items).call();
        }.bind(this));
        return false;
    });
});