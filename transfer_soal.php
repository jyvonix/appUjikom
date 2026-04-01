<?php

use App\Models\Soal;

$affected = Soal::whereNull('modul_id')->limit(30)->update(['modul_id' => 1]);
echo "Berhasil memindahkan $affected soal ke modul RPL (ID: 1).\n";
