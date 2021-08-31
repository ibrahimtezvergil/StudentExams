<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamGrade extends Model
{
    use HasFactory;

    protected $hidden = [
        "created_at",
        "updated_at",
        "id",
        "student_id"
    ];

    protected $fillable = [
        'student_id',
        'first_exam',
        'second_exam',
        'third_exam',
        'first_performance',
        'second_performance',
        'project'
    ];

    public static array $rules = [
        'student_id' => ['integer'],
        'first_exam' => ['integer', 'nullable'],
        'second_exam' => ['integer', 'nullable'],
        'third_exam' => ['integer', 'nullable'],
        'first_performance' => ['integer', 'nullable'],
        'second_performance' => ['integer', 'nullable'],
        'project' => ['integer', 'nullable']
    ];

    public static array $ensRules = [
        'student_id' => ['required']
    ];
}
