<?php

namespace App\Dtos\Currency;

use Carbon\Carbon;

class StoreDto
{
    public function __construct(
        public int $codeA,
        public int $codeB,
        public string $date,
        public string $rateBuy,
        public string $rateSell,
        public string $rateCross,
    ) {
    }

    public function getKey(): string {
        return $this->codeA .'-'. $this->codeB;
    }

    public function toArray(): array {
        return [
            'codeA' => $this->codeA,
            'codeB' => $this->codeB,
            'date' => Carbon::createFromTimestamp($this->date),
            'rateBuy' => $this->rateBuy,
            'rateSell' => $this->rateSell,
            'rateCross' => $this->rateCross,
            'key' => $this->getKey(),
        ];
    }
}
