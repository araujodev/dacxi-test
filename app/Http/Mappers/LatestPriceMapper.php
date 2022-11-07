<?php

namespace App\Http\Mappers;

use App\Http\Dto\LatestPriceResponseDto;
use App\Models\Crypto;
use Carbon\Carbon;

class LatestPriceMapper
{
    public function modelToResponse(Crypto $crypto): LatestPriceResponseDto
    {
        $latestDto = new LatestPriceResponseDto();
        $latestDto->coin = $crypto->coin;
        $latestDto->price_usd = $crypto->usd;
        $latestDto->price_brl = $crypto->brl;
        $latestDto->effective_date = Carbon::parse($crypto->effective_date)->toIso8601String();
        return $latestDto;
    }

}
