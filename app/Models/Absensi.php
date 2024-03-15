<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'teaching_role',
        'date',
        'start',
        'end',
        'duration',
        'id_code',
    ];

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }

    public function materi() {
        return $this->belongsTo(Materi::class);
    }
}
