<?php

namespace App\Http\Controllers;

use App\Student;
use App\Handbook;
use App\Subject;
use App\Course;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function webhook(Request $request)
    {
        $queryResult = ($request->get('queryResult'))['action'];
        $parameters = ($request->get('queryResult'))['parameters'];
        $outputContexts = ($request->get('queryResult'))['outputContexts'][0]['parameters'];
        $response = $this->findAction($queryResult, $parameters, $outputContexts);

        $fulfillment = array(
            "fulfillmentText" => $response
        );

        return json_encode($fulfillment);
    }

    private function findAction($queryResult, $parameters, $outputContexts)
    {
        switch ($queryResult){
            case 'getStudents':
                return $this->getStudents($parameters['MatricNumber']);
            case 'getHandbook':
                return $this->getHandbook($outputContexts['MatricNumber']);
            case 'getCourse':
                return $this->getCourse();
            case 'getSubject':
                return $this->getSubject();
            default:
                return $this->defaultFallback();
        }
    }

    private function getStudents($matricNumber){
        $student = Student::where('matric_no', '=', $matricNumber)->first();
        if (is_null($student)){
            return "student not found";
        }
        return json_encode($student);
    }

    private function getHandbook($matricNumber){
        $handbook = Student::where('matric_no', '=', $matricNumber)->first()->handbook;
        $course = Course::where('code', '=', $handbook->course_code)->first();
        $requiredSubjects = $handbook->requiredSubjects;
        $optionalSubjects = $handbook->optionalSubjects;
        $response = "Your handbook:\nCourse : ".$course->name
            ."\nYear : ".$handbook->year
            ."\nRequired Subjects:";
        foreach ($requiredSubjects as $subject) {
            $response .= $subject->code."   ".$subject->name."\n";
        }
        $response .= "Optional Subjects:";
        foreach ($optionalSubjects as $subject) {
            $response .= $subject->code."   ".$subject->name;
        }
        return $response;
    }

    private function getCourse(){
        $course = Course::find(3);
        return json_encode($course);
    }

    private function getSubject(){
        $subject = Subject::find(4);
        return json_encode($subject);
    }

    private function defaultFallback(){
        return "I can't understand";
    }
}
