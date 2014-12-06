<?php
function __($date)
{
    $data = array
    (
        'january' => 'januari',
        'February' => 'februari',
        'March' => 'maart',
        'April' => 'april',
        'May' => 'mei',
        'June' => 'juni',
        'July' => 'juli',
        'August' => 'augustus',
        'September' => 'september',
        'October' => 'oktober',
        'November' => 'november',
        'December' => 'december',
        
        'Monday' => 'maandag',
        'Tuesday' => 'dinsdag',
        'Wednesday' => 'woensdag',
        'Thursday' => 'donderdag',
        'Friday' => 'vrijdag',
        'Saturday' => 'zaterdag',
        'Sunday' => 'zondag',
        
        'Mon' => 'Ma',
        'Tue' => 'Di',
        'Wed' => 'Wo',
        'Thu' => 'Do',
        'Fri' => 'Vr',
        'Sat' => 'Za',
        'Sun' => 'Zo',
        
        'Jan' => 'jan',
        'Feb' => 'feb',
        'Mar' => 'mrt',
        'Apr' => 'apr',
        'May' => 'mei',
        'Jun' => 'jun',
        'Jul' => 'jul',
        'Aug' => 'aug',
        'Sep' => 'sep',
        'Oct' => 'okt',
        'Nov' => 'nov',
        'Dec' => 'dec',
    );

    return str_replace(array_keys($data), array_values($data), $date);
}
?>
