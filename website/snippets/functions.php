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
            #if the nextpage button is true then create it
            if ($nextpagebutton == "true") {
                if ($page==1) {
                    echo "<center><button class=\"button button2\"><a href=\"./$returnfile?".$value."=".$_REQUEST[$value]."".$neededstring."&page=".($page+1)."\">next page</a></button></center>";
                } else {
                    echo "<center><button class=\"button button1\"><a href=\"./$returnfile?".$value."=".$_REQUEST[$value]."".$neededstring."&page=".($page-1)."\">previous page</a></button></center>";
                }
                $number++;
                break;
            #if the next page button is false then create the previus page button only
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
        #if the nextpage button is true then create it
        if ($nextpagebutton == "true") {
            if ($page===1) {
                echo "<center><button class=\"button button2\"><a href=\"./$returnfile?page=".($page+1)."\">next page</a></button></center>";
            } else {
                echo "<center><button class=\"button button1\"><a href=\"./$returnfile?page=".($page-1)."\">previous page</a></button>  <button class=\"button button2\"><a href=\"./$returnfile?page=".($page+1)."\">next page</a></button></center>";
            }
        #if the next page button is false then create the previus page button only
        } else {
            if ($page===1) {} else {
                echo "<center><button class=\"button button1\"><a href=\"./$returnfile?page=".($page-1)."\">previous page</a></button>";
            }
        }
    }
  } 

function getpagesneeded($sum, $items_per_page){
    #calculate the pages needed by using the maximum sum e.g. the biggest id divided by the items per page (default: 10)
    #example 31 / 10 = 3.1 pages needed
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

function nextpagebutton($offset, $items_per_page, $pagesneeded){
    if (($offset + $items_per_page) > ($pagesneeded * $items_per_page)) {
        $nextpagebutton = "false";
        return $nextpagebutton;
    } else {
        $nextpagebutton = "true";
        return $nextpagebutton;
    }
}
?>