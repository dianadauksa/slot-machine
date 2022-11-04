<?php

$boardRows = 3;
$boardCols = 5;
$costPerSpin = 2;
$symbols = ['A', 'K', 'Q', 'J', '7'];
$prizes = ['A' => 10, 'K' => 5, 'Q' => 4, 'J' => 3, '7' => 2];
//echo $prizes['A']; - to get 10 e.g.

$winningCombos = [
    //horizontal
    [[0,0], [0,1], [0,2], [0,3], [0,4]],
    [[1,0], [1,1], [1,2], [1,3], [1,4]],
    [[2,0], [2,1], [2,2], [2,3], [2,4]],
    //diagonals (spider kinda)
    [[0,0], [0,1], [1,2], [2,3], [2,4]],
    [[0,4], [0,3], [1,2], [2,1], [2,0]],
    //V shape
    [[0,0], [1,1], [2,2], [1,3], [0,4]],
    [[2,0], [1,1], [0,2], [1,3], [2,4]],
    //swastika
    [[1,0], [0,1], [1,2], [2,3], [1,4]],
    [[1,0], [2,1], [1,2], [0,3], [1,4]]
];

function gameBoard()
{
    global $boardRows, $boardCols, $symbols;
    $GLOBALS['board'] = [];
    for ($row = 0; $row < $boardRows; $row++) {
        for ($index = 0; $index < $boardCols; $index++) {
            $GLOBALS['board'][$row][] = $symbols[array_rand($symbols)];
        }
    }
    foreach ($GLOBALS['board'] as $row) {
        echo implode(' | ', $row) . PHP_EOL;
    }
}

$playerMoney = 0;
$playerMoney = intval(readline("Before we play, please enter how much money is in your e-wallet: >> "));
if ($playerMoney < $costPerSpin || $playerMoney == null) {
    echo "Not enough money to spin. Sorry!";
    exit;
};

while (true) {
    $willSpin = strtoupper(readline("Want to spin the slots for 2$? 'Y' (for yes) or 'N' (for no) >> "));
    if ($willSpin !== 'Y') {
        echo "Thank you! Bye.";
        exit;
    }
    $playerMoney -= $costPerSpin;
    gameBoard();

    $lineCount = 0;
    foreach ($winningCombos as $combo) {
        $comboValues = [];
        foreach ($combo as $position) {
            [$x, $y] = $position;
            $comboValues[] = $GLOBALS['board'][$x][$y];
        }
        if (count(array_unique($comboValues)) === 1) {
            $lineCount++;
            $playerMoney += $prizes["{$comboValues[0]}"];
        }
    }
    if($lineCount > 0) {
        echo "Congrats! You got $lineCount winning line(s)!\n";
    }
    echo "You have {$playerMoney}$ left in your wallet\n";

    if($playerMoney < $costPerSpin) {
        echo "Thanks for playing, bye!\n";
        exit;
    }
}
