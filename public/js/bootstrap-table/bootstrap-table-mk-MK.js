/**
 * Bootstrap Table English translation
 * Author: Јосип Режак<h14030@gmail.com>
 */
(function ($) {
    'use strict';

    $.fn.bootstrapTable.locales['mk-MK'] = {
        formatLoadingMessage: function () {
            return 'Се вчитува, ве молиме почекајте...';
        },
        formatRecordsPerPage: function (pageNumber) {
            return pageNumber + ' записи по страна';
        },
        formatShowingRows: function (pageFrom, pageTo, totalRows) {
            return 'Се прикажува ' + pageFrom + ' до ' + pageTo + ' од ' + totalRows + ' редови';
        },
        formatSearch: function () {
            return 'Пребарај';
        },
        formatNoMatches: function () {
            return 'Не се пронајдени записи по тој критериум';
        },
        formatPaginationSwitch: function () {
            return 'Прикажи/Сокриј нумерација на страници';
        },
        formatRefresh: function () {
            return 'Освежи';
        },
        formatToggle: function () {
            return 'Измени';
        },
        formatColumns: function () {
            return 'Колони';
        },
        formatAllRows: function () {
            return 'Сите';
        }
    };

    $.extend($.fn.bootstrapTable.defaults, $.fn.bootstrapTable.locales['en-US']);

})(jQuery);