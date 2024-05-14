<?php
test('user api e2e: login and logout', function () {
    $responseLogin = $this->json(
        method: 'POST',
        uri: route('auth.login'),
        data: [
            'email'    => $this->payer->email,
            'password' => $this->payer->password,
        ]
    );

    $responseLogin->assertStatus(200);

    $token = $responseLogin->json('token');

    $responseLogout = $this->json(
        method: 'POST',
        uri: route('auth.logout'),
        headers: ['Authorization' => "Bearer $token"]
    );

    $responseLogout->assertStatus(200);
});
