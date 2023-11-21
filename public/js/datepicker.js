const datePicker = $('.datepicker').datepicker({
    autoclose: true,
    format: 'dd-M-yyyy',
    orientation: 'bottom',
    startDate: '0d'
});
$('.datepicker').on('changeDate', function() {
    this.dispatchEvent(new InputEvent('input'));
});
