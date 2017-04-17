$(document).on('ajaxComplete ready', function () {

    // Initialize inputs
    $('input[data-provides="defr.field_type.flatpickr"]:not([data-initialized])')
        .each(function () {

            var $input = $(this);
            var data = this.dataset;
            var dataSet = {};
            var value;

            var mutateValue = function (value, key) {
                if (key.endsWith('Increment')) {
                    return Number(value);
                }
                if (['', '0', '1'].includes(value)) {
                    return Boolean(Number(value));
                }
                return value;
            };

            var updateInput = function (selectedDates, dateStr) {
                $input.val(dateStr);
            };

            for (var key in data) {
                if (data.hasOwnProperty(key)) {
                    value = mutateValue(data[key], key);

                    dataSet[key] = value;
                }
            }

            dataSet['onReady'] = function (selectedDates, dateStr, instance) {
                instance.setDate($input.val(), true);
                $input.attr('data-initialized', 'data-initialized');
            };

            dataSet['onChange'] = updateInput;
            dataSet['onClose'] = updateInput;

            $input.siblings('input[type="text"]').flatpickr(dataSet);
        });
});
