<?php

namespace App\Http\Controllers;

use App\Services\UniqueLinkService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UniqueLinkController extends Controller
{
    protected $uniqueLinkService;

    public function __construct(UniqueLinkService $uniqueLinkService)
    {
        $this->uniqueLinkService = $uniqueLinkService;
    }

    function index()
    {
        $links = auth()->user()->links;
        return view('page.index',compact('links'));
    }

    public function store(Request $request)
    {
        $this->uniqueLinkService->createLink(url()->previous());
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $this->uniqueLinkService->deleteLink($id);
        return redirect()->back();
    }

}
