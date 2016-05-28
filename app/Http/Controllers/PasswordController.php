<?php

namespace RealEstate\Http\Controllers;

use Illuminate\Http\Request;

use RealEstate\Http\Requests;

class PasswordController extends Controller
{
    public function showReset()
    {
        return view('dashboard.password.reset');
    }

    private function getValidatorForImages(){
        $uploaded_images = request()->images;
        $rules = array('hasImages' => 'required|accepted' , 'count' => 'min:1');
        $data_for_validator = array('hasImages' => request()->hasFile('images'), 'count' => count($uploaded_images));
        $messages=['hasImages.accepted' =>'Morate izabrati sliku', 'count.min' => 'Morate izabrati bar 1. sliku'];
        $index = 0;
        foreach ($uploaded_images as $image)
        {
            $rules['image'.$index] = 'required|image';
            $data_for_validator['image'.$index] = $image;
            $index++;
        }
        $validator = Validator::make($data_for_validator, $rules ,$messages);
        return $validator;
    }

    public function reset(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        if(!\Hash::check($request->old_password, \Auth::user()->password)){
            return back()->withInput()->withErrors(['old_password' => 'old_password']);
        }

        \Auth::user()->password = \Hash::make($request->password);
        \Auth::user()->save();

        flash('Lozinka uspešno promenjena');
        return redirect('dashboard');
    }
}
