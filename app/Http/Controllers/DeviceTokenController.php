<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeviceTokenRequest;
use App\Http\Requests\UpdateDeviceTokenRequest;
use App\Models\DeviceToken;

class DeviceTokenController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDeviceTokenRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeviceTokenRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeviceToken  $deviceToken
     * @return \Illuminate\Http\Response
     */
    public function show(DeviceToken $deviceToken)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDeviceTokenRequest  $request
     * @param  \App\Models\DeviceToken  $deviceToken
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeviceTokenRequest $request, DeviceToken $deviceToken)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeviceToken  $deviceToken
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeviceToken $deviceToken)
    {
        //
    }
}
