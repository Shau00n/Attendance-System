<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all()
    {
        return $this->user->all();
    }

    public function find($id)
    {
        return $this->user->findOrFail($id);
    }

    public function create(array $attributes)
    {
        return $this->user->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $user = $this->user->findOrFail($id);
        $user->update($attributes);

        return $user;
    }

    public function delete($id)
    {
        $user = $this->user->findOrFail($id);
        $user->delete();

        return true;
    }
}
