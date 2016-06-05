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

        //$result = '';

        // Save submission to DB
        $submission = new Submission();
        $submission->problemId = $request->input('problemId');
        $submission->courseId = $request->input('courseId');
        $submission->examId = null;
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

        SoapWrapper::service('judge', function ($service) use ($data, $submission) {
            $result = $service->call('judge', [$data])->return;
            $decoded = json_decode($result, true);
            if (array_key_exists('score', $decoded)) {
                $submission->resultScore = intval($decoded['score']);
            }
            $submission->result = $result;
            $submission->save();
        });

        return $submission->result;
    }
}
