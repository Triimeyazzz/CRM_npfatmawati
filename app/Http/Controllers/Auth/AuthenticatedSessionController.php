<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\Siswa;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('auth.login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Validate the request
        $credentials = $request->only('email', 'password');

        // Try to authenticate as User
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();
            $redirectUrl = '';

            // Set redirect URL based on user role
            switch ($user->role) {
                case 'admin':
                case 'petugas':
                    $redirectUrl = route('dashboard');
                    break;
                case 'siswa':
                    $redirectUrl = route('siswa.dashboard');
                    break;
                default:
                    $redirectUrl = route('home'); // Fallback route
                    break;
            }

            return redirect()->intended($redirectUrl);
        }

        // Try to authenticate as Siswa
        if ($siswa = Siswa::where('email', $request->email)->first()) {
            if (Hash::check($request->password, $siswa->password)) {
                Auth::guard('siswa')->login($siswa);
                return redirect()->route('siswa.dashboard'); // Redirect to siswa's dashboard
            }
        }

        // If authentication fails
        throw ValidationException::withMessages([
            'email' => __('The provided credentials do not match our records.'),
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
{
    // Check if the user is authenticated via the 'web' guard
    if (Auth::guard('web')->check()) {
        Auth::guard('web')->logout();
    }

    // Check if the user is authenticated via the 'siswa' guard
    if (Auth::guard('siswa')->check()) {
        Auth::guard('siswa')->logout();
    }

    // Invalidate the session
    $request->session()->invalidate();

    // Regenerate the token to prevent session fixation
    $request->session()->regenerateToken();

    // Redirect to the home page or login page
    return redirect('/');
}

}