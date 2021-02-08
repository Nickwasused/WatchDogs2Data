<?php
function buttonscycle($searchoptions, $returnfile, $page) {
    echo "<center><button class=\"button button1 resetbutton\"><a href=\"./".$returnfile."\">reset</a></button></center>";
    $number = 0;
    foreach ($searchoptions as $value) {
        if (!empty($_REQUEST[$value])) {
            if ($page==1) {
                echo "<center><button class=\"button button2\"><a href=\"./$returnfile?".$value."=".$_REQUEST[$value]."&page=".($page+1)."\">next page</a></button></center>";
            } else {
                echo "<center><button class=\"button button1\"><a href=\"./$returnfile?".$value."=".$_REQUEST[$value]."&page=".($page-1)."\">previous page</a></button><button class=\"button button2\"><a href=\"./$returnfile?".$value."=".$_REQUEST[$value]."&page=".($page+1)."\">next page</a></button></center>";
            }
            $number++;
        }
    }

    if ($number===1) {}
    else {
        if ($page===1) {
            echo "<center><button class=\"button button2\"><a href=\"./$returnfile?page=".($page+1)."\">next page</a></button></center>";
        } else {
            echo "<center><button class=\"button button1\"><a href=\"./$returnfile?page=".($page-1)."\">previous page</a></button>  <button class=\"button button2\"><a href=\"./$returnfile?page=".($page+1)."\">next page</a></button></center>";
        }
    }
  } 
?>