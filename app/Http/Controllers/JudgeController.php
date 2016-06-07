<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Artisaninweb\SoapWrapper\Facades\SoapWrapper;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Mockery\CountValidator\Exception;

class JudgeController extends Controller
{
    var $submission;

    public function submit(Request $request, $course_id, $problem_id)
    {
        // Save submission to DB
        $submission = new Submission();
        $submission->problemId = $problem_id;
        $submission->courseId = $course_id;
        $submission->examId = null;
        $submission->userId = Auth::user()->userId;
        $submission->language = $request->input('language');
        $submission->sourceCode = $request->input('source_code');
        $submission->save();

        // Start judge service
        SoapWrapper::add(function ($service) {
            $service
                ->name('judge')
                ->wsdl('http://dumpcodehub.now-ip.org/JudgeServer/JudgeService?WSDL')
                ->trace(true)
                ->cache(WSDL_CACHE_NONE);
        });

        $data = [
            'problemId' => $submission->problemId,
            'sourceCode' => $submission->sourceCode,
            'language' => $submission->language,
            'limitTime' => $submission->problem->timeLimit,
            'limitMemory' => 0,
            'isUseCustomCheck' => false,
        ];

        try {
            SoapWrapper::service('judge', function ($service) use ($data, $submission) {
                $result = $service->call('judge', [$data])->return;
                $decoded = json_decode($result, true);
                if (array_key_exists('score', $decoded)) {
                    $submission->resultScore = intval($decoded['score']);
                }
                $submission->result = $result;
                $submission->save();
            });
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
        session()->flash('is_submitted', true);
        return Redirect::back();
    }

    public function submitExam(Request $request, $exam_id, $problem_id)
    {
        // Save submission to DB
        $submission = new Submission();
        $submission->problemId = $problem_id;
        $submission->courseId = null;
        $submission->examId = $exam_id;
        $submission->userId = Auth::user()->userId;
        $submission->language = $request->input('language');
        $submission->sourceCode = $request->input('source_code');
        $submission->save();

        // Start judge service
        SoapWrapper::add(function ($service) {
            $service
                ->name('judge')
                ->wsdl('http://codehub.now-ip.org/JudgeServer/JudgeService?WSDL')
                ->trace(true)
                ->cache(WSDL_CACHE_NONE);
        });

        $data = [
            'problemId' => $submission->problemId,
            'sourceCode' => $submission->sourceCode,
            'language' => $submission->language,
            'limitTime' => $submission->problem->timeLimit,
            'limitMemory' => 0,
            'isUseCustomCheck' => false,
        ];

        try {
            SoapWrapper::service('judge', function ($service) use ($data, $submission) {
                $result = $service->call('judge', [$data])->return;
                $decoded = json_decode($result, true);
                if (array_key_exists('score', $decoded)) {
                    $submission->resultScore = intval($decoded['score']);
                }
                $submission->result = $result;
                $submission->save();
            });
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
        session()->flash('is_submitted', true);
        return Redirect::back();
    }

    public function submitAjax(Request $request)
    {

        $result = '';
        try{
            // Save submission to DB
            $this->submission = new Submission();
            $this->submission->problemId = $request->input('problemId');
            $this->submission->courseId = $request->input('courseId');
            $this->submission->examId = null;
            $this->submission->userId = Auth::user()->userId;
            $this->submission->language = $request->input('language');
            $this->submission->sourceCode = $request->input('sourceCode');
            //while(1);
            //$a = 1/0;
            //$this->submission->save();
            return 'OK';
        }catch(\Exception $ex){
            return 'Error';
        }


    }

    public function callJudge(){
        SoapWrapper::add(function ($service) {
            $service
                ->name('judge')
                ->wsdl('http://codehub.now-ip.org/JudgeServer/JudgeService?WSDL')
                ->trace(true)
                ->cache(WSDL_CACHE_NONE);
        });

        $data = [
            'problemId' => $this->submission->problemId,
            'sourceCode' => $this->submission->sourceCode,
            'language' => $this->submission->language,
            'limitTime' => $this->submission->problem->timeLimit,
            'limitMemory' => 0,
            'isUseCustomCheck' => false,
        ];

        SoapWrapper::service('judge', function ($service) use ($data) {
            $result = $service->call('judge', [$data])->return;
            $decoded = json_decode($result, true);
            if (array_key_exists('score', $decoded)) {
                $this->submission->resultScore = intval($decoded['score']);
            }
            $this->submission->result = $result;
            $this->submission->save();
        });
    }
}
