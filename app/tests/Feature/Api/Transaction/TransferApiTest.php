<?php

use App\Models\User as ModelUser;
use App\Models\Wallet as ModelWallet;
use Illuminate\Support\Facades\Hash;
use Domain\Shared\Enums\TypeUserEnum;
use Domain\User\Domain\Entities\User;
use Domain\Shared\ValueObjects\Document;
use Domain\Wallet\Domain\Entities\Wallet;

beforeEach(function () {
    $this->payer = new User(
        id: null,
        name: fake()->name(),
        email: fake()->unique()->safeEmail(),
        document: new Document('123.456.789-09'),
        password: Hash::make('password'),
        type: TypeUserEnum::CUSTOMER,
    );

    $this->payee = new User(
        id: null,
        name: fake()->name(),
        email: fake()->unique()->safeEmail(),
        document: new Document('22.459.895/0001-60'),
        password: Hash::make('password'),
        type: TypeUserEnum::RETAILER,
    );

    $this->payerWallet = new Wallet(
        id: null,
        userType: $this->payer->type,
        userId: $this->payer->id,
        balance: 500.0
    );

    $this->payeeWallet = new Wallet(
        id: null,
        userType: $this->payee->type,
        userId: $this->payee->id,
        balance: 0.0
    );
});

test('user api e2e: create a transaction', function () {
    ModelUser::factory()->create([
        'id'        => $this->payer->id(),
        'name'      => $this->payer->name,
        'email'     => $this->payer->email,
        'password'  => $this->payer->password,
        'document'  => $this->payer->document(),
        'type'      => $this->payer->type->value
    ]);

    ModelUser::factory()->create([
        'id'        => $this->payee->id(),
        'name'      => $this->payee->name,
        'email'     => $this->payee->email,
        'password'  => $this->payee->password,
        'document'  => $this->payee->document(),
        'type'      => $this->payee->type->value
    ]);

    ModelWallet::factory()->create([
        'id'        => $this->payerWallet->id(),
        'user_type' => $this->payerWallet->userType->value,
        'user_id'   => $this->payer->id->get(),
        'balance'   => $this->payerWallet->getBalance(),
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
        ]
    );

    $response->assertStatus(200);
});
