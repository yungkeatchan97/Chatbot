<?php

namespace App\Http\Controllers;

use App\Student;
use App\Handbook;
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
                return $this->getHandbooks();
            case 'getElective':
                return $this->getElective();
            default:
                return $this->defaultFallback();
        }
    }

    private function getStudents(){
        $student = Student::find(7);
        return json_encode($student);
    }

    private function getHandbooks(){
        $handbook = Handbook::find(3);
        return json_encode($handbook);
    }

    private function getElective(){
        $handbook = Handbook::find(5);
        return json_encode($handbook);
    }

    private function defaultFallback(){
        return "I can't understand";
    }
}
