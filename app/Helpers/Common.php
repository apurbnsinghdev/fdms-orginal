<?php

function str_spacecase($slug) {
    return str_replace(['-', '_'], " ", $slug);
}

function check_menu_active($current_location, $optionsArr) {
    $condition = false;
    list($current['controller'], $current['action']) = explode('@', $current_location);
    if (in_array($current_location, $optionsArr) == true || in_array($current['controller'], $optionsArr) == true) {
        $condition = true;
    }
    if ($condition == true) {
        return ' open-item';
    } else {
        return ' close-item';
    }
}

//show value with format
function showDateWithFormat($value) {
    return Carbon\Carbon::parse($value)->format('d/m/Y H:i');
}
//get value from input field
function getDateFormInput($value) {
    return Carbon\Carbon::parse($value)->format('Y-m-d');
}

function mystudy_case($value) {
    return ucwords(str_replace(['-', '_'], ' ', $value));
}

function isMenuRender($needle, $haystackArr) {
    if (is_array($needle)) {
        $result = array_intersect($needle, $haystackArr);
        if (count($result) > 0) {
            return true;
        }
    } else {
        if (in_array($needle, $haystackArr)) {
            return true;
        }
    }
    return false;
}

//get file name omiting/ignore un utf carecter
function get_file_name($string) {
    // Transliterate non-ascii characters to ascii
    $str = trim(strtolower($string));
    $str = iconv('UTF-8', 'ISO-8859-1//IGNORE', $str);

    // Do other search and replace
    $searches = array(' ', '&', '/');
    $replaces = array('-', 'and', '-');
    $str = str_replace($searches, $replaces, $str);

    // Make sure we don't have more than one dash together because that's ugly
    $str = preg_replace("/(-{2,})/", "-", $str);

    // Remove all invalid characters
    $str = preg_replace("/[^A-Za-z0-9-.]/", "", $str);

    // Done!
    return $str;
}

function getLists($collection, $depot_id) {
    foreach ($collection as $key => $value) {
        if ($value->depot_id == $depot_id) {
            return $value->allocation_details->pluck('qty', 'stock_detail_id');
        }
    }
}

// $n indicates how many characters you want ex: 1 => 0001
function number_pad($number, $n) {
    return str_pad((int) $number, $n, "0", STR_PAD_LEFT);
}

//delete array element by value
function deleteElement($element, &$array) {
    $index = array_search($element, $array);
    if ($index !== false) {
        unset($array[$index]);
    }
}

function number_to_word($num = '') {
    $num = (string) ((int) $num);

    if ((int) ($num) && ctype_digit($num)) {
        $words = array();

        $num = str_replace(array(',', ' '), '', trim($num));

        $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven',
            'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen',
            'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen');

        $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty',
            'seventy', 'eighty', 'ninety', 'hundred');

        $list3 = array('', 'thousand', 'million', 'billion', 'trillion',
            'quadrillion', 'quintillion', 'sextillion', 'septillion',
            'octillion', 'nonillion', 'decillion', 'undecillion',
            'duodecillion', 'tredecillion', 'quattuordecillion',
            'quindecillion', 'sexdecillion', 'septendecillion',
            'octodecillion', 'novemdecillion', 'vigintillion');

        $num_length = strlen($num);
        $levels = (int) (($num_length + 2) / 3);
        $max_length = $levels * 3;
        $num = substr('00' . $num, -$max_length);
        $num_levels = str_split($num, 3);

        foreach ($num_levels as $num_part) {
            $levels--;
            $hundreds = (int) ($num_part / 100);
            $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ($hundreds == 1 ? '' : 's') . ' ' : '');
            $tens = (int) ($num_part % 100);
            $singles = '';

            if ($tens < 20) {
                $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
            } else {
                $tens = (int) ($tens / 10);
                $tens = ' ' . $list2[$tens] . ' ';
                $singles = (int) ($num_part % 10);
                $singles = ' ' . $list1[$singles] . ' ';
            }
            $words[] = $hundreds . $tens . $singles . (($levels && (int) ($num_part)) ? ' ' . $list3[$levels] . ' ' : '');
        }

        $commas = count($words);

        if ($commas > 1) {
            $commas = $commas - 1;
        }

        $words = implode(', ', $words);

        //Some Finishing Touch
        //Replacing multiples of spaces with one space
        $words = trim(str_replace(' ,', ',', trim_all(ucwords($words))), ', ');
        if ($commas) {
            $words = str_replace_last(',', ' and', $words);
        }

        return $words;
    } else if (!((int) $num)) {
        return 'Zero';
    }
    return '';
}
function trim_all($str, $what = NULL, $with = ' ') {
    if ($what === NULL) {
        //  Character      Decimal      Use
        //  "\0"            0           Null Character
        //  "\t"            9           Tab
        //  "\n"           10           New line
        //  "\x0B"         11           Vertical Tab
        //  "\r"           13           New Line in Mac
        //  " "            32           Space

        $what = "\\x00-\\x20"; //all white-spaces and control chars
    }

    return trim(preg_replace("/[" . $what . "]+/", $with, $str), $what);
}
?>