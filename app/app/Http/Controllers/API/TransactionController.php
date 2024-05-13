<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Usecase\Transaction\Create\DTO\InputTransactionDTO;
use Usecase\Transaction\Create\CreateTransactionUseCase;

class TransactionController extends Controller
{
    public function __construct(private CreateTransactionUseCase $useCase)
    {
    }

    public function transfer(Request $request): JsonResponse
    {
        try {
            $response = $this->useCase->execute(new InputTransactionDTO(
                (float) $request->get('value'),
                $request->get('payerId'),
                $request->get('payeeId'),
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
