<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

use App\Models\ContactMe;

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\UrlSettingsController;

class ContactMeController extends Controller
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
        $displayContactFormImgUrls    = $urlSettings->getContactMePageImagesUrl();
        $getNavigationBarUrls         = $urlSettings->getNavigationBarUrls();

        return View::make('pages.contact-me.index', 
            compact(
                'displaySiteOwner', 'displayWebsiteUrl', 
                'displaySocialMediaUrls', 'displayCarouselImgUrls', 'displayContactFormImgUrls', 
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
        $request->validate([
            'full_name'      => 'required',
            'email'          => 'required',
            'message'        => 'required',
            'privacy_policy' => 'required',
        ]);
        ContactMe::create($request->all());
        return redirect()->route('contact-me.index')
                        ->with('success','Message send successfully.');
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