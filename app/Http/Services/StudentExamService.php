<?php


namespace App\Http\Services;

use App\Models\ExamGrade;

/**
 * Class StudentExamService
 * @package App\Http\Services
 */
class StudentExamService
{
    /**
     * @param array $request
     * @param $student_id
     * @return mixed
     */
    public function updateExams(array $request, $id)
    {

        $model = ExamGrade::where('student_id',$id)->first();
        if (!$model){
            $model = new ExamGrade();
            $model->student_id = $id;
        }
        $model->first_exam = $request['first_exam'];
        $model->second_exam = $request['second_exam'];
        $model->third_exam = $request['third_exam'];
        $model->first_performance = $request['first_performance'];
        $model->second_performance = $request['second_performance'];
        $model->project = $request['project'];
        return $model->save();


    }
}
