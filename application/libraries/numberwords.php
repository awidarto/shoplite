<?php

class Numberwords {


	function __construct()
	{

	}

	function to_words($number,$locale = 'id') {
	    
	    if($locale == 'en'){
		    $hyphen      = '-';
		    $conjunction = ' and ';
		    $separator   = ', ';
		    $negative    = 'negative ';
		    $decimal     = ' point ';
		    $dictionary  = array(
		        0                   => 'zero',
		        1                   => 'one',
		        2                   => 'two',
		        3                   => 'three',
		        4                   => 'four',
		        5                   => 'five',
		        6                   => 'six',
		        7                   => 'seven',
		        8                   => 'eight',
		        9                   => 'nine',
		        10                  => 'ten',
		        11                  => 'eleven',
		        12                  => 'twelve',
		        13                  => 'thirteen',
		        14                  => 'fourteen',
		        15                  => 'fifteen',
		        16                  => 'sixteen',
		        17                  => 'seventeen',
		        18                  => 'eighteen',
		        19                  => 'nineteen',
		        20                  => 'twenty',
		        30                  => 'thirty',
		        40                  => 'fourty',
		        50                  => 'fifty',
		        60                  => 'sixty',
		        70                  => 'seventy',
		        80                  => 'eighty',
		        90                  => 'ninety',
		        100                 => 'hundred',
		        1000                => 'thousand',
		        1000000             => 'million',
		        1000000000          => 'billion',
		        1000000000000       => 'trillion',
		        1000000000000000    => 'quadrillion',
		        1000000000000000000 => 'quintillion'
		    );

	}else if($locale == 'id'){

	    $hyphen      = ' ';
	    $conjunction = ' ';
	    $separator   = ', ';
	    $negative    = 'minus ';
	    $decimal     = ' koma ';
	    $dictionary  = array(
	        0                   => 'nol',
	        1                   => 'satu',
	        2                   => 'dua',
	        3                   => 'tiga',
	        4                   => 'empat',
	        5                   => 'lima',
	        6                   => 'enam',
	        7                   => 'tujuh',
	        8                   => 'delapan',
	        9                   => 'sembilan',
	        10                  => 'sepuluh',
	        11                  => 'sebelas',
	        12                  => 'dua belas',
	        13                  => 'tiga belas',
	        14                  => 'empat belas',
	        15                  => 'lima belas',
	        16                  => 'enam belas',
	        17                  => 'tujuh belas',
	        18                  => 'delepan belas',
	        19                  => 'sembilan belas',
	        20                  => 'dua puluh',
	        30                  => 'tiga puluh',
	        40                  => 'empat puluh',
	        50                  => 'lima puluh',
	        60                  => 'enam puluh',
	        70                  => 'tujuh puluh',
	        80                  => 'delapan puluh',
	        90                  => 'sembilan puluh',
	        100                 => 'ratus',
	        1000                => 'ribu',
	        1000000             => 'juta',
	        1000000000          => 'milyar',
	        1000000000000       => 'trilyun',
	        1000000000000000    => 'quadrillion',
	        1000000000000000000 => 'quintillion'
	    );

	}

	    
	    if (!is_numeric($number)) {
	        return false;
	    }
	    
	    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
	        // overflow
	        trigger_error(
	            'to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
	            E_USER_WARNING
	        );
	        return false;
	    }

	    if ($number < 0) {
	        return $negative . $this->to_words(abs($number),$locale);
	    }
	    
	    $string = $fraction = null;
	    
	    if (strpos($number, '.') !== false) {
	        list($number, $fraction) = explode('.', $number);
	    }
	    
	    switch (true) {
	        case $number < 21:
	            $string = $dictionary[$number];
	            break;
	        case $number < 100:
	            $tens   = ((int) ($number / 10)) * 10;
	            $units  = $number % 10;
	            $string = $dictionary[$tens];
	            if ($units) {
	                $string .= $hyphen . $dictionary[$units];
	            }
	            break;
	        case $number < 1000:
	            $hundreds  = $number / 100;
	            $remainder = $number % 100;
	            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
	            if ($remainder) {
	                $string .= $conjunction . $this->to_words($remainder,$locale);
	            }
	            break;
	        default:
	            $baseUnit = pow(1000, floor(log($number, 1000)));
	            $numBaseUnits = (int) ($number / $baseUnit);
	            $remainder = $number % $baseUnit;
	            $string = $this->to_words($numBaseUnits,$locale) . ' ' . $dictionary[$baseUnit];
	            if ($remainder) {
	                $string .= $remainder < 100 ? $conjunction : $separator;
	                $string .= $this->to_words($remainder,$locale);
	            }
	            break;
	    }
	    
	    if (null !== $fraction && is_numeric($fraction)) {
	        $string .= $decimal;
	        $words = array();
	        foreach (str_split((string) $fraction) as $number) {
	            $words[] = $dictionary[$number];
	        }
	        $string .= implode(' ', $words);
	    }
	    
	    return $string;
	}

}

?>