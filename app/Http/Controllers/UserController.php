<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class UserController extends Controller
{
    public function export()
    {
        return Excel::download(new UserExport, 'users.xlsx');
    }

    public function toPdf()
    {
        $users = User::all();
        $pdf = PDF::loadView('pdfs.users', ['users' => $users]);
        return $pdf->download('liste_utilisateurs.pdf');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('pdfs.users', ['users' => $users]);
    }

    public function requestToken(Request $request) : JsonResponse
    {
        $request->validate([
            "email" => ['required', 'email'],
            "password" => ['required'],
            "device_id" => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages(['email' => ['Email incorrecte']]);
        }
        return response()->json(["token" => $user->createToken($request->device_id)->plainTextToken]);
    }
}
