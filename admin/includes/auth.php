<?php
include 'dbconnection.php';

if ( isset( $_SESSION['patients_id'] ) ) {
    header("Location: ../pages/landing.php");
}
if ( isset( $_SESSION['sec_id'] ) ) {
    header("Location: ../admin/index-sec.php");
}
if ( isset( $_SESSION['admin_id'] ) ) {
    header("Location: ../admin/index-admin.php");
}
?>