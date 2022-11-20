<?php

namespace App;

const ROWS = 3;
const COLUMNS = 5;
const COST_PER_SPIN = 2;

const SYMBOLS = [
    ['symbol' => '$', 'value' => 20],
    ['symbol' => '#', 'value' => 10],
    ['symbol' => '%', 'value' => 5],
    ['symbol' => '*', 'value' => 2]
];

const WINNING_COMBOS = [
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