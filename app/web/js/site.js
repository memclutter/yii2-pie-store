(function ($) {
    $(function () {

        var $catalogSearchForm = $('.catalog-search-form');
        if ($catalogSearchForm.length != 0) {
            $catalogSearchForm.on('submit', function () {
                var values = {};
                $.each($catalogSearchForm.serializeArray(), function (i, field) {
                    values[field.name] = field.value;
                });

                var pieces = [];

                pieces.push(values.size_id || null);
                pieces.push(values.stuffing_id || null);
                pieces.push(values.target_id || null);
                pieces.push(values.paste_id || null);
                pieces.push(values.oven_id || null);

                pieces = pieces.filter(function (piece) {
                    return piece != null;
                });

                window.location.href = '/catalog/' + pieces.join('/') + '/' + window.location.search;
            });
        }

    });
})(jQuery);