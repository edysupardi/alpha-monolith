<?php

namespace App\Traits;

trait PrintLog
{
    function pre($data){
        echo '<pre>'.print_r($data, 1).'</pre>';
    }

    function preDie($data){
        $this->pre($data);
        die();
    }
}
