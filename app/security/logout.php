<?php
require_once dirname(__FILE__).'/../../config.php';

// zakończenie sesji
session_start();
session_destroy();

// przekieruj lub "forward" na stronę główną
// redirect
header("Location: "._APP_URL);
//"forward"
//include _ROOT_PATH.'/index.php';