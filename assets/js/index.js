jQuery(document).ready(function ($) {

    let item_row = 1;
    
    $('#row_plus').click(function (e) {

        e.preventDefault();

        item_row++;

        let list = $('#comp_rows'),
            item = list.find('.comp_row').first().clone();

        item.find('select')
            .attr('name', item.find('select').attr('name') + '_' + item_row)
            .val('');

        item.find('input').map((index, input) => {

            let new_input_name = input.getAttribute('name') + '_' + item_row;
            input.setAttribute('name', new_input_name);
            input.value = '';
        });

        list.append( item );
    });

    $('#row_minus').on('click', function (e) {

        e.preventDefault();
        
        item_row--;

        if ($('.comp_row').length > 1) {
            
            $('#comp_rows').find('.comp_row').last().remove();
        } else {
            $('#comp_rows').find('.comp_row').find('input').val('');
        }
    });

});