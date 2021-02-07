<?php
include("../../snippets/head.php");

$lmalayer=$_REQUEST["lmalayer"];
$lmalayercategoryid=$_REQUEST["lmalayercategoryid"];

$page = 1;
if(!empty($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
    if(false === $page) {
        $page = 1;
    }
}

$searchoptions = array("lmalayer", "lmalayercategoryid");
$offset = ($page - 1) * $items_per_page;

if (!empty($lmalayer)) {
    $command = "SELECT * FROM `lmalayers` WHERE `lmalayer` LIKE '%".$lmalayer."%' AND `lmalayerid` >= $offset LIMIT $items_per_page;";
} else if (!empty($lmalayercategoryid)) {
    $command = "SELECT * FROM `lmalayers` WHERE `lmalayercategory` = $lmalayercategoryid AND `lmalayerid` >= $offset LIMIT $items_per_page;";
} else {
    $command = "SELECT * FROM `lmalayers` WHERE `lmalayerid` >= $offset LIMIT $items_per_page;";
}

include("../../snippets/blocksnap.php");
echo "
<a id=\"top\"></a>
<div class=\"contentstart lozad\" data-background-image=\"/images/backgrounds/background3.webp\">
<div class=\"imagefilter\">
<center><button class=\"button button1 resetbutton\"><a href=\"./lmalayers.php\">reset</a></button></center>";

$number = 0;
foreach ($searchoptions as $value) {
	if (!empty(${$value})) {
		if ($page==1) {
			echo "<center><button class=\"button button2\"><a href=\"./lmalayers.php?".$value."=".${$value}."&page=".($page+1)."\">next page</a></button></center>";
		} else {
			echo "<center><button class=\"button button1\"><a href=\"./lmalayers.php?".$value."=".${$value}."&page=".($page-1)."\">previous page</a></button><button class=\"button button2\"><a href=\"./lmalayers.php?".$value."=".${$value}."&page=".($page+1)."\">next page</a></button></center>";
		}
		$number++;
	}
}

if ($number===1) {}
else {
	if ($page===1) {
		echo "<center><button class=\"button button2\"><a href=\"./lmalayers.php?page=".($page+1)."\">next page</a></button></center>";
	} else {
		echo "<center><button class=\"button button1\"><a href=\"./lmalayers.php?page=".($page-1)."\">previous page</a></button>  <button class=\"button button2\"><a href=\"./lmalayers.php?page=".($page+1)."\">next page</a></button></center>";
	}
}

echo "
<table>
<thead>
<tr>
    <td>category</td>
    <td>layername</td>
    <td>location</td>
    <td>image</td>
</tr>
<tr>
    <td>
    <form>
        <select name=\"lmalayercategoryid\" id=\"lmalayercategoryid\">";
        $lmalayercategories = "SELECT * FROM `lmalayercategories`;";
        foreach ($pdo->query($lmalayercategories) as $rowcategories)
        {
            echo "<option value=\"".$rowcategories["lmalayercategoryid"]."\">".$rowcategories["lmacategoryname"]."</option>";
        }
        echo "</select>
        <input class=\"button3\" type=submit>
    </form>
    </td>
    <td>
        <form>
            <input type=text name=\"lmalayer\">
            <input class=\"button3\" type=submit>
        </form>
    </td>
    <td></td>
    <td></td>
</tr>
</thead>
<tbody>";
	
foreach ($pdo->query($command) as $row)
{
    $categoryname = "SELECT * FROM `lmalayercategories` WHERE `lmalayercategoryid` = ".$row["lmalayercategory"].";";
    foreach ($pdo->query($categoryname) as $rowcategoryname)
    {
        echo "<tr><td>".$rowcategoryname["lmacategoryname"]."</td>";
    }
    echo "<td><p>".$row["lmalayer"]."</p></td>";

    if (!empty($row["lmalocation"])) {
        echo "<td><p>".$row["lmalocation"]."</p></td>";
    } else {
        echo "<td></td>";
    }

    echo "<td>";

    if ($row['image'] === "1") {
    echo "<a href=\"/images/webp/lmalayers/".$rowcategoryname["lmacategoryname"]."/".$row["lmalayer"].".webp\" target=\"_blank\">
            <picture class=\"lozad\">
                    <source srcset=\"/images/avif/lmalayers/".$rowcategoryname["lmacategoryname"]."/".$row["lmalayer"].".avif\">
                    <source srcset=\"/images/webp/lmalayers/".$rowcategoryname["lmacategoryname"]."/".$row["lmalayer"].".webp\">
                    <img src=\"/images/webp/lmalayers/".$rowcategoryname["lmacategoryname"]."/".$row["lmalayer"].".webp\" alt=\"\"></noscript>
                </picture></a>";
    } else {
        echo "<img class=\"lozad\" data-src=\"/images/icons/placeholder.svg\"></img>";
    }
    echo "</td></tr>\n";
}

echo"
</tbody>
</table>
<center><a href=\"#top\"><button class=\"button button3 topbutton\">top</button></a></center>";

$number2 = 0;
foreach ($searchoptions as $value) {
	if (!empty(${$value})) {
		if ($page==1) {
			echo "<center><button class=\"button button2\"><a href=\"./lmalayers.php?".$value."=".${$value}."&page=".($page+1)."\">next page</a></button></center>";
		} else {
			echo "<center><button class=\"button button1\"><a href=\"./lmalayers.php?".$value."=".${$value}."&page=".($page-1)."\">previous page</a></button><button class=\"button button2\"><a href=\"./lmalayers.php?".$value."=".${$value}."&page=".($page+1)."\">next page</a></button></center>";
		}
		$number2++;
	}
}

if ($number2===1) {}
else {
	if ($page===1) {
		echo "<center><button class=\"button button2\"><a href=\"./lmalayers.php?page=".($page+1)."\">next page</a></button></center>";
	} else {
		echo "<center><button class=\"button button1\"><a href=\"./lmalayers.php?page=".($page-1)."\">previous page</a></button>  <button class=\"button button2\"><a href=\"./lmalayers.php?page=".($page+1)."\">next page</a></button></center>";
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