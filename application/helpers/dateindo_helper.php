<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('date_indo')){

  function date_indo($date){
    $tanggal = substr($date,8,2);
    $bulan = getBulan(substr($date,5,2));
    $tahun = substr($date,0,4);
    return $tanggal.' '.$bulan.' '.$tahun;
  }
  function tanggal_indo($tanggal){
  $bulan = array (1 =>   'มกราคม',
        'กุมภาพันธ์',
        'มีนาคม',
        'เมษายน',
        'พฤษภาคม',
        'มิถุนายน',
        'กรกฎาคม',
        'สิงหาคม',
        'กันยายน',
        'ตุลาคม',
        'พฤศจิกายน',
        'ธันวาคม'
      );
    // $bulan = array (1 =>   'January',
    //     'February',
    //     'March',
    //     'April',
    //     'May',
    //     'June',
    //     'July',
    //     'August',
    //     'September',
    //     'October',
    //     'November',
    //     'December'
    //   );
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
  }
  function hari_indo($day){
    // $hari = array ( 1 =>    'Monday',
    //   'Tuesday',
    //   'Wednesday',
    //   'Thursday',
    //   'Friday',
    //   'Saturday',
    //   'Sunday'
    // );
    $hari = array ( 1 =>    'จันทร์',
      'อังคาร',
      'พุธ',
      'พฤหัสบดี',
      'ศุกร์',
      'เสาร์',
      'อาทิตย์'
    );
    return $hari[$day];
  }
  function tanggal_ing($tanggal1){
  $bulan1 = array (1 =>   
        'January',
        'February',
          'March',
       'April',
         'May',
         'June',
          'July',
            'August',
           'September',
           'October',
         'November',
            'December'
      );
    $split1 = explode('-', $tanggal1);
    return $split1[2] . ' ' . $bulan1[ (int)$split1[1] ] . ' ' . $split1[0];
  }
  function hari_ing($day1){
    $hari1 = array ( 1 =>    'Monday',
      'Tuesday',
      'Wednesday',
      'Thursday',
      'Friday',
      'Saturday',
      'Sunday'
    );
    return $hari1[$day1];
  }
  function getBulan($bln){
    switch ($bln){
      case 1:
	    return "January";
	    break;
	  case 2:
	    return "February";
	    break;
	  case 3:
	    return "March";
	    break;
	  case 4:
	    return "April";
	    break;
	  case 5:
	    return "May";
	    break;
	  case 6:
	    return "June";
	    break;
	  case 7:
	    return "July";
	    break;
	  case 8:
	    return "August";
	    break;
	  case 9:
	    return "September";
	    break;
	  case 10:
	    return "October";
	    break;
	  case 11:
	    return "November";
	    break;
	  case 12:
	    return "December";
	    break;
    }
  }
  
  function date_str($date){
    $exp = explode('-',$date);
    if(count($exp) == 3) {
	  $date = $exp[2].'-'.$exp[1].'-'.$exp[0];
    }
    return $date;
  }
  
  function name_hari(){
    $seminggu = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
    $hari = date("w");
    $hari_ini = $seminggu[$hari];
    return $hari_ini;
  }
  function time_since($original)
{
  date_default_timezone_set('Asia/Jakarta');
  $chunks = array(
      array(60 * 60 * 24 * 365, 'year'),
      array(60 * 60 * 24 * 30, 'month'),
      array(60 * 60 * 24 * 7, 'week'),
      array(60 * 60 * 24, 'day'),
      array(60 * 60, 'hour'),
      array(60, 'minute'),
  );
 
  $today = time();
  $since = $today - $original;
 
  if ($since > 604800)
  {
    $print = date("M jS", $original);
    if ($since > 31536000)
    {
      $print .= ", " . date("Y", $original);
    }
    return $print;
  }
 
  for ($i = 0, $j = count($chunks); $i < $j; $i++)
  {
    $seconds = $chunks[$i][0];
    $name = $chunks[$i][1];
 
    if (($count = floor($since / $seconds)) != 0)
      break;
  }
 
  $print = ($count == 1) ? '1 ' . $name : "$count {$name}";
  return $print . ' ago';
}
}
?>
