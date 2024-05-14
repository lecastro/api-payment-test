<?php

use App\Models\Wallet as ModelWallet;

test('user api e2e: deposit balance wallet', function () {
    $response = $this->json(
        method: 'POST',
        uri: route('deposit'),
        data: [
            'walletId' => (new ModelWallet)::first()->id,
            'amount'   => rand(1, 100),
        ],
        headers: ['Authorization' => "Bearer $this->token"]
    );

    $response->assertStatus(200);
});
