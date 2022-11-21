<?php

require_once 'vendor/autoload.php';
require_once 'app/constants.php';

use App\{Slots, Spin, Wallet};
use const App\{ROWS, COLUMNS, COST_PER_SPIN, SYMBOLS, WINNING_COMBOS};

$slots = new Slots(ROWS, COLUMNS, SYMBOLS, WINNING_COMBOS);
$spin = new Spin($slots);
$spin->intro();
$spin->setWallet(new Wallet());
if (!$spin->inputMoney()) {
    $spin->handOutMoney();
    exit;
}
while (true) {
    do {
        $spin->showWallet();
        if (!$spin->selection("Spin for $" . COST_PER_SPIN . "?")) {
            $spin->handOutMoney();
            exit;
        }
        $spin->getWallet()->subtractMoney(COST_PER_SPIN);
        $spin->getSlots()->spin();
        $spin->showBoard();
        $spin->showWins();
    } while ($spin->getWallet()->getMoney() >= COST_PER_SPIN);

    $spin->showWallet();
    if (!$spin->selection("Insert more $$$?") || !$spin->inputMoney()) {
        $spin->handOutMoney();
        exit;
    }
}
