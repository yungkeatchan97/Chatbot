<?php

namespace App\Http\Controllers;

use App\Student;
use App\Handbook;
use App\Subject;
use App\Course;
use Illuminate\Http\Request;

//install ==> composer require twilio/sdk
require __DIR__ . "/vendor/autoload.php";
use Twilio\Rest\Client;

class WebhookController extends Controller
{
    public function webhook(Request $request)
    {
        $queryResult = ($request->get('queryResult'))['action'];
        $parameters = ($request->get('queryResult'))['parameters'];
        $response = $this->findAction($queryResult, $parameters);

        $fulfillment = array(
            "fulfillmentText" => $response
        );

        return json_encode($fulfillment);
    }

    private function findAction($queryResult, $parameters)
    {
        switch ($queryResult){
            case 'getStudents':
                return $this->getStudents($parameters['MatricNumber']);
            case 'getHandbook':
                return $this->getHandbook();
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

    private function getHandbook(){
        $handbook = Handbook::find(2);
        return json_encode($handbook);
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
