<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{
    function login()
    {
        return view('login');
    }

    function loginPost(Request $request)
    {
        $request->validateWithBag(
            'login',
            [
                'email' => 'required|exists:users',
                'password' => 'required'
            ],
            [
                'email.exists' => 'Veuiller saisir un email valide',
                'email.required' => 'Veuillez saisir votre email',
                'password.required' => 'Veuillez saisir votre mot de passe',

            ]
        );

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            // ✅ Redirection selon le rôle
            if ($user->role !== 'client') {
                return redirect()->route('admin.index'); // ou une autre route pour les admins/modérateurs
            }

            return redirect()->intended('/'); // client par défaut
        }
        return redirect(route('login'))->with("error", "Le mot de passe saisie est incorrecte");
    }

    function signinPost(Request $request)
    {
        try {
            $request->validateWithBag(
                'signin',
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required|min:6|confirmed'
                ],
                [
                    'password.min' => 'Le mot de passe doit comporter au moins 6 caractères',
                    'password.required' => 'Veuillez saisir un mot de passe',
                    'password.confirmed' => 'Les mots de passe ne correspondent pas',
                    'email.required' => 'Veuillez saisir votre email',
                    'email.unique' => 'Cet email est déjà utilisé',
                    'email.email' => 'Veuillez saisir un email valide',
                    'name.required' => 'Veuillez saisir votre nom',

                ]
            );
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator, 'signin')
                ->withInput()
                ->with('showSignUp', true);
        }

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        if (!$user) {
            return redirect(route('signin'))->with([
                'error' => "signin unsuccesful",
                'showSignUp' => true
            ]);
        }
        Auth::login($user);
        return redirect(route('index'));
    }

    function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }

    public function showCompte()
    {
        $categoriesFemme = Category::where('sexe', 'femme')->get();
        $categoriesHomme = Category::where('sexe', 'homme')->get();

        return view('client.compte', compact('categoriesFemme', 'categoriesHomme')); 
    }

    public function compte(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        // Mise à jour des infos de base
        $user->name = $request->name;
        $user->email = $request->email;

        // Si l'utilisateur souhaite changer son mot de passe
        if ($request->filled('current_password') || $request->filled('new_password')) {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:6|confirmed',
            ], [
                'current_password.required' => 'Veuillez saisir votre mot de passe actuel.',
                'new_password.required' => 'Veuillez saisir un nouveau mot de passe.',
                'new_password.min' => 'Le nouveau mot de passe doit comporter au moins 6 caractères.',
                'new_password.confirmed' => 'Les mots de passe ne correspondent pas.',
            ]);

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Le mot de passe actuel est incorrect.');
            }

            if (Hash::check($request->new_password, $user->password)) {
                return back()->with('error', 'Le nouveau mot de passe doit être différent de l’actuel.');
            }

            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('index')->with('success', 'Informations du compte mises à jour.');
    }
}
