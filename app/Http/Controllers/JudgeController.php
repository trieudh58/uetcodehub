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
        $submission->problem_id = $problem_id;
        $submission->course_id = $course_id;
        $submission->user_id = Auth::user()->user_id;
        $submission->language = $request->input('language');
        $submission->source_code = $request->input('source_code');
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
            'problemId' => $submission->problem_id,
            'sourceCode' => $submission->source_code,
            'language' => $submission->language,
            'limitTime' => $submission->problem->time_limit,
            'limitMemory' => 0,
            'isUseCustomCheck' => false,
        ];

        try {
            SoapWrapper::service('judge', function ($service) use ($data, $submission) {
                $result = $service->call('judge', [$data])->return;
                $decoded = json_decode($result, true);
                if (array_key_exists('score', $decoded)) {
                    $submission->result_score = intval($decoded['score']);
                }
                $submission->result = $result;
                $submission->save();
            });
        }
        catch (Exception $e) {
            echo 'Message: '.$e->getMessage();
        }
        session()->flash('is_submitted', true);
        return Redirect::back();
    }
}
