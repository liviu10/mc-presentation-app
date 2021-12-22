<?php

namespace App\Http\Controllers\User\ScheduleAppointmentPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Questionnaire\Questionnaire;

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
        dd($request);
        try 
        {
            $request->validate([
                'answer_1' => 'accepted',
                'answer_2' => 'accepted',
                'answer_3' => 'accepted',
                'answer_4' => 'accepted',
                'answer_5' => 'required',
            ]);
            $records = $this->modelNameContactMe->create([
                'answer_1' => $request->get('answer_1'),
                'answer_2' => $request->get('answer_2'),
                'answer_3' => $request->get('answer_3'),
                'answer_4' => $request->get('answer_4'),
                'answer_5' => $request->get('answer_5'),
            ]);
            $apiInsertSingleRecord = [
                'answer_1' => $records['answer_1'],
                'answer_2' => $records['answer_2'],
                'answer_3' => $records['answer_3'],
                'answer_4' => $records['answer_4'],
                'answer_5' => $records['answer_5'],
            ];
            return response()->json($apiInsertSingleRecord);
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