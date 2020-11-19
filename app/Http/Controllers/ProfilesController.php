<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\User;

class ProfilesController extends Controller
{
    public function show( User $user )
    {
        return view('profiles.show', [
            'user' => $user,
            'tweets' => $user->tweets()->withLikes()->paginate(50)
        ]);
    }

    public function edit(User $user)
    {
        // $this->authorize('edit', $user);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $attributes = request()->validate([
            'username' => ['string', 'required', 'max:255', Rule::unique('users')->ignore($user), 'alpha_dash'], // Ignora o usuário atual quando procurar o username no banco de dados
            'name' => ['string', 'required', 'max:255'],
            'about' => ['max:255'],
            'banner' => ['file'],
            'avatar' => ['file'],
            'email' => ['string', 'required', 'max:255', 'email', Rule::unique('users')->ignore($user)],
            'password' => ['string', 'required', 'min:8', 'max:255', 'confirmed', 'password']
        ]);

        if ( request('avatar') ) {
            $attributes['avatar'] = request('avatar')->store('avatars');
        }

        if ( request('banner') ) {
            $attributes['banner'] = request('banner')->store('banners');
        }

        $user->update($attributes);

        return redirect($user->path());
    }
}
