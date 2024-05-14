<?php

use Faker\Factory;
use Domain\Shared\Enums\TypeUserEnum;

test('user api e2e: create nem user', function () {
    $response = $this->json(
        method: 'POST',
        uri: route('auth.register'),
        data: [
            'name'     => Factory::create()->name(),
            'email'    => Factory::create()->email(),
            'password' => '1234567',
            'document' => '639.495.960-03',
            'type'     => TypeUserEnum::CUSTOMER,
        ]
    );

    $response->assertStatus(201);
});


test('user api e2e: create nem retailer', function () {
    $response = $this->json(
        method: 'POST',
        uri: route('auth.register'),
        data: [
            'name'     => Factory::create()->name(),
            'email'    => Factory::create()->email(),
            'password' => '1234567',
            'document' => '22.459.895/0001-60',
            'type'     => TypeUserEnum::RETAILER,
        ]
    );

    $response->assertStatus(201);
});
