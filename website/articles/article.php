<?php
include("../snippets/head.php");
include("../snippets/functions.php");
$articlecategoryid = getrequest($_REQUEST['articlecategoryid']);
$articleid = getrequest($_REQUEST['articleid']);
$articletitle = getrequest($_REQUEST['articletitle']);
$skip = "false";

if ($articlecategoryid == null) {
    $articlecategoryid = 1;
}

$page = pagesystem();
$offset = ($page - 1) * $items_per_page;

$searchoptions = array("articletitle");
$valueneeded = array("articlecategoryid");

$setfiltermode = 0;
$article = 0;

if (!empty($articleid)) {
    $filteroption = "WHERE `articleid` = :articleid;";
    $command = "SELECT * FROM `articles` WHERE `articleid` = :articleid;";
    $article = 1;
    $sth = $pdo->prepare($command, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sth->execute(array(':articleid' => $articleid));
    $setfiltermode = 1;
} else if (!empty($articletitle)) {
    $command = "SELECT * FROM `articles`,`articlecategories` WHERE `articletitle` LIKE :articletitle AND `articles`.`articlecategoryid` = :articlecategoryid AND `articlecategories`.`articlecategoryid` = :articlecategoryid LIMIT $items_per_page OFFSET $offset;";
    #define the filteroption for the page system
    $filteroption = "WHERE `articletitle` LIKE :articletitle AND `articles`.`articlecategoryid` = :articlecategoryid;";
    $sth = $pdo->prepare($command, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sth->execute(array(':articletitle' => '%'.$articletitle.'%', ':articlecategoryid' => $articlecategoryid));
    $setfiltermode = 2;
} else if (!empty($articlecategoryid)) {
    $command = "SELECT * FROM `articles`,`articlecategories` WHERE `articles`.`articlecategoryid` = :articlecategoryid AND `articlecategories`.`articlecategoryid` = :articlecategoryid LIMIT $items_per_page OFFSET $offset;";
    $filteroption = "WHERE `articles`.`articlecategoryid` = :articlecategoryid;";
    $sth = $pdo->prepare($command, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sth->execute(array(':articlecategoryid' => $articlecategoryid));
    $setfiltermode = 3;
} else {
    $filteroption = ";";
    $command = "";
    $skip = "true";
}

#merge the count option with the filter
$normalfilter = "SELECT COUNT(articleid) FROM articles " . $filteroption;
$sth2 = $pdo->prepare($normalfilter, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
if ($setfiltermode === 1) {
    $sth2->execute(array(':articleid' => $articleid));
} else if ($setfiltermode === 2) {
    $sth2->execute(array(':articletitle' => '%'.$articletitle.'%', ':articlecategoryid' => $articlecategoryid));
} else if ($setfiltermode === 3) {
    $sth2->execute(array(':articlecategoryid' => $articlecategoryid));
} else {
    $sth2->execute();
}

while ($sumrow = $sth2->fetch()) {
    $sum = $sumrow[0];
}

$pagesneeded = getpagesneeded($sum, $items_per_page);
$nextpagebutton = nextpagebutton($offset, $items_per_page, $pagesneeded);

include("../snippets/blocksnap.php");
echo "
<div class=\"contentstart lozad\" data-background-image=\"/images/avif/backgrounds/background1.avif,/images/webp/backgrounds/background1.webp\">
<div class=\"imagefilter\">";

buttonscycle($searchoptions, "article.php", $page, $valueneeded, $nextpagebutton);


if ($article === 1) {
    while ($row = $sth->fetch()) {
        echo "<h1>".$row["articletitle"]."</h1>";
        echo "<center><div class=\"articlebody\">".$row["articletext"]."<div></center>";
    }
} else if ($article === 0) {
    echo "
    <table>
    <thead>
    <tr>
        <td>Article category</td>
        <td>Articlename</td>
    </tr>
    <tr>
        <td>
        <form>
            <select name=\"articlecategoryid\" id=\"articlecategoryid\">";
            $articlecategories = "SELECT * FROM `articlecategories`;";
            foreach ($pdo->query($articlecategories) as $rowcategories)
            {
                echo "<option value=\"".$rowcategories["articlecategoryid"]."\">".$rowcategories["articlecategoryname"]."</option>";
            }
            echo "</select>
            <input class=\"button3\" type=submit>
        </form>
        </td>
        <td>
            <form>
                <input type=hidden name=\"articlecategoryid\" value=\"$articlecategoryid\">
                <input type=text name=\"articletitle\" value=\"".$articletitle."\">
                <input class=\"button3\" type=submit>
            </form>
        </td>
    </tr>
    </thead>
    <tbody>";
    if ($skip == "false") {
        while ($row = $sth->fetch()) {
            $categoryname = "SELECT * FROM `articlecategories` WHERE `articlecategoryid` = ".$row["articlecategoryid"].";";
            foreach ($pdo->query($categoryname) as $rowcategoryname)
            {
                echo "<tr><td>".$rowcategoryname["articlecategoryname"]."</td>";
            }
            echo "<td><a href=\"./article.php?articleid=".$row["articleid"]."\">".$row["articletitle"]."</a></td><td>";
        }
    }

    echo"
    </tbody>
    </table>";
}

buttonscycle($searchoptions, "article.php", $page, $valueneeded, $nextpagebutton);

echo "
</div>
</div>
";
include("../snippets/footer.php");
echo "</body>
</html>";
?>