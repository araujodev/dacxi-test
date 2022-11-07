<?php

namespace App\Http\Dto;

class LatestPriceResponseDto
{
    public string $coin;
    public string $price_usd;
    public string $price_brl;
    public string $effective_date;

}
