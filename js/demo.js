(function($, window, undefined) {
    $.danidemo = $.extend({}, {

        addLog: function(id, status, str) {
            var d = new Date();
            var li = $('<li />', {
                'class': 'demo-' + status
            });

            var message = '[' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds() + '] ';

            message += str;

            li.html(message);

            $(id).prepend(li);
        },

        addFile: function(id, i, file) {
            var template = '<div id="demo-file' + i + '">' +
                '<span class="demo-file-id">第' + (i + 1) + '个文件</span> - ' + file.name + ' <span class="demo-file-size">(' + $.danidemo.humanizeSize(file.size) + ')</span> - 文件状态: <span class="demo-file-status">正等待上传</span><br /><span class="upload-speed" style="color: gray;font-size: 90%">&nbsp; - &nbsp; 当前下载速度：0Kb/s</span><br />' +
                '<div class="progress progress-striped active">' +
                '<div class="progress-bar" role="progressbar" style="width: 0%;">' +
                '<span class="progress-num">0%</span>' +
                '</div>' +
                '</div>' +
                '</div>';

            var i = $(id).attr('file-counter');
            if (!i) {
                $(id).empty();

                i = 0;
            }

            i++;

            $(id).attr('file-counter', i);

            $(id).prepend(template);
        },

        updateFileStatus: function(i, status, message) {
            $('#demo-file' + i).find('span.demo-file-status').html(message).addClass('demo-file-status-' + status);
        },

        updateFileProgress: function(i, percent) {

            $('#demo-file' + i).find('div.progress-bar').width(percent);

            $('#demo-file' + i).find('span.progress-num').html(percent);
            
        },

        humanizeSize: function(size) {
            var i = Math.floor(Math.log(size) / Math.log(1024));
            return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
        }

    }, $.danidemo);
})(jQuery, this);

