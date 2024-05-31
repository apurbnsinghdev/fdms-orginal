<?php

namespace App\Http\Controllers;
use App\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect;
use Validator;

class SiteSettingsController extends Controller {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$site_settings = $this->site_settings;
		//dd($banners);
		return View('site_settings.edit', compact('site_settings'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$data = request()->except('_method', '_token');

		$validator = Validator::make($data,
			array(
				'site_title' => 'required',
				'site_author' => 'required',
				'author_email' => 'required|email',
				'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
			)
		);

		if ($validator->fails()) {
			return Redirect::route("site_settings.edit", $id)
				->withErrors($validator)
				->withInput();
		}
		//dd($data);
		$imageName = null;
		$file = request()->file('logo');
		$old_image_name = $data['old_image'];
		if ($file != null) {
			$imageName = time() . '_' . $file->getClientOriginalName();
			$data['logo'] = $imageName;
		}
		//dd($data);
		unset($data['old_image']);
		$site_settings_data = SiteSetting::where('id', $id)->update($data);

		if ($site_settings_data) {
			if ($imageName != null) {
				Storage::delete('images/' . $old_image_name);
				$file->storeAs('images', $imageName);
			}
			$message = "You have successfully updated";
			return redirect()->route('site_settings.edit', $id)
				->with('flash_success', $message);
		} else {
			$message = "Nothing changed!! Please try again";
			return redirect()->route('site_settings.edit', $id)
				->with('flash_warning', $message);
		}
	}

}
