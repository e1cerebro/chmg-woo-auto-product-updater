jQuery(document).ready(function($) {

    $('#update-store-btn').on('click', function() {
        $('#update-store').submit();
        $(this).slideDown();
        $('.processing-img').removeClass('hide-img');
    });

    jQuery(".chosen-select").chosen();

});