<?php

namespace App\Http\Controllers;

use App\Student;
use App\Handbook;
use App\Subject;
use App\Course;
use Illuminate\Http\Request;
require_once '/path/to/vendor/autoload.php';
use Twilio\Rest\Client;

class WebhookController extends Controller
{
    public function webhook(Request $request)
    {
        $queryResult = ($request->get('queryResult'))['action'];


        $response = $this->findAction($queryResult);

        $fulfillment = array(
            "fulfillmentText" => $response
        );


        return json_encode($fulfillment);
    }

    private function findAction($queryResult)
    {

        switch ($queryResult){
            case 'getStudents':
                return $this->getStudents();
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

    private function getStudents(){
        $student = Student::find(1);
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

    private function sendImage(){
        $sid = "AC1c00c8c6658ccd0d856890662cdaf094";
        $token = "56935569ff8bdec69eeee97725ea7b37";
        $client = new Client($sid, $token);
        $client->messages->create(
            "whatsapp:+6011-16408278",
            array(
                'from' => "whatsapp:+14155238886",
                'body' => "Hi Joe! Please find your boarding pass attached. Flight OA2345 departs at 11 pm PST.",
                'mediaUrl' => "https://emerald-coral-3661.twil.io/assets/2-OwlAir-Upcoming-Trip.PNG",
            )
        );
    }

    private function defaultFallback(){
        return "I can't understand";
    }
}
