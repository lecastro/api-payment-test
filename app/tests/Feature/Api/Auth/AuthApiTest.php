<?php

use App\Models\User as ModelUser;
use Domain\Shared\ValueObjects\Uuid;
use Domain\Shared\Enums\TypeUserEnum;
use Illuminate\Support\Facades\Artisan;
use Domain\Shared\ValueObjects\Document;

beforeEach(function () {
    Artisan::call('passport:client --name=<client-name> --no-interaction --personal');
});

test('user api e2e: login and logout', function () {
    $email = fake()->unique()->safeEmail();

    ModelUser::factory()->create([
        'id'        => Uuid::random(),
        'name'      => fake()->name(),
        'email'     => $email,
        'password'  => 'password',
        'document'  => new Document('123.456.789-09'),
        'type'      => TypeUserEnum::CUSTOMER
    ]);

    $responseLogin = $this->json(
        method: 'POST',
        uri: route('auth.login'),
        data: [
            'email'    => $email,
            'password' => 'password',
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
