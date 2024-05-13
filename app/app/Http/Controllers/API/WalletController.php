<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Usecase\Wallet\Deposit\DTO\InputWalletDTO;
use Usecase\Wallet\Deposit\DepositWalletUseCase;

class WalletController extends Controller
{
    public function __construct(private DepositWalletUseCase $useCase)
    {
    }

    public function transfer(Request $request): JsonResponse
    {
        try {
            $response = $this->useCase->execute(new InputWalletDTO(
                $request->get('walletId'),
                (float) $request->get('amount'),
            ));

            return response()->json(
                $response,
                JsonResponse::HTTP_OK,
                [],
                JSON_UNESCAPED_SLASHES
            );
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }
}
