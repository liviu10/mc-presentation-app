<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\UrlSettingsController;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $websiteInformation           = new UserController;
        $urlSettings                  = new UrlSettingsController;
        $displaySiteOwner             = $websiteInformation->getSiteOwner();
        $displayWebsiteUrl            = $urlSettings->getSiteUrl();
        $displaySocialMediaUrls       = $urlSettings->getSocialMediaUrls();
        $displayCarouselImgUrls       = $urlSettings->getCarouselImagesUrl();
        $displayMainCategoriesImgUrls = $urlSettings->getMainCategoriesImagesUrl();
        $getNavigationBarUrls         = $urlSettings->getNavigationBarUrls();

        return View::make('pages.home', 
            compact('displaySiteOwner', 'displayWebsiteUrl', 
                    'displaySocialMediaUrls', 'displayCarouselImgUrls', 'displayMainCategoriesImgUrls', 
                    'getNavigationBarUrls'
                    )
        )
        ->with('includes.navbar')
        ->with('includes.footer');
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
}