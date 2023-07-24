$(document).ready(function() {
    $(document).on("click", ".account__menu--list a", function() {
        let id = $(this).attr("id");
        console.log(id);
        $(`.menu_item_${id}`).toggle();
        if($(`.menu_item_${id}`).is(':visible')) {
            $(`.account__menu--list`).not('.account__menu--list_item').removeClass('active');
            $(`#${id}`).parent().addClass('active');
            $(`.account__menu_item`).not(`.menu_item_${id}`).hide();
        } else {
            $(`#${id}`).parent().removeClass('active');
        }
    });
})