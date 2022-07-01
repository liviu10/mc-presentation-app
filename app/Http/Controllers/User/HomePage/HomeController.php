<?php

namespace App\Http\Controllers\User\HomePage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageSectionTestimonial;

class HomeController extends Controller
{
    protected $modelNamePageSectionTestimonials;
    protected $tableNamePageSectionTestimonials;

    /**
     * Instantiate the variables that will be used to get the model and table name as well as the table's columns.
     *
     * @return Collection|String
     */
    public function __construct()
    {
        $this->modelNamePageSectionTestimonials = new PageSectionTestimonial();
        $this->tableNamePageSectionTestimonials = $this->modelNamePageSectionTestimonials->getTable();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Display the testimonial section.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayTestimonialSection()
    {
        $apiDisplayAllTestimonials = $this->modelNamePageSectionTestimonials->select('id', 'page_section_id', 'name', 'occupation', 'description')
                                    ->where('page_section_id', '=', 3)
                                    ->get();
            if ($apiDisplayAllTestimonials->isEmpty())
            {
                return response([
                    'title'              => 'Resource(s) not found!',
                    'notify_code'        => 'WAR_00001',
                    'description'        => 'The testimonial resource(s) does not exist! Please try again later!',
                    'http_response_code' => 404,
                    'records'            => [],
                ], 404);
            }
            else
            {
                return response([
                    'title'              => 'Success!',
                    'notify_code'        => 'INFO_00001',
                    'description'        => 'The testimonial resource(s) was(were) successfully fetched!',
                    'http_response_code' => 200,
                    'records'            => $apiDisplayAllTestimonials,
                ], 200);
            }
    }
}
