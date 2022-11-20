<?php

namespace App;

class Slots
{
    private array $board = [];
    private int $rows;
    private int $columns;
    private array $symbols;
    private array $winningCombos;

    public function __construct(int $rows, int $columns, array $symbols, array $winningCombos)
    {
        $this->rows = $rows;
        $this->columns = $columns;
        $this->symbols = $symbols;
        $this->winningCombos = $winningCombos;
    }

    private function getRows(): int
    {
        return $this->rows;
    }

    private function getColumns(): int
    {
        return $this->columns;
    }

    private function getSymbols(): array
    {
        return $this->symbols;
    }

    public function getBoard(): array
    {
        return $this->board;
    }

    private function getWinningCombos(): array
    {
        return $this->winningCombos;
    }

    private function setElement(int $row, int $column, string $symbol): void
    {
        if (in_array($symbol, array_column($this->getSymbols(), 'symbol'))) {
            $this->board[$row][$column] = $symbol;
        }
    }

    public function spin(): void
    {
        for ($i = 0; $i < $this->getRows(); $i++) {
            for ($j = 0; $j < $this->getColumns(); $j++) {
                $this->setElement($i, $j, $this->getSymbols()[array_rand($this->getSymbols())]['symbol']);
            }
        }
    }

    public function calculateWins(): array
    {
        $wins = [];
        foreach ($this->getWinningCombos() as $combo) {
            $conditionCounter = 0;
            $firstSymbol = $this->getBoard()[$combo[0][0]][$combo[0][1]];
            foreach ($combo as $position) {
                [$row, $column] = $position;
                if ($this->getBoard()[$row][$column] !== $firstSymbol) {
                    break;
                }
                $conditionCounter++;
            }
            if ($conditionCounter === count($combo)) {
                $wins [] = [
                    'symbol' => $firstSymbol,
                    'value' => $this->getSymbols()[array_search(
                        $firstSymbol,
                        array_column($this->getSymbols(), 'symbol')
                    )]['value']
                ];
            }
        }
        return $wins;
    }
}