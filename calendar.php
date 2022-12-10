<?php
function build_calendar($month, $year, $open = null)
{
    // Create array containing the names of days of week
    $days_in_week = array('Pondelok', 'Utorok', 'Streda', 'Štvrtok', 'Piatok', 'Sobota', 'Nedeľa', 'Týždeň');

    // What's the first day of the selected month
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    // How many days does this month contain
    $total_days = date('t', $firstDayOfMonth);

    // Get some information about the first day of the selected month
    $first_day_info = getdate($firstDayOfMonth);

    // Get the name of selected month
    $name_of_month = $first_day_info['month'];

    // Get the position / index value of the first day of selected month
    $first_day_of_week = intval($first_day_info['wday']) - 1;
    // Today
    $today = date('Y-m-j', time());

    //Week
    $week_title_num = date("W");

    // Create the table and add the name of days as headers
    $calendar = "<table id='check_week' class='calendar responsive-table centered highlight col s12' data-month='$month' data-year='$year'>";
    $calendar .= "<caption>$name_of_month $year | <span>$week_title_num.</span> týždeň</caption>";
    $calendar .= "<tr>";

    // Calendar headers
    foreach ($days_in_week as $day) :
        $calendar .= "<th class='header'>$day</th>";
    endforeach;

    // Close the row and create the rest of the Calendar
    $calendar .= "</tr>";

    // There's an error , if the first day of month is the last day of week then
    // the calendar will be generated like this
    /***** Solution *****/
    if ($first_day_of_week == -1) :
        $first_day_of_week = 6;
    endif;

    // Placing the first day of selected month in the right place using the empty / white spaces (colspan)
    if ($first_day_of_week > 0) : $calendar .= "<td colspan='$first_day_of_week'></td>";
    endif;

    // Initiate day counter
    $currentday = 1;

    while ($currentday <= $total_days) :

        // This is optional (Adding 0 before single / one digit (0-9))
        $showcurrentDay = (strlen($currentday) < 2) ? "0" . $currentday : $currentday;
        $date = "$year-$month-$showcurrentDay";

        $day_from_week = (strlen($currentday) < 2) ? "0" . $currentday - 1 : $currentday - 1;
        $ddate = "$year-$month-$day_from_week";
        $new_date = new DateTime($ddate);
        $week = $new_date->format("W");
        $id_week = "$week-$year";


        // If seventh columne reached then start a new row
        if ($first_day_of_week == 7) : $first_day_of_week = 0;

            /* add class for sign of CHECK week */
            $class_n = null;
            foreach ($open['check_week'] as $open_week) {
                if ($id_week == $open_week)
                    $class_n = ' check';
            }

            $calendar .= "
                <td class='week$class_n' data-week='$week'>
                    <input id='$id_week' type='checkbox' name='week-check'  />
                    $week.
                </td>
                </tr>
            <tr>";
        endif;

        if ($today == $date) {
            $calendar .= '<td class="day today" rel=' . $date . '>
                            <a class="event" href="#">
                                <div>' . $showcurrentDay . '.</div>
                                <div></div>
                            </a>
                        </td>';
        } else if ($today > $date) {
            $calendar .= '<td class="day last" rel=' . $date . '>' . $showcurrentDay . '.</td>';
        } else {
            $calendar .= '<td class="day" data-week="' . $first_day_of_week . '" rel=' . $date . '>' . $showcurrentDay  . '.</td>';
        }

        $currentday++;
        $first_day_of_week++;

    endwhile;

    // Complete the row of the oast week in month
    if ($first_day_of_week != 7) :
        $remainingDays = 7 - $first_day_of_week;
        $calendar .= '<td colspan=' . $remainingDays . '>&nbsp;</td>';

        /* add class for sign of CHECK week */
        $class_n = null;
        foreach ($open['check_week'] as $open_week) {
            if ($id_week == $open_week)
                $class_n = ' check';
        }

        $remainingDays = 8 - $first_day_of_week;
        $calendar .= "
        <td class='week$class_n' colspan='$remainingDays' data-week='$week'>
            <input id='$week-$year' type='checkbox' name='week-check' />
            $week.
        </td>";
    endif;

    $calendar .= "</tr>";
    $calendar .= "</table>";

    return $calendar;
}

//echo build_calendar( date('m'), date('Y') );
