<?
session_start();
$_SESSION['username'] = "";
session_unset();
session_destroy();

?>
<script>location.href='index.php';</script>