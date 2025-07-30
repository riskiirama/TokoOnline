<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class FilamentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

  public function boot(): void
{
    Filament::serving(function () {
        if (Auth::check()) {
            if (request()->is('admin/login')) {
                if (!Auth::user()->hasRole('admin')) {
                    Auth::logout();
                    session()->invalidate();
                    session()->regenerateToken();

                    // 💡 Flash pesan
                    session()->flash('message', 'Anda telah keluar karena bukan admin.');

                    // Redirect balik ke /admin/login
                    redirect('/admin/login')->send();
                }
            }

            if (request()->is('admin*') && !request()->is('admin/login') && !request()->is('admin/logout')) {
                if (!Auth::user()->hasRole('admin')) {
                    abort(403, 'Hanya admin yang dapat mengakses halaman admin.');
                }
            }
        }
   
});
    }
}
