<?php
// app/Http/Middleware/RedirectToProperPanelMiddleware.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Filament\Pages\Dashboard;

class RedirectToProperPanelMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();

            // Cek role dengan Spatie
            if ($user->hasRole('admin')) {
                return redirect()->to(Dashboard::getUrl(panel: 'admin'));
            }

            if ($user->hasRole('technician')) {
                return redirect()->to(Dashboard::getUrl(panel: 'technician'));
            }

            if ($user->hasRole('user')) {
                return redirect()->to(Dashboard::getUrl(panel: 'user'));
            }
        }

        return $next($request);
    }
}
