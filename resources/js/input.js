$(document).on('ajaxComplete ready', function () {

    // Initialize inputs
    $('input[data-provides="defr.field_type.flatpickr"]:not([data-initialized])')
        .each(function () {

            var $input = $(this);
            var dataSet = {};
            var data = this.dataset;
            var value;
            var excludes = ['field', 'field_name', 'provides', 'timezone'];
            var mutateValue = function (value, key = null) {
                switch (value) {
                case '':
                    return false;
                case '1':
                    if (key.endsWith('Increment')) {
                        return Number(value);
                    }
                    return true;
                }
                return value;
            };

            for (var key in data) {
                if (data.hasOwnProperty(key) && !excludes.includes(key)) {
                    value = mutateValue(data[key], key);

                    dataSet[key] = value;
                }
            }

            $input.attr('data-initialized', '').flatpickr(dataSet);
        });
});
