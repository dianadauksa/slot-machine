<?php

require_once 'vendor/autoload.php';
require_once 'app/constants.php';

use App\{Slots, Spin, Wallet};
use const App\{ROWS, COLUMNS, COST_PER_SPIN, SYMBOLS, WINNING_COMBOS};

$spin = new Spin(new Slots(ROWS, COLUMNS, SYMBOLS, WINNING_COMBOS));
$spin->greet();
$spin->setWallet(new Wallet());
if (!$spin->inputMoney()) {
    $spin->handOutMoney();
    exit;
}
while (true) {
    do {
        $spin->showWallet();
        if (!$spin->askConfirmation("Spin for $" . COST_PER_SPIN . "?")) {
            $spin->handOutMoney();
            exit;
        }
        $spin->getWallet()->subtractMoney(COST_PER_SPIN);
        $spin->getSlots()->spin();
        $spin->showBoard();
        $spin->showWins();
    } while ($spin->getWallet()->getMoney() >= COST_PER_SPIN);

    $spin->showWallet();
    if (!$spin->askConfirmation("Insert more $$$?") || !$spin->inputMoney()) {
        $spin->handOutMoney();
        exit;
    }
}