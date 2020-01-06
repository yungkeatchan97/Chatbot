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
            case 'canGraduate':
                return $this->canGraduate($outputContexts['MatricNumber']);
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
            return "I'm sorry but the matric number you provided does not match any record in our database. Please try again.\n
            You can still ask questions such as:\n
            1. Course Structure\n
            2. Registration\n
            3. Change Programme\n
            4. Credit Transfer\n
            5. Late Registration\n
            6. Registration credit per semester\n
            7. Academic Adviser";
        }
        return "How can I help you? You could also ask other questions which are not listed as below.\n
            1. Course Structure\n
            2. Registration\n
            3. Change Programme\n
            4. Credit Transfer\n
            5. Late Registration\n
            6. Registration credit per semester\n
            7. Academic Adviser\n
            8. My Handbook\n
            9. Can I Graduate?\n
            10. Can I Register New Subjects now?";
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

    private function canGraduate($matricNumber)
    {
        $student = Student::where('matric_no', '=', $matricNumber)->first();
        $registereds = $student->registeredSubjects;
        $neededs = $student->handbook->requiredSubjects;
        $lack = array();
        foreach ($neededs as $needed){
            $found = false;
            foreach ($registereds as $registered){
                if ($needed->id == $registered->id){
                    $found = true;
                    break;
                }
            }
            if (!$found){
                array_push($lack, $needed);
            }
        }
        if (empty($lack) && $student->creditHour >= $student->handbook->total_credit_hour){
            $response = "Yes, you can graduate";
        }
        elseif (empty($lack)){
            $response = "No, you cannot graduate. You need at least ".$student->handbook->total_credit_hour." to graduate but you have only ".$student->creditHour;
        }else{
            $response = "No, you cannot graduate. You still need to take the following subjects:\n";
            foreach ($lack as $item){
                $response .= $item->code."   ".$item->name."\n";
            }
        };
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
