<?php
    function build_calendar( $month, $year ) 
    {
        if ( !$month || !$year ) {
            $month = date('m');
            $year = date('Y');
        }

        // Create array containing the names of days of week
            $days_in_week = array( 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN' );

        // What's the first day of the selected month
            $firstDayOfMonth = mktime( 0, 0, 0, $month, 1, $year );

        // How many days does this month contain
            $total_days = date( 't', $firstDayOfMonth );

        // Get some information about the first day of the selected month
            $first_day_info = getdate( $firstDayOfMonth );

        // Get the name of selected month
            $name_of_month = $first_day_info['month'];

        // Get the position / index value of the first day of selected month
            $first_day_of_week = intval( $first_day_info['wday'] ) - 1;

        // Create the table and add the name of days as headers
            $calendar  = "<table class='calendar responsive-table centered highlight col s12'>";
            $calendar .= "<caption>$name_of_month $year</caption>";
            $calendar .= "<tr>";

        // Calendar headers
            foreach( $days_in_week as $day ):
                $calendar .= "<th class='header'>$day</th>";
            endforeach;

        // Close the row and create the rest of the Calendar
            $calendar .= "</tr>";

        // There's an error , if the first day of month is the last day of week then
        // the calendar will be generated like this
            /***** Solution *****/
            if( $first_day_of_week == -1 ):
                $first_day_of_week = 6;
            endif;

        // Placing the first day of selected month in the right place using the empty / white spaces (colspan)
            if( $first_day_of_week > 0 ) : $calendar .= "<td colspan='$first_day_of_week'></td>"; endif;

        // Initiate day counter
            $currentday = 1;

            while( $currentday <= $total_days ):

            // If seventh columne reached then start a new row
                if( $first_day_of_week == 7 ) : $first_day_of_week = 0; 
                    $calendar .= "</tr><tr>"; 
                endif;

            // This is optional (Adding 0 before single / one digit (0-9))
                $showcurrentDay = ( strlen($currentday) < 2 ) ? "0" . $currentday : $currentday;
                $date = "$year-$month-$showcurrentDay";

                    $calendar .= "<td class='day' rel='$date'>" . $showcurrentDay . "</td>";
                
                $currentday++;
                $first_day_of_week++;

            endwhile;

        // Complete the row of the oast week in month
            if( $first_day_of_week != 7 ):
                $remainingDays = 7 - $first_day_of_week;
                    $calendar .= "<td colspan='$remainingDays'>&nbsp;</td>";
            endif;

            $calendar .= "</tr>";
            $calendar .= "</table>";
            
        return $calendar;
    }

    //echo build_calendar( date('m'), date('Y') );

