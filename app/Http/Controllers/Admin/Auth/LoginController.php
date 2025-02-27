<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('admin.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(AdminLoginRequest $request): RedirectResponse
{
    // Ensure Admin is logged in using the correct guard
    if (!Auth::guard('admin')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    $request->session()->regenerate();

    return redirect()->intended(route('admin.dashboard')); // Correct admin redirection
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout(); // Logs out the admin
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('admin.login'); // Ensure this redirects correctly
    }
    
}
