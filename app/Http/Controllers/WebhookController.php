<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

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

    private function defaultFallback(){
        return "I can't understand";
    }
}
