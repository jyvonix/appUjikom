<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'kkm' => Setting::get('kkm', 75),
            'max_retakes' => Setting::get('max_retakes', 1),
            'point_per_question' => Setting::get('point_per_question', 10),
            'score_divisor' => Setting::get('score_divisor', 1),
            'exam_duration' => Setting::get('exam_duration', 60), // default 60 menit
        ];

        return view('admin.setting.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'kkm' => ['required', 'numeric', 'min:0', 'max:100'],
            'max_retakes' => ['required', 'numeric', 'min:1'],
            'point_per_question' => ['required', 'numeric', 'min:0'],
            'score_divisor' => ['required', 'numeric', 'min:0.01'],
            'exam_duration' => ['required', 'numeric', 'min:1'],
        ]);

        Setting::set('kkm', $request->kkm);
        Setting::set('max_retakes', $request->max_retakes);
        Setting::set('point_per_question', $request->point_per_question);
        Setting::set('score_divisor', $request->score_divisor);
        Setting::set('exam_duration', $request->exam_duration);

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
