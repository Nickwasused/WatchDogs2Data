<?php
require("constants.php");
# terminate the database connection
$pdo = null;

echo "
<footer>
	<center><p>Nickwasused ".date("Y")."<br><a href=\"mailto:".$footer_email."\">".$footer_email."</a></p></center>
	<!-- image Lazy Loading -->
	<script defer src=\"/scripts/lozad.js\"></script>
</footer>\n";
?>