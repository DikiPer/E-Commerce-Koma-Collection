<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsLetterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        $subscriber = Subscriber::create([
            'email' => $request->input('email'),
        ]);

        return redirect()->back()->with('success', 'Terima kasih sudah berlangganan newsletter kami!');
    }

    public function index()
    {
        $subscriber = Subscriber::all();

        return view('admin.newsletter', compact('subscriber'));
    }
}