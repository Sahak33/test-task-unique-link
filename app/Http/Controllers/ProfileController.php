<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function random()
    {
        $num = mt_rand(1, 1000);
        $result = $num % 2;
        $amount = 0;
        if ($result == 0) {
            switch ($num) {
                case $num > 900:
                    $amount = $this->percent($num, 70);
                    break;
                case $num > 600:
                    $amount = $this->percent($num, 50);
                    break;
                case $num > 300:
                    $amount = $this->percent($num, 30);
                    break;
                case $num < 300:
                    $amount = $this->percent($num, 10);
                    break;
            }
        }
        if($amount){
            $history = [];
            if(Session::has('history')){
                $history = Session::get('history');
            }
            array_unshift($history,$amount);
            Session::put('history', $history);

        }

        return view('page.lucky-number',compact('amount'));
    }

    public function history()
    {
        if(Session::has('history')){
            $history = Session::get('history');
            $results = array_slice($history, 0, 3);
            return view('page.history',compact('results'));
        }
        return redirect()->back()->withErrors(['msg' => 'history is empty']);

    }

    public function percent($prcie, $percent)
    {
        return $prcie * ($percent / 100);
    }
}
