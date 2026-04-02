<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\Admin\SoalController;
use App\Http\Controllers\Admin\NilaiController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->user()->role === 'guru') {
        return redirect()->route('guru.dashboard');
    } elseif (auth()->user()->role === 'siswa') {
        return redirect()->route('siswa.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\Admin\ModulController as AdminModulController;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        $stats = [
            'admin' => \App\Models\User::where('role', 'admin')->count(),
            'guru' => \App\Models\User::where('role', 'guru')->count(),
            'siswa' => \App\Models\User::where('role', 'siswa')->count(),
            'modul' => \App\Models\Modul::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    })->name('admin.dashboard');

    Route::resource('/admin/modul', AdminModulController::class)->names([
        'index' => 'admin.modul.index',
        'create' => 'admin.modul.create',
        'store' => 'admin.modul.store',
        'show' => 'admin.modul.show',
        'edit' => 'admin.modul.edit',
        'update' => 'admin.modul.update',
        'destroy' => 'admin.modul.destroy',
    ]);


    Route::resource('/admin/admin', AdministratorController::class)->names([
        'index' => 'admin.admin.index',
        'create' => 'admin.admin.create',
        'store' => 'admin.admin.store',
        'edit' => 'admin.admin.edit',
        'update' => 'admin.admin.update',
        'destroy' => 'admin.admin.destroy',
    ]);

    Route::resource('/admin/guru', GuruController::class)->names([
        'index' => 'admin.guru.index',
        'create' => 'admin.guru.create',
        'store' => 'admin.guru.store',
        'edit' => 'admin.guru.edit',
        'update' => 'admin.guru.update',
        'destroy' => 'admin.guru.destroy',
    ]);

    Route::resource('/admin/siswa', SiswaController::class)->names([
        'index' => 'admin.siswa.index',
        'create' => 'admin.siswa.create',
        'store' => 'admin.siswa.store',
        'edit' => 'admin.siswa.edit',
        'update' => 'admin.siswa.update',
        'destroy' => 'admin.siswa.destroy',
    ]);

    Route::get('/admin/soal/export', [SoalController::class, 'export'])->name('admin.soal.export');
    Route::post('/admin/soal/import', [SoalController::class, 'import'])->name('admin.soal.import');
    Route::resource('/admin/soal', SoalController::class)->except(['index'])->names([
        'create' => 'admin.soal.create',
        'store' => 'admin.soal.store',
        'edit' => 'admin.soal.edit',
        'update' => 'admin.soal.update',
        'destroy' => 'admin.soal.destroy',
    ]);
    Route::get('/admin/kunci-jawaban', [SoalController::class, 'kunciJawaban'])->name('admin.soal.kunci');

    Route::get('/admin/nilai', [NilaiController::class, 'index'])->name('admin.nilai.index');
    Route::get('/admin/nilai/export', [NilaiController::class, 'export'])->name('admin.nilai.export');
    Route::delete('/admin/nilai/{nilai}', [NilaiController::class, 'destroy'])->name('admin.nilai.destroy');

    Route::get('/admin/setting', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.setting.index');
    Route::put('/admin/setting', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.setting.update');
});

use App\Http\Controllers\Guru\SoalController as GuruSoalController;
use App\Http\Controllers\Guru\NilaiController as GuruNilaiController;

use App\Http\Controllers\Guru\ModulController as GuruModulController;

Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', function () {
        $stats = [
            'soal' => \App\Models\Soal::where('user_id', auth()->id())->count(),
            'total_nilai' => \App\Models\Nilai::count(),
            'siswa' => \App\Models\User::where('role', 'siswa')->count(),
        ];
        return view('guru.dashboard', compact('stats'));
    })->name('guru.dashboard');

    Route::resource('/guru/modul', GuruModulController::class)->names([
        'index' => 'guru.modul.index',
        'create' => 'guru.modul.create',
        'store' => 'guru.modul.store',
        'show' => 'guru.modul.show',
        'edit' => 'guru.modul.edit',
        'update' => 'guru.modul.update',
        'destroy' => 'guru.modul.destroy',
    ]);

    Route::get('/guru/soal/bulk', [GuruSoalController::class, 'bulkCreate'])->name('guru.soal.bulk');
    Route::post('/guru/soal/bulk', [GuruSoalController::class, 'bulkStore'])->name('guru.soal.bulk.store');
    Route::get('/guru/soal/export', [GuruSoalController::class, 'export'])->name('guru.soal.export');
    Route::post('/guru/soal/import', [GuruSoalController::class, 'import'])->name('guru.soal.import');
    Route::get('/guru/kunci-jawaban', [GuruSoalController::class, 'kunciJawaban'])->name('guru.soal.kunci');
    Route::resource('/guru/soal', GuruSoalController::class)->except(['index'])->names([
        'create' => 'guru.soal.create',
        'store' => 'guru.soal.store',
        'show' => 'guru.soal.show',
        'edit' => 'guru.soal.edit',
        'update' => 'guru.soal.update',
        'destroy' => 'guru.soal.destroy',
    ]);

    Route::get('/guru/nilai', [GuruNilaiController::class, 'index'])->name('guru.nilai.index');
    Route::get('/guru/nilai/export', [GuruNilaiController::class, 'export'])->name('guru.nilai.export');
    Route::get('/guru/nilai/pdf', [GuruNilaiController::class, 'exportPdf'])->name('guru.nilai.pdf');
});

use App\Http\Controllers\Siswa\SiswaController as StudentSiswaController;

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/dashboard', [StudentSiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/siswa/soal', [StudentSiswaController::class, 'indexSoal'])->name('siswa.soal.index');
    Route::get('/siswa/ujian', [StudentSiswaController::class, 'kerjakanUjian'])->name('siswa.soal.kerjakan');
    Route::post('/siswa/ujian', [StudentSiswaController::class, 'simpanUjian'])->name('siswa.soal.simpan');
    Route::get('/siswa/nilai', [StudentSiswaController::class, 'indexNilai'])->name('siswa.nilai.index');
    Route::get('/siswa/nilai/{id}/preview', [StudentSiswaController::class, 'previewNilai'])->name('siswa.nilai.preview');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
