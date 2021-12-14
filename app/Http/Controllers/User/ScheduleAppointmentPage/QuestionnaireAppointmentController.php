<?php

namespace App\Http\Controllers\User\ScheduleAppointmentPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Questionnaire;

class QuestionnaireAppointmentController extends Controller
{
    protected $modelNameQuestionnaire;

    /**
     * Instantiate the variables that will be used to get the model.
     * 
     * @return Collection
     */
    public function __construct()
    {
        $this->modelNameQuestionnaire = new Questionnaire();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allQuestionnaires = $this->modelNameQuestionnaire::select(
            'id',
            'title',
            'scope'
        )
        ->IsActive()
        ->get();

        if ($allQuestionnaires->isEmpty()) 
        {
            return response([
                'title'              => 'Resource(s) not found!',
                'notify_code'        => 'WAR_00001',
                'description'        => 'The questionnaire resource(s) does not exist! Please try again later!',
                'http_response_code' => 404,
                'records'            => [],
            ], 404);
        }
        else 
        {
            return response([
                'title'              => 'Success!',
                'notify_code'        => 'INFO_00001',
                'description'        => 'The questionnaire resource(s) was(were) successfully fetched!',
                'http_response_code' => 200,
                'records'            => $allQuestionnaires,
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $singleQuestionnaire = $this->modelNameQuestionnaire::select(
            'id',
            'title',
            'scope'
        )
        ->IsActive()
        ->where('id', '=', $id)
        ->with([
            'questionnaire_questions' => function ($query) {
                $query->select(
                    'questionnaire_id',
                    'question_type_id',
                    'id',
                    'name',
                    'media_card_url',
                    'answer_suggestion'
                );
            }
        ])
        ->get();

        if ($singleQuestionnaire->isEmpty()) 
        {
            return response([
                'title'              => 'Resource(s) not found!',
                'notify_code'        => 'WAR_00001',
                'description'        => 'The questionnaire resource(s) does not exist! Please try again later!',
                'http_response_code' => 404,
                'records'            => [],
            ], 404);
        }
        else 
        {
            return response([
                'title'              => 'Success!',
                'notify_code'        => 'INFO_00001',
                'description'        => 'The questionnaire resource(s) was(were) successfully fetched!',
                'http_response_code' => 200,
                'records'            => $singleQuestionnaire,
            ], 200);
        }
    }
}