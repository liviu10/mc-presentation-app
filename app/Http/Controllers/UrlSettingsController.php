<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class UrlSettingsController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of pages folder.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNavigationBarUrls()
    {
        $getViewsPagesFolder = Storage::disk('pages')->directories();
        $getViewsPagesUrls = [
            0 => [
                "folder_name" => "Home",
                "folder_path" => '/',
            ],
            1 => [
                "folder_name" => str_replace('-', ' ', ucwords($getViewsPagesFolder[3], '-')),
                "folder_path" => '/' . $getViewsPagesFolder[3],
            ],
            2 => [
                "folder_name" => str_replace('-', ' ', ucwords($getViewsPagesFolder[1], '-')),
                "folder_path" => '/' . $getViewsPagesFolder[1],
            ],
            3 => [
                "folder_name" => str_replace('-', ' ', ucwords($getViewsPagesFolder[0], '-')),
                "folder_path" => '/' . $getViewsPagesFolder[0],
            ],
            4 => [
                "folder_name" => str_replace('-', ' ', ucwords($getViewsPagesFolder[2], '-')),
                "folder_path" => '/' . $getViewsPagesFolder[2],
            ],
        ];

        return $getViewsPagesUrls;
    }

    /**
     * Display the site url.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSiteUrl()
    {
        $getSiteUrl = config('app.url');

        return $getSiteUrl;
    }

    /**
     * Display the social media urls.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSocialMediaUrls()
    {
        $getSocialMediaUrls = [
            $facebook = [
                'name'  => 'Facebook',
                'url'   => config('app.facebook_url'),
                'class' => 'fab fa-facebook-f',
            ],
            $instagram = [
                'name'  => 'Instagram',
                'url'   => config('app.instagram_url'),
                'class' => 'fab fa-instagram',
            ],
            $youtube = [
                'name'  => 'Youtube',
                'url'   => config('app.youtube_url'),
                'class' => 'fab fa-youtube'
            ],
        ];

        return $getSocialMediaUrls;
    }

    /**
     * Get carousel images url.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCarouselImagesUrl()
    {
        $getCarouselFolder = Storage::disk('carousel')->allFiles();

        return $getCarouselFolder;
    }

    /**
     * Get main categories images url.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMainCategoriesImagesUrl()
    {
        $getMainCategoriesFolder = Storage::disk('categories')->allFiles();

        return $getMainCategoriesFolder;
    }

    /**
     * Get contact me page image url.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getContactMePageImagesUrl()
    {
        $getContactFormFolder = Storage::disk('contact')->files();

        return $getContactFormFolder;
    }
}