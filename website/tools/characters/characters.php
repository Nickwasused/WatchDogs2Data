<?php
include("../../snippets/head.php");

$categoryid=$_REQUEST["categoryid"];
$modelname=$_REQUEST["modelname"];
$skip = "false";

$page = 1;
if(!empty($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
    if(false === $page) {
        $page = 1;
    }
}

$searchoptions = array("modelname");
$offset = ($page - 1) * $items_per_page;

if (!empty($modelname)) {
    $command = "SELECT * FROM `charactermodels`,`charactercategorys` WHERE `modelname` LIKE '%".$modelname."%' AND `charactermodels`.`categoryid` = $categoryid AND `charactercategorys`.`categoryid` = $categoryid AND `characterid` >= $offset LIMIT $items_per_page;";
} else if (!empty($categoryid)) {
    $command = "SELECT * FROM `charactermodels`,`charactercategorys` WHERE `charactermodels`.`categoryid` = $categoryid AND `charactercategorys`.`categoryid` = $categoryid AND `characterid` >= $offset LIMIT $items_per_page;";
} else {
    $skip = "true";
}

include("../../snippets/blocksnap.php");
echo "
<a id=\"top\"></a>
<div class=\"contentstart lozad\" data-background-image=\"/images/backgrounds/background3.webp\">
<div class=\"imagefilter\">
<center><button class=\"button button1 resetbutton\"><a href=\"./characters.php?categoryid=".$categoryid."\">reset</a></button></center>";

$number = 0;
foreach ($searchoptions as $value) {
	if (!empty(${$value})) {
		if ($page==1) {
			echo "<center><button class=\"button button2\"><a href=\"./characters.php?categoryid=$categoryid&".$value."=".${$value}."&page=".($page+1)."\">next page</a></button></center>";
		} else {
			echo "<center><button class=\"button button1\"><a href=\"./characters.php?categoryid=$categoryid&".$value."=".${$value}."&page=".($page-1)."\">previous page</a></button><button class=\"button button2\"><a href=\"./characters.php?categoryid=$categoryid&".$value."=".${$value}."&page=".($page+1)."\">next page</a></button></center>";
		}
		$number++;
	}
}

if ($number===1) {}
else {
	if ($page===1) {
		echo "<center><button class=\"button button2\"><a href=\"./characters.php?categoryid=$categoryid&page=".($page+1)."\">next page</a></button></center>";
	} else {
		echo "<center><button class=\"button button1\"><a href=\"./characters.php?categoryid=$categoryid&page=".($page-1)."\">previous page</a></button>  <button class=\"button button2\"><a href=\"./characters.php?categoryid=$categoryid&page=".($page+1)."\">next page</a></button></center>";
	}
}

echo "
<table>
<thead>
<tr>
    <td>category</td>
    <td>modelname</td>
    <td>image</td>
</tr>
<tr>
    <td>
    <form>
        <select name=\"categoryid\" id=\"categoryid\">";
        $charactercategories = "SELECT * FROM `charactercategorys`;";
        foreach ($pdo->query($charactercategories) as $rowcategories)
        {
            echo "<option value=\"".$rowcategories["categoryid"]."\">".$rowcategories["categoryname"]."</option>";
        }
        echo "</select>
        <input class=\"button3\" type=submit>
    </form>
    </td>
    <td>
        <form>
            <input type=hidden name=\"categoryid\" value=\"$categoryid\">
            <input type=text name=\"modelname\">
            <input class=\"button3\" type=submit>
        </form>
    </td>
    <td></td>
</tr>
</thead>
<tbody>";
if ($skip == "false") {
    foreach ($pdo->query($command) as $row)
    {
        $categoryname = "SELECT * FROM `charactercategorys` WHERE `categoryid` = ".$row["categoryid"].";";
        foreach ($pdo->query($categoryname) as $rowcategoryname)
        {
            echo "<tr><td>".$rowcategoryname["categoryname"]."</td>";
        }
        echo "<td><p>".$row["modelname"]."</p></td><td>";
        if ($row['image'] === "1") {
            echo "<picture class=\"lozad\">
                    <source srcset=\"/images/avif/models/".$row["categoryname"]."/".$row["modelname"].".avif\">
                    <source srcset=\"/images/webp/models/".$row["categoryname"]."/".$row["modelname"].".webp\">
                    <img src=\"/images/webp/models/".$row["categoryname"]."/".$row["modelname"].".webp\" alt=\"\"></noscript>
                </picture>";
        } else {
            echo "<img class=\"lozad\" data-src=\"/images/icons/placeholder.svg\"></img>";
        }
        echo "</td></tr>\n";
    }
} else {
    echo "<tr><td>Please filter the result!</td><td></td><td></td></tr>";
}


echo"
</tbody>
</table>
<center><a href=\"#top\"><button class=\"button button3 topbutton\">top</button></a></center>";

$number2 = 0;
foreach ($searchoptions as $value) {
	if (!empty(${$value})) {
		if ($page==1) {
			echo "<center><button class=\"button button2\"><a href=\"./characters.php?categoryid=$categoryid&".$value."=".${$value}."&page=".($page+1)."\">next page</a></button></center>";
		} else {
			echo "<center><button class=\"button button1\"><a href=\"./characters.php?categoryid=$categoryid&".$value."=".${$value}."&page=".($page-1)."\">previous page</a></button><button class=\"button button2\"><a href=\"./characters.php?categoryid=$categoryid&".$value."=".${$value}."&page=".($page+1)."\">next page</a></button></center>";
		}
		$number2++;
	}
}

if ($number2===1) {}
else {
	if ($page===1) {
		echo "<center><button class=\"button button2\"><a href=\"./characters.php?categoryid=$categoryid&page=".($page+1)."\">next page</a></button></center>";
	} else {
		echo "<center><button class=\"button button1\"><a href=\"./characters.php?categoryid=$categoryid&page=".($page-1)."\">previous page</a></button>  <button class=\"button button2\"><a href=\"./characters.php?categoryid=$categoryid&page=".($page+1)."\">next page</a></button></center>";
	}
}

echo "
</div>
</div>
";
include("../../snippets/footer.php");
echo "</body>
</html>";
?>