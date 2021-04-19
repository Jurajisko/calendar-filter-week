$(document).ready(function()
{
    // Materialize
    $('select').formSelect();

    $("[name=reset]").click(function()
    {
        window.location.href = window.location.href.split('?')[0];
    });

    $("[name=load-events]").click(function()
    {
        let month = $('.months').val(),
             year = $('.years').val(),
             week = $('.week').val();

        if( month == null )
            {
                alert('Please, Select a month');
            }
    else if( year == null ) 
            {
                alert('Please, Select a year');
            }
       else {
                // Adding 0 before single / one digit (0-9)
                (month.length < 2) ? month = '0' + month : month = month;
                location.href = `?month=${month}&year=${year}&week=${week}`;
            }
    });

    selectedWeek = $('.week').val();
            if( selectedWeek != "Full" )
            {
                $('table tr').fadeOut(100, () =>
                {
                    // Fade In The Headers
                    $('table tr').eq(0).fadeIn(500);

                    // Fade In Only the Selected Week (ROW)
                    $('table tr').eq(selectedWeek).fadeIn(500);
                });
            }
            else 
            {
                false;
            }
});