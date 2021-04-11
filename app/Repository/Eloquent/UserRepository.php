<?php

namespace App\Repository\Eloquent;

use App\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }


    public function update($fields)
    {
        //find the relevant model or fail (by throwing an exception)
        $user = $this->find($fields['id']);

        //make the changes to the model
        $user->fill($fields);

        //save the model back to the repository
        $user->save();
    }
}