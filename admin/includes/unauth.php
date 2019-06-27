<?php
include 'dbconnection.php';

function auth_admin(){
    if ( isset( $_SESSION['admin_id'] ) ) {
    } else {
        header("Location: ../index.php");
    }
}

function auth_user() {
    if ( isset( $_SESSION['patients_id'] ) ) {
    } else {
        header("Location: ../index.php");
    }
}

function auth_sec() {
    if ( isset( $_SESSION['sec_id'] ) ) {
    } else {
        header("Location: ../index.php");
    }
}
?>