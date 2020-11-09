<?php
require_once dirname(__FILE__).'/../../config.php';
// inicjacja mechanizmu sesji
session_start();

// pobranie roli
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

// jesli brak parametru (niezalogowanie) to idz na strone logowania
if (empty($role)) {
    include _ROOT_PATH.'/app/security/login.php';
    //zatrzymaj dalsze przetwarzanie skryptów
    exit();
}
//jesli ok to idz dalej