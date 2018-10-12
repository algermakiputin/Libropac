<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\settings;

class SettingsController extends Controller
{
    public function about() {
    		$name = "about";
    		$exist = settings::where('name', $name)->count();
    		$about = settings::where('name', $name)->first();


    		return view('dashboard.settings.about', compact('exist','about'));
    		
    }

    public function storeAbout(Request $request) {
		$name = "about";
		$exist = settings::where('name', $name)->count();   
        
		if (!$exist) {

			 settings::create([
					'name' => $name, 
					'tag_line' => $request->input('tag-line'),
					'content' =>  $content
				]);
			 return redirect()->back();

		}

		 settings::where('name', $name)->update([
				'name' => $name, 
			'tag_line' => $request->input('tag-line'),
			'content' => $request->input('content')
			]);
		 
         return redirect()->back();

    }
}
