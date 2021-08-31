<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public static $relation = [
        'notes',
        'classRoom'
    ];

    public function notes(){
        return $this->hasOne(ExamGrade::class, 'student_id', 'id');
    }

    public function classRoom(){
        return $this->belongsTo(ClassRoom::class, 'class_room_id', 'id');
    }
}
