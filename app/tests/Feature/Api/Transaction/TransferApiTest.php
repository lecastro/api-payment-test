<?php

use App\Models\User as ModelUser;
use App\Models\Wallet as ModelWallet;

test('user api e2e: create a transaction', function () {
    ModelUser::factory()->create([
        'id'        => $this->payee->id(),
        'name'      => $this->payee->name,
        'email'     => $this->payee->email,
        'password'  => $this->payee->password,
        'document'  => $this->payee->document(),
        'type'      => $this->payee->type->value
    ]);

    ModelWallet::factory()->create([
        'id'        => $this->payeeWallet->id(),
        'user_type' => $this->payeeWallet->userType->value,
        'user_id'   => $this->payee->id->get(),
        'balance'   => $this->payeeWallet->getBalance(),
    ]);

    $response = $this->json(
        method: 'POST',
        uri: route('transfer'),
        data: [
            'value' => 100.0,
            'payerId' => $this->payer->id(),
            'payeeId' => $this->payee->id()
        ],
        headers: ['Authorization' => "Bearer $this->token"]
    );

    $response->assertStatus(200);
});
