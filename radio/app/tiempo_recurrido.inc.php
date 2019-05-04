<?php

class Tiempo{

function tiempo_recurrido($tiempo_tamp)
    {   
        $date = date_create($tiempo_tamp);
        $time1 =  date_format($date, 'd M Y g:i A');
        
        $tiempo_i = strtotime($tiempo_tamp);
        $time = strtotime("now");
        $tiempo_g = time() - $tiempo_i;
        $tiempo_f = $tiempo_g - 21600;
        
        
        if ($tiempo_f == 0) 
             return 'justo ahora';
 
        if ($tiempo_f > 2628000)
            return date("d M Y",$tiempo_i);
 
        $intervals = array
        (
            //1                   => array('año',    31556926),
           // $tiempo_f < 31556926    => array('mes',   2628000),
            $tiempo_f < 2629744     => array('semana',    604800),
            $tiempo_f < 604800      => array('día',     86400),
            $tiempo_f < 86400       => array('hora',    3600),
            $tiempo_f < 3600        => array('minuto',  60),
            $tiempo_f < 60          => array('segundo',  1)
        );
       
        $value = floor($tiempo_f/$intervals[1][1]);
        return 'hace '.$value.' '.$intervals[1][0].($value > 1 ? 's' : '');
   }
}