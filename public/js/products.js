(function ($) {
    "use strict";

    $(document).on('click', '[data-attr-add]', function(event){
        event.preventDefault();

        var temp = '[data-attr-temp]';
        var list = '[data-attr-list]';

        var itemsCount = $('._attr-item').length;

        var clone = $(temp).first().clone().appendTo(list)
            .removeClass('d-none')
            .removeAttr('data-attr-temp')
            .addClass('_attr-item')
            .attr('id', 'item' + itemsCount);

        clone.find('.custom-select').attr('name', 'attributes[' + itemsCount + '][id]');
        clone.find('.form-control').attr('name', 'attributes[' + itemsCount + '][value]').prop('required',true);
        clone.find('[data-attr-remove]').attr('data-attr-remove', '#item' + itemsCount);

        return false;
    });

    $(document).on('click', '[data-attr-remove]', function(event){
        event.preventDefault();

        var itemID = $(event.target).attr('data-attr-remove');

        $(itemID).remove();

        return false;
    });

})(jQuery);
