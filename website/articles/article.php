<?php
include("../snippets/head.php");
include("../snippets/functions.php");
$articlecategoryid = getrequest($_REQUEST['articlecategoryid']);
$articleid = getrequest($_REQUEST['articleid']);
$articletitle = getrequest($_REQUEST['articletitle']);
$articleauthor = getrequest($_REQUEST['articleauthor']);
$skip = "false";

#if the requested articlecategory is null then put it to 1 as default
if ($articlecategoryid == null) {
    $articlecategoryid = 1;
}

#page system
$page = pagesystem();
$offset = ($page - 1) * $items_per_page;

#define some stuff
$searchoptions = array("articletitle", "articleauthor");
$valueneeded = array("articlecategoryid");

#set the variables to 0 as default
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
} else if (!empty($articleauthor)) {
    $command = "SELECT * FROM `articles`,`articlecategories` WHERE `articleauthor` LIKE :articleauthor AND `articles`.`articlecategoryid` = :articlecategoryid AND `articlecategories`.`articlecategoryid` = :articlecategoryid LIMIT $items_per_page OFFSET $offset;";
    $filteroption = "WHERE `articleauthor` LIKE :articleauthor AND `articles`.`articlecategoryid` = :articlecategoryid;";
    $sth = $pdo->prepare($command, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sth->execute(array(':articleauthor' => $articleauthor, ':articlecategoryid' => $articlecategoryid));
    $setfiltermode = 4;
} else if (!empty($articlecategoryid)) {
    $command = "SELECT * FROM `articles`,`articlecategories` WHERE `articles`.`articlecategoryid` = :articlecategoryid AND `articlecategories`.`articlecategoryid` = :articlecategoryid LIMIT $items_per_page OFFSET $offset;";
    $filteroption = "WHERE `articles`.`articlecategoryid` = :articlecategoryid;";
    $sth = $pdo->prepare($command, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    $sth->execute(array(':articlecategoryid' => $articlecategoryid));
    $setfiltermode = 3;
}  else {
    $filteroption = ";";
    $command = "";
    $skip = "true";
}

#merge the count option with the filter
$normalfilter = "SELECT COUNT(articleid) FROM articles " . $filteroption;
$sth2 = $pdo->prepare($normalfilter, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
#execute the $normalfilter with the correct parameters
if ($setfiltermode === 1) {
    $sth2->execute(array(':articleid' => $articleid));
} else if ($setfiltermode === 2) {
    $sth2->execute(array(':articletitle' => '%'.$articletitle.'%', ':articlecategoryid' => $articlecategoryid));
} else if ($setfiltermode === 3) {
    $sth2->execute(array(':articlecategoryid' => $articlecategoryid));
} else if ($setfiltermode === 4) {
    $sth2->execute(array(':articleauthor' => $articleauthor, ':articlecategoryid' => $articlecategoryid));
} else {
    $sth2->execute();
}

#fetch the sum
while ($sumrow = $sth2->fetch()) {
    $sum = $sumrow[0];
}

#get the pages needed and start the function nextpagebutton
$pagesneeded = getpagesneeded($sum, $items_per_page);
$nextpagebutton = nextpagebutton($offset, $items_per_page, $pagesneeded);

include("../snippets/blocksnap.php");
echo "
<div class=\"contentstart lozad\" data-background-image=\"/images/avif/backgrounds/background1.avif,/images/webp/backgrounds/background1.webp\">
<div class=\"imagefilter\">";

#if an article is loaded then skip the first button
if ($article === 0) {
    buttonscycle($searchoptions, "article.php", $page, $valueneeded, $nextpagebutton);
}

#if the article is loaded then print the article only
if ($article === 1) {
    while ($row = $sth->fetch()) {
        echo "<h1>".$row["articletitle"]."</h1>";
        echo "<center><div class=\"articlebody\">".$row["articletext"]."<div></center>";
    }

#if no article is loaded then print the default table
} else if ($article === 0) {
    echo "
    <h3 class=\"submitemail\">You can submit an article here: <a href=\"mailto:".$submit_article_email."?subject=watch dogs 2 article Suggestion&body=Author:%0Acategory:%0Atext:\">".$submit_article_email."</a></h3>
    <table>
    <thead>
    <tr>
        <td>Article category</td>
        <td>Author</td>
        <td>Articlename</td>
    </tr>
    <tr>
        <td>
        <form>
            <select name=\"articlecategoryid\" id=\"articlecategoryid\">";
            #query the categories and add them to the select field
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
                <input type=text name=\"articleauthor\" value=\"".$articleauthor."\">
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
            echo "<td>".$row["articleauthor"]."</td>";
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