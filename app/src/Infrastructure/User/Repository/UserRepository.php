<?php

declare(strict_types=1);

namespace Infrastructure\User\Repository;

use App\Models\User as Model;
use Domain\Shared\ValueObjects\Uuid;
use Domain\Shared\Enums\TypeUserEnum;
use Domain\User\Domain\Entities\User;
use Domain\Shared\ValueObjects\Document;
use Domain\User\Domain\Repository\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email): ?User
    {
        $user = Model::where('email', $email)->first();

        if ($user !== null) {
            return $this->make($user);
        }

        return $user;
    }
    public function findByCPF(string $cpf): ?User
    {
        $user = Model::where('document', $cpf)->first();

        if ($user !== null) {
            return $this->make($user);
        }

        return $user;
    }
    public function create(User $user): void
    {
        Model::create([
            'id'        => $user->id(),
            'name'      => $user->name,
            'email'     => $user->email,
            'password'  => $user->password,
            'document'  => $user->document(),
            'type'      => $user->type->value
        ]);
    }

    private function make(Model $user)
    {
        return new User(
            id: new Uuid($user->id),
            name: $user->name,
            email: $user->email,
            document: new Document($user->document),
            password: $user->password,
            type: TypeUserEnum::isValid($user->type),
            createdAt: $user->created_at->toDateTime()
        );
    }
}
