<?php

namespace App\Services;

use App\Models\UniqueLink;
use App\Models\User;
use App\Repositories\UniqueLinkRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class UniqueLinkService
{
    protected $uniqueLinkRepository;

    /**
     * PostService constructor.
     *
     * @param UniqueLinkRepository $uniqueLinkRepository
     */
    public function __construct(UniqueLinkRepository $uniqueLinkRepository)
    {
        $this->uniqueLinkRepository = $uniqueLinkRepository;
    }


    public function getAll()
    {
        $data = $this->uniqueLinkRepository->getAll();
        return $data;
    }

    /**
     * Get post by link.
     *
     * @param $link
     * @return String
     */
    public function getByLink($link): string
    {
        return $this->uniqueLinkRepository->getByLink($link);
    }

    /**
     * Update post data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @param $id
     * @return String
     */
    public function createLink(string $link): string
    {
        $uniqueLinkIsset = UniqueLink::where('generated_links', $link)->with('user')->first();
        $uniqueLinkIssetInUser = User::where('generated_link', $link)->first();
        $user = null;
        if ($uniqueLinkIsset) {
            $user = $uniqueLinkIsset->user;
        } else if ($uniqueLinkIssetInUser) {
            $user = $uniqueLinkIssetInUser;
        }

        if ($user) {
            return $this->uniqueLinkRepository->store($user);
        }
        return redirect()->back();


    }

    /**
     * @param $id
     * @return void
     */
    public function deleteLink($id): void
    {
        $this->uniqueLinkRepository->destroyLink($id);
    }

}
