<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\UpdateStudentExamRequest;
use App\Http\Services\StudentExamService;
use App\Http\Traits\ModelOperationTrait;
use App\Models\Student;


class StudentsController extends AppBaseController
{
    use ModelOperationTrait;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $result = $this->getModels(Student::class, Student::$relation);

            return $this->sendResponse($result, "SUCCESS", true);
        } catch (\Exception $e) {

            return $this->sendError("ERROR", false);

        }

    }

    /**
     * @param UpdateStudentExamRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateStudentExamRequest $request, $id)
    {
        try {
            $studentExam =new StudentExamService();
            $result = $studentExam->updateExams($request->all(),$id);
            return $this->sendResponse($result, "SUCCESS", true);;
        } catch (\Exception $e) {

            return $this->sendError($e->getMessage(), false);
        }
    }


}
