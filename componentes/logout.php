<?php
session_start();
session_unset();
session_destroy();
header('Location: \controle-financeiro/index.php');
?>