$(document).on('ajaxComplete ready', function () {

    // Initialize inputs
    $('input[data-provides="anomaly.field_type.datetime"]:not([data-initialized])')
        .each(function () {

            var $input = $(this);
            var dataSet;

            if ($input.length) {
              dataSet = $input[0].dataSet;
            }

            $input.attr('data-initialized', '')
                .flatpickr({
                    enableTime: true,
                    // altInput: true,
                    dateFormat: $input.data('datetime-format') || 'j F, Y H:i',
                    minDate: 'today',
                    minuteIncrement: 15,
                });
        });
});
