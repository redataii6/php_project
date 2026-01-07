<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'first-name' => 'required|string|max:255',
            'last-name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone-number' => 'required|string|max:20',
            'message' => 'nullable|string',
            'switch-1' => 'accepted',
            'ville' => 'required|string',
        ]);


        Message::create([
            'note' => $validated['note'],
            'nom' => $validated['first-name'],
            'prenom' => $validated['last-name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone-number'],
            'message' => $validated['message'] ?? '',
            'accept_politique' => true,
            'ville' => $validated['ville'],
        ]);

        return redirect()->back()->with('success', 'Formulaire soumis avec succès.');
    }
    public function updateVisibility(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $message->visible = $request->has('visible'); // true si coché, false sinon
        $message->save();

        return back()->with('success', 'Visibilité mise à jour.');
    }



    public function index(Request $request)
    {
        $query = Message::query();

        // Filtrer par note si fournie
        if ($request->filled('note')) {
            $query->where('note', $request->note);
        }

        // Filtrer par visibilité si fournie
        if ($request->filled('visible')) {
            $query->where('visible', $request->visible);
        }

        // Filtrer par ville si fournie
        if ($request->filled('ville')) {
            $query->where('ville', $request->ville);
        }

        // Récupérer les résultats
        $messages = $query->orderBy('created_at', 'desc')->get();
        return view('admin.messages.index', compact('messages'));
    }
}
