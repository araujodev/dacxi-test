<?php

namespace App\Services;

use App\Models\Crypto;
use Carbon\Carbon;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class CryptoPriceService
{
    private CoinGeckoClient $priceClient;
    private CONST DEFAULT_CURRENCY = ['usd','brl'];

    public function __construct(){
        $this->priceClient = new CoinGeckoClient();
    }

    /**
     * @throws \Exception
     */
    public function test(): array
    {
        return $this->priceClient->ping();
    }

    /**
     * @throws \Exception
     */
    public function getLatestPrice(string $cryptoKey): Crypto
    {
        $latestPrice = $this->priceClient->simple()->getPrice($cryptoKey, implode(',', self::DEFAULT_CURRENCY));

        $crypto = new Crypto();
        $crypto->coin = $cryptoKey;
        $crypto->usd = $latestPrice[$cryptoKey][self::DEFAULT_CURRENCY[0]];
        $crypto->brl = $latestPrice[$cryptoKey][self::DEFAULT_CURRENCY[1]];
        $crypto->effective_date = Carbon::now();
        $crypto->save();

        return $crypto;
    }

    public function getFromDatetime(string $cryptoKey, string $datetime): array
    {
        $to = Carbon::parse($datetime);
        $from = Carbon::createFromDate($datetime)->subMinutes(10);
        $priceFromDate = $this->priceClient->coins()->getMarketChartRange($cryptoKey, self::DEFAULT_CURRENCY[0], $from->timestamp, $to->timestamp);

        $priceToResponse = [];

        foreach ($priceFromDate['prices'] as $price){
            $crypto = new Crypto();
            $crypto->coin = $cryptoKey;
            $crypto->effective_date = Carbon::parse($price[0]);
            $crypto->brl = 0;
            $crypto->usd = $price[1];
            $crypto->save();

            $priceToResponse[] = $crypto;
        }

        return $priceToResponse;
    }

}
