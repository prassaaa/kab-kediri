<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AccountDurationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Ambil user dari database untuk mendapatkan model lengkap
            $userId = Auth::id();
            $user = User::find($userId);
            
            // Jika user memiliki durasi dan belum dimulai
            if ($user->duration_days && !$user->duration_started_at) {
                $user->duration_started_at = now();
                $user->duration_ends_at = now()->addDays($user->duration_days);
                $user->save();
            }
            
            // Periksa apakah akun sudah kedaluwarsa
            $isActive = is_null($user->duration_ends_at) || now()->lt($user->duration_ends_at);
            
            if (!$isActive) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                return redirect()->route('login')
                    ->with('error', 'Akun Anda telah kedaluwarsa. Silakan kunjungi kantor Dinas Kebudayaan dan Pariwisata Kabupaten Kediri.');
            }
        }

        return $next($request);
    }
}
