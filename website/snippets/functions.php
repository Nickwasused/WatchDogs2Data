<?php

function buttonscycle($searchoptions, $returnfile, $page, $valueneeded, $nextpagebutton) {
    #create the default reset button
    echo "<center><button class=\"button button1 resetbutton\"><a href=\"./".$returnfile."\">reset</a></button></center>";
    $number = 0;

    #define neededstring
    $neededstring = "";

    #query the required values
    foreach ($valueneeded as $neededvalue) {
        if (!empty($neededvalue)) {
            #if the needed value is not empty then append it to the string
            $neededstring = $neededstring . "&".$neededvalue."=".getrequest($_REQUEST[$neededvalue])."";
        } else {
            #do nothing
        }
    }

    #query the searchoptions
    foreach ($searchoptions as $value) {
        #if the variable requested is not empty then create the according button for it
        if (!empty($_REQUEST[$value])) {
            if ($nextpagebutton == "true") {
                if ($page==1) {
                    echo "<center><button class=\"button button2\"><a href=\"./$returnfile?".$value."=".$_REQUEST[$value]."".$neededstring."&page=".($page+1)."\">next page</a></button></center>";
                } else {
                    echo "<center><button class=\"button button1\"><a href=\"./$returnfile?".$value."=".$_REQUEST[$value]."".$neededstring."&page=".($page-1)."\">previous page</a></button></center>";
                }
                $number++;
                break;
            } else {
                if ($page==1) { } else {
                    echo "<center><button class=\"button button1\"><a href=\"./$returnfile?".$value."=".$_REQUEST[$value]."".$neededstring."&page=".($page-1)."\">previous page</a></button><button class=\"button button2\"><a href=\"./$returnfile?".$value."=".$_REQUEST[$value]."".$neededstring."&page=".($page+1)."\">next page</a></button></center>";
                }
                $number++;
                break;
            }
        }
    }

    #if a button got created above then do nothing, but when no button got created above then revert to the default buttons
    if ($number===1) {}
    else {
        if ($nextpagebutton == "true") {
            if ($page===1) {
                echo "<center><button class=\"button button2\"><a href=\"./$returnfile?page=".($page+1)."\">next page</a></button></center>";
            } else {
                echo "<center><button class=\"button button1\"><a href=\"./$returnfile?page=".($page-1)."\">previous page</a></button>  <button class=\"button button2\"><a href=\"./$returnfile?page=".($page+1)."\">next page</a></button></center>";
            }
        } else {
            if ($page===1) {} else {
                echo "<center><button class=\"button button1\"><a href=\"./$returnfile?page=".($page-1)."\">previous page</a></button>";
            }
        }
    }
  } 

function getpagesneeded($sum, $items_per_page){
    $pagesneeded = $sum / $items_per_page;
    return $pagesneeded;
}

function pagesystem(){
    $page = 1;
    if(!empty($_GET['page'])) {
        $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        if(false === $page) {
            $page = 1;
        }
    }

    return $page;

}

function getrequest(&$value, $default = null)
{
    #try to get a value by $_REQUEST if empty return null
    return isset($value) ? $value : $default;
}
?>