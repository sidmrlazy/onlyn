<?php
session_start();
if ($_SESSION['user_type'] == 1) {
    include('index-admin.php');
}