<?php

namespace App\Http\Controllers;

use App\Models\Masjid;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function edit($id)
    {
        $title = "EDIT PROFILE";
        return view('profile.user_edit_profile', [
            'title' => $title
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'password' => 'nullable|max:10',
        ]);


        if ($request->password != '') {
            //jika user mengupdate password maka jalankan ini
            $data['password'] = bcrypt($request->password);
        } else {
            //jika user tidak melakukan update password jalankan ini
            unset($data['password']);
        }

        $user = auth()->user();
        $user->fill($data);
        $user->save();
        flash("Data Berhasil Di Update")->success();
        return redirect()->back();
    }
}
