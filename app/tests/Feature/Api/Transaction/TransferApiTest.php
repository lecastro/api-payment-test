<?php

test('user api e2e: create a transaction', function () {
    $response = $this->json(
        method: 'POST',
        uri: route('transfer'),
        data: [
            'value' => 100.0,
            'payerId' => '045c3795-9c4d-4650-9cb7-03babceb5530',
            'payeeId' => '4f481296-2c1d-4c51-b5de-eaa5060b5594'
        ]
    );

    $response->assertStatus(200);
});
