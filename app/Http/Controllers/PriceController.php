<?php

namespace App\Http\Controllers;

use App\Constants\Crypto;
use App\Http\Mappers\LatestPriceMapper;
use App\Services\CryptoPriceService;
use Illuminate\Http\JsonResponse;

class PriceController extends Controller
{
    private CryptoPriceService $cryptoPriceService;
    private LatestPriceMapper $latestPriceMapper;

    public function __construct(CryptoPriceService $cryptoPriceService, LatestPriceMapper $latestPriceMapper )
    {
        $this->cryptoPriceService = $cryptoPriceService;
        $this->latestPriceMapper = $latestPriceMapper;
    }

    /**
     * @OA\Get(
     *     tags={"Price"},
     *     path="/api/price/health",
     *     summary="Test connection to Price Client",
     *     description="Test connection to Price Client",
     *     @OA\Response(response="200", description="OK")
     * )
     *
     * @throws \Exception
     */
    public function testPriceClient(): array
    {
        return $this->cryptoPriceService->test();
    }

    /**
     * @OA\Get(
     *     tags={"Price"},
     *     path="/api/price/{crypto}/latest",
     *     summary="Test connection to Price Client",
     *     description="Test connection to Price Client",
     *     @OA\Response(response="200", description="OK")
     * )
     *
     * @throws \Exception
     */
    public function latestPrice($crypto = Crypto::BITCOIN): JsonResponse
    {
        $cryptoPrice = $this->cryptoPriceService->getLatestPrice($crypto);
        return response()->json($this->latestPriceMapper->modelToResponse(($cryptoPrice)));
    }

    /**
     * @OA\Get(
     *     tags={"Price"},
     *     path="/api/price/{crypto}/from/{datetime}",
     *     summary="Test connection to Price Client",
     *     description="Test connection to Price Client",
     *     @OA\Response(response="200", description="OK")
     * )
     *
     * @throws \Exception
     */
    public function priceFromDatetime(string $crypto, string $datetime): JsonResponse
    {
        $prices = $this->cryptoPriceService->getFromDatetime($crypto, $datetime);
        $collectionPrices = collect($prices);
        return response()->json($collectionPrices->transform(function($item){
            return $this->latestPriceMapper->modelToResponse($item);
        }));
    }

}
