<?php

use App\Models\User as ModelUser;
use Illuminate\Support\Facades\Hash;
use App\Models\Wallet as ModelWallet;
use Domain\Shared\Enums\TypeUserEnum;
use Domain\User\Domain\Entities\User;
use Domain\Shared\ValueObjects\Document;
use Domain\Wallet\Domain\Entities\Wallet;

beforeEach(function () {
    $this->user = new User(
        id: null,
        name: fake()->name(),
        email: fake()->unique()->safeEmail(),
        document: new Document('123.456.789-09'),
        password: Hash::make('password'),
        type: TypeUserEnum::CUSTOMER,
    );

    $this->wallet = new Wallet(
        id: null,
        userType: $this->user->type,
        userId: $this->user->id,
        balance: 500.0
    );
});

test('user api e2e: deposit balance wallet', function () {
    ModelUser::factory()->create([
        'id'        => $this->user->id(),
        'name'      => $this->user->name,
        'email'     => $this->user->email,
        'password'  => $this->user->password,
        'document'  => $this->user->document(),
        'type'      => $this->user->type->value
    ]);

    ModelWallet::factory()->create([
        'id'        => $this->wallet->id(),
        'user_type' => $this->wallet->userType->value,
        'user_id'   => $this->user->id->get(),
        'balance'   => $this->wallet->getBalance(),
    ]);

    $response = $this->json(
        method: 'POST',
        uri: route('deposit'),
        data: [
            'walletId' => $this->wallet->id(),
            'amount'   => 100.00,
        ]
    );

    $response->assertStatus(200);
});
