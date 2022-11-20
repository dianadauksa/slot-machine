<?php

namespace App;

class Wallet
{
    private int $playerMoney = 0;

    public function getMoney(): int
    {
        return $this->playerMoney;
    }

    private function setMoney(int $money): void
    {
        $this->playerMoney = $money;
    }

    public function addMoney(int $money): void
    {
        if ($money > 0) {
            $this->setMoney($this->getMoney() + $money);
        }
    }

    public function subtractMoney(int $money): void
    {
        if ($money > 0) {
            $this->setMoney($this->getMoney() - $money);
        }
    }
}