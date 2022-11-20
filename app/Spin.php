<?php

namespace App;

class Spin
{
    private Slots $slots;
    private Wallet $wallet;

    public function __construct(Slots $slots)
    {
        $this->slots = $slots;
    }

    public function getSlots(): Slots
    {
        return $this->slots;
    }

    public function setWallet(Wallet $wallet): void
    {
        $this->wallet = $wallet;
    }

    public function getWallet(): ?Wallet
    {
        return $this->wallet;
    }

    public function greet(): void
    {
        echo "SLOT MACHINE ($" . COST_PER_SPIN . " per spin)" . PHP_EOL;
    }

    public function inputMoney(): bool
    {
        do {
            $input = strtoupper(readline("Insert money or press 'N' to exit: "));
            if ($input === "N") {
                return false;
            }
            $this->getWallet()->addMoney(intval($input));
        } while ($this->getWallet()->getMoney() < COST_PER_SPIN);
        return true;
    }

    public function showWallet(): void
    {
        echo "Money left: $" . $this->getWallet()->getMoney() . PHP_EOL;
    }

    public function handOutMoney(): void
    {
        if ($this->getWallet()->getMoney() > 0) {
            echo "Handing out $" . $this->getWallet()->getMoney() . PHP_EOL;
            echo "Bye" . PHP_EOL;
            $this->getWallet()->subtractMoney($this->getWallet()->getMoney());
        }
    }

    public function askConfirmation(string $message): bool
    {
        $choice = strtoupper(readline("$message ('ENTER'/'N'): "));
        return ($choice === "" || $choice === "ENTER");
    }

    public function showBoard(): void
    {
        foreach ($this->slots->getBoard() as $row) {
            $line = '';
            foreach ($row as $columnIndex => $element) {
                $line .= ' ' . $element;
                if ($columnIndex !== count($row) - 1) {
                    $line .= ' |';
                }
            }
            echo $line . PHP_EOL;
        }
    }

    public function showWins(): void
    {
        foreach ($this->getSlots()->calculateWins() as $win) {
            $this->getWallet()->addMoney($win['value']);
            echo "YOU WIN! A line of '" . $win['symbol'] . "' is worth $" . $win['value'] . PHP_EOL;
        }
    }
}