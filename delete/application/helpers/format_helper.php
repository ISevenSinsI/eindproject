<?php

function format_date_to_european($date) {

    if($date == "0000-00-00")
    {
        return "N.v.t.";
    }

    $date = strtotime($date);
    return date("d-m-Y", $date);
}

function format_date_to_european_special($date) {

    if($date == "0000-00-00")
    {
        return "N.v.t.";
    }

     $date = strtotime($date);
    $date = date("D j M", $date);

    $new_date = str_replace("Mon", "Ma", $date);
    $new_date = str_replace("Tue", "Di", $new_date);
    $new_date = str_replace("Wed", "Wo", $new_date);
    $new_date = str_replace("Thu", "Do", $new_date);
    $new_date = str_replace("Fri", "Vr", $new_date);
    $new_date = str_replace("Sat", "Za", $new_date);
    $new_date = str_replace("Sun", "Zo", $new_date);

    $new_date = str_replace("May", "Mei", $new_date);
    $new_date = str_replace("Oct", "Okt", $new_date);

    return $new_date;
}

function format_date_to_american($date) {
    $date = strtotime($date);
    return date("Y-m-d", $date);
}

function format_datetime_to_european($date) {
    $date = strtotime($date);
    $date = date("d-m-Y - H:i", $date);

    $new_date = str_replace("Mon", "Ma", $date);
    $new_date = str_replace("Tue", "Di", $new_date);
    $new_date = str_replace("Wed", "Wo", $new_date);
    $new_date = str_replace("Thu", "Do", $new_date);
    $new_date = str_replace("Fri", "Vr", $new_date);
    $new_date = str_replace("Sat", "Za", $new_date);
    $new_date = str_replace("Sun", "Zo", $new_date);

    $new_date = str_replace("May", "Mei", $new_date);
    $new_date = str_replace("Oct", "Okt", $new_date);

    return $new_date;
}

function format_datetime_to_american($date) {
    $date = strtotime($date);
    return date("Y-m-d H:i:s", $date);
}

function format_time_to_european($date) {
    $date = strtotime($date);
    return date("H:i:s", $date);
}

function format_time_to_european_with_no_seconds($date) {
    $date = strtotime($date);
    return date("H:i", $date);
}

function reverse_number_format($number)
{
    $pattern_dot = "/(\.[0-9]{1,2})$/";
    $pattern_comma = "/(,[0-9]{1,2})$/";
  
    switch(true)
    {
        case preg_match($pattern_dot, $number):
            return str_replace(',', '', $number);
            break;
        case preg_match($pattern_comma, $number):
            $number = str_replace('.', '', $number);
            return str_replace(',', '.', $number);                
            break;
    }
    
    
    return $number;
}

function format_to_money($amount) {
    return number_format($amount, 2, ',', '.');
}

?>