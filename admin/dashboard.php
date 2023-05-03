<?php
session_start();
if (!isset($_SESSION["user_mobile"])) {
    header("Location: index.php");
    exit();
}
?>
<?php
$title = "Admin Dashboard | Onlyn";
include('components/dashboard/header.php') ?>
<?php
include('components/dashboard/navbar.php');
?>
<?php
include('components/dashboard/menu-tabs.php');
?>
<?php
include('components/dashboard/footer.php');
?>