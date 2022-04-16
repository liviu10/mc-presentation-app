<?php

namespace App\Http\Controllers\User\ScheduleAppointmentPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Questionnaire\Questionnaire;
use App\Models\Questionnaire\QuestionnaireResponse;

class QuestionnaireAppointmentController extends Controller
{
    protected $modelNameQuestionnaire;
    protected $modelNameQuestionnaireResponse;

    /**
     * Instantiate the variables that will be used to get the model.
     * 
     * @return Collection
     */
    public function __construct()
    {
        $this->modelNameQuestionnaire = new Questionnaire();
        $this->modelNameQuestionnaireResponse = new QuestionnaireResponse();
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
            'title'
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
        try 
        {
            $records = $this->modelNameQuestionnaireResponse->create([
                'questionnaire_answer_id' => $request->get('questionnaire_answer_id'),
                'response_1' => $request->get('response_1'),
                'response_2' => $request->get('response_2'),
                'response_3' => $request->get('response_3'),
                'response_4' => $request->get('response_4'),
                'response_5' => $request->get('response_5'),
            ]);
            $apiInsertSingleRecord = [
                'questionnaire_answer_id' => $request->get('questionnaire_answer_id'),
                'response_1' => $request->get('response_1'),
                'response_2' => $request->get('response_2'),
                'response_3' => $request->get('response_3'),
                'response_4' => $request->get('response_4'),
                'response_5' => $request->get('response_5'),
            ];
            return response()->json(true);
        }
        catch  (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([], 500)->json();
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([], 500)->json();
            }
        }
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
                // TODO: Paginate eloquent results and display 5-6 questions per page
                $query->select(
                    'questionnaire_id',
                    'question_type_id',
                    'id',
                    'name',
                    'answer_suggestion',
                    'questionnaire_media_type_id',
                    'media_card_url'
                );
            },
            'questionnaire_questions.questionnaire_answers' => function ($query) {
                $query->select(
                    'questionnaire_question_id',
                    'id',
                    'answer_1',
                    'answer_2',
                    'answer_3',
                    'answer_4',
                    'answer_5'
                );
            },
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