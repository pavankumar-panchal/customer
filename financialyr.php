<?php
echo(calculateFiscalYearForDate(date("m/d/y"), "4/1", "3/31"));

function calculateFiscalYearForDate($inputDate, $fyStart, $fyEnd)
    {
        $date = strtotime($inputDate);
        $inputyear = strftime('%Y',$date);

        $fystartdate = strtotime($fyStart."/".$inputyear);
        $fyenddate = strtotime($fyEnd."/".$inputyear);

        if($date < $fyenddate){
            $fy = (intval(intval($inputyear) - 1).'-'.intval($inputyear));
        }else{
            $fy = (intval($inputyear).'-'.intval(intval($inputyear) + 1));
        }
        return $fy;
    }
?>