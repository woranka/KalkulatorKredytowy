<?php
require_once dirname(__FILE__).'/../config.php';

// skrypt przerwie przetwarzanie w tym punkcie gdy uzytkownik jest niezalogowany
include _ROOT_PATH.'/app/security/check.php';

// pobranie parametrów

function getParams(&$kwota,&$okres,&$oprocentowanie) {
    $kwota = isset($_REQUEST['kw']) ? $_REQUEST['kw'] : null;
    $okres = isset($_REQUEST['ok']) ? $_REQUEST['ok'] : null;
    $oprocentowanie = isset($_REQUEST['op']) ? $_REQUEST['op'] : null;	
}

// walidacja

function validate(&$kwota,&$okres,&$oprocentowanie,&$messages) {
    // czy parametry zostaly przekazane
    if (!(isset($kwota) && isset($okres) && isset($oprocentowanie))) {
        return false;
    }
    
    // czy wartosci zostaly przekazane
    if ($kwota == "") {
        $messages [] = 'Nie podano Kwoty';
    }
    if ($okres == "") {
        $messages [] = 'Nie podano Okresu';
    }
    if ($oprocentowanie == "") {
        $messages [] = 'Nie podano Oprocentowania';
    }
    
    // gdy brak parametrow
    if (count($messages) != 0) return false;
    
    // czy parametry sa liczbami
    if (! is_numeric($kwota)) {
        $messages [] = 'Kwota nie jest liczbą';
    }
    if (! is_numeric($okres)) {
        $messages [] = 'Okres nie jest liczbą';
    }
    if (! is_numeric($oprocentowanie)) {
        $messages [] = 'Oprocentowanie nie jest liczbą';
    }
    
    if (count($messages) != 0) return false;
    else return true;
}

function process(&$kwota,&$okres,&$oprocentowanie,&$messages,&$result) {
    $kwota = floatval($kwota);
    $okres = intval($okres);
    $oprocentowanie = floatval($oprocentowanie);

    $result = ($kwota/($okres*12))+(($kwota/($okres*12))*($oprocentowanie/100));
}

// definicja zmiennych kontrolera
$kwota = null;
$okres = null;
$oprocentowanie = null;
$result = null;
$messages = array();

//pobierz parametry i wykonaj jesli wszystko ok
getParams($kwota,$okres,$oprocentowanie);

if (validate($kwota,$okres,$oprocentowanie,$messages)) {
    process($kwota,$okres,$oprocentowanie,$messages,$result);
}

// wywołanie widoku z przekazaniem zmiennych
include 'calcred_view.php';
