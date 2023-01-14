<?php

namespace App\Repositories;

use App\Models\UniqueLink;
use App\Models\User;

class UniqueLinkRepository
{
    /**
     * @var user
     */
    protected $user;

    /**
     * ApageRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get all Users.
     *
     * @return User $user
     */
    public function getAll()
    {
        $data = $this->user->paginate(5);
        return $data;
    }

    /**
     * Get User by getByLink
     *
     * @param $id
     * @return mixed
     */
    public function getByLink($link)
    {
        return $this->user->where('generated_link', $link)->get();
    }


    /**
     * Update User generated_link
     *
     * @param $data
     * @return User
     */
    public function update($data, $user)
    {
        $linkUpdated = $user->update($data);

        return $linkUpdated;
    }

    /**
     * Remove User generated link
     *
     * @param $user
     * @return User
     */
    public function delete($user)
    {
        $user['generated_link'] = null;
        $user->save();
        return $user;
    }

    /**
     * @param $id
     * @return void
     */
    public function destroyLink($id)
    {
        UniqueLink::where('id',$id)->delete();
    }

    public function store($user)
    {
        $generatedLink = new UniqueLink(['generated_links' => \Illuminate\Support\Facades\URL::temporarySignedRoute('access', now()->addDays(7))]);
        $user->links()->save($generatedLink);
        return $generatedLink;
    }

}
