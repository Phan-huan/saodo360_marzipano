<?php
session_start();
$_SESSION['login']=="";

session_unset();

?>
<script language="javascript">
document.location="index.php";
</script>
