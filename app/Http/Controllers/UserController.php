<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function getUser(Request $request)
    {
        $user = $request->user();

        return response()->json($user);
    }

    public function deleteUser(Request $request)
    {
        $user = Auth::user();

        $user->delete();

        Auth::logout();

        return response()->json(['message' => 'Account deleted successfully'], 200);
    }

	public function changePassword(Request $request)
	{
		$request->validate([
			'current_password' => 'required',
			'new_password' => 'required|string|min:6|confirmed',
		]);

		$user = Auth::user();
	
		if (!Hash::check($request->current_password, $user->password)) {
			return response()->json(['message' => 'Current password is wrong']);
		}
	
		$user->password = Hash::make($request->new_password);
		$user->save();
	
		return response()->json(['message' => 'Password changed successfully']);
	}
}
