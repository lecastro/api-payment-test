<?php

use App\Models\User as ModelUser;
use App\Models\Wallet as ModelWallet;
use Domain\Shared\Enums\TypeUserEnum;
use Domain\User\Domain\Entities\User;
use Illuminate\Support\Facades\Artisan;
use Domain\Shared\ValueObjects\Document;
use Domain\Wallet\Domain\Entities\Wallet;
/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(
    Tests\TestCase::class,
    // Illuminate\Foundation\Testing\RefreshDatabase::class,
)->beforeEach(function () {
    Artisan::call('passport:client --name=<client-name> --no-interaction --personal');

    $this->payer = new User(
        id: null,
        name: fake()->name(),
        email: fake()->unique()->safeEmail(),
        document: new Document('123.456.789-09'),
        password: 'password',
        type: TypeUserEnum::CUSTOMER,
    );

    $this->payee = new User(
        id: null,
        name: fake()->name(),
        email: fake()->unique()->safeEmail(),
        document: new Document('22.459.895/0001-60'),
        password: 'password',
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

    ModelUser::factory()->create([
        'id'        => $this->payer->id(),
        'name'      => $this->payer->name,
        'email'     => $this->payer->email,
        'password'  => $this->payer->password,
        'document'  => $this->payer->document(),
        'type'      => $this->payer->type->value
    ]);

    ModelWallet::factory()->create([
        'id'        => $this->payerWallet->id->get(),
        'user_type' => $this->payerWallet->userType->value,
        'user_id'   => $this->payer->id->get(),
        'balance'   => $this->payerWallet->getBalance(),
    ]);

    $responseLogin = $this->json(
        method: 'POST',
        uri: route('auth.login'),
        data: [
            'email'    => $this->payer->email,
            'password' => $this->payer->password,
        ]
    );

    $this->token = $responseLogin->json('token');
})->group('integration')->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function something()
{
    // ..
}
