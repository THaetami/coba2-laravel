<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\Hash; //enkripsi password

class ProfileController extends Controller
{

    public function index()
    {
        // $author = Author::where('id', auth()->user()->id)->get();
        // dd($author->pluck('image'));
        return view('myprofile.index', [
            'author' => Author::where('id', auth()->user()->id)->first()
        ]);
    }


    public function crop(Request $request)
    {

        $request->validate([
            'image' => 'image|file|max:500',
        ]);


        $dest = 'storage/upload/'; //where user images will be stored
        $file = $request->file('image');

        $new_image_name = 'UIMG' . date('YmdHis') . uniqid() . '.jpg';


        // //upload file
        $move = $file->move(public_path($dest), $new_image_name);


        if (!$move) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong}']);
        }
        else {

            $userInfo = Author::where('id', auth()->user()->id)->pluck('image')->first();
            // dd($userInfo);

            if ($userInfo != '') {
                unlink($dest.$userInfo);
            }

            Author::where('id', auth()->user()->id)->first()->update(['image' => $new_image_name]);
            //Update new picture
            return response()->json(['status' => 1, 'msg' => 'Your profile pricture updated', 'name' => $new_image_name]);
        }

    }

    public function update(Request $request)
    {

        $email = Author::where('id', auth()->user()->id)->pluck('email')->first();
        // dd($email);
        $rules = [
            'name' => 'required|max:225|regex:/^[a-zA-Z ]*$/'
        ];

        if ($request->password != '') {
            $rules['password'] = 'required|min:5 max:12|regex:/^[a-zA-Z0-9]*$/';
        }

        if ($request->email != $email) {
            $rules['email'] = 'required|unique:authors';
        }



        $validatedData = $request->validate($rules);
        $validatedData['password'] = Hash::make($validatedData['password']);

        $validatedData['id'] = auth()->user()->id;

        Author::where('id', Author::where('id', auth()->user()->id)->pluck('id'))->update($validatedData);

        return redirect('/myprofile');




        // $pass = Author::where('id', auth()->user()->id)->pluck('password');

        // $credential = $request->validate([
        //     'passwordLama' => 'required'
        // ]);

        // if (Auth::attempt($credential)) {

        // }

        // // dd($pass);

        // $validatedData = $request->validate([ //validasi proses authenticate
        //     'name' => 'required|max:225|regex:/^[a-zA-Z ]*$/',
        //     'email' => 'required|email:dns|unique:authors',
        //     'password' => 'required|min:5 max:12|regex:/^[a-zA-Z0-9]*$/'
        // ]);

        // // $validatedData['password'] =bcrypt($validatedData['password']);
        // $validatedData['password'] = Hash::make($validatedData['password']);
        // $validatedData['id'] = auth()->user()->id;

        // Author::where('id', $request->id)->update($validatedData);
    }
}




































































//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// dd($author->image);

// $authorImage = $author->image;

// unlink('upload/'.$author->image);








// $validatedData = $request->validate([
//     'image' => 'image|file|max:2024',
// ]);

// dd($request->file('image'));



// if ($request->file('image')) {

//     if ($request->oldImage) {
//         Storage::delete($request->oldImage);
//     }

//     $request['image'] = $request->file('image')->store('upload');
// }



// $userInfo = Author::where('id', auth()->user()->id)->get();
// // dd($userInfo);
// $userPhoto = $userInfo->pluck('image');
// dd($userPhoto);

// $dest = 'upload'; //where user images will be stored
// $file = $request->file('image');

// $new_image_name = 'UIMG'.date('YmdHis').uniqid().'.jpg';

// // //upload file
// $move = $file->move(public_path($dest), $new_image_name);


// if(!$move) {
//     return response()->json(['status'=>0, 'msg'=>'Something went wrong']);
// }
// else {
//     //delete old image if exists
//     $userInfo = Author::where('id', auth()->user()->id)->get();
//     // dd($userInfo);
//     // $userInfo = Author::where('id', auth()->user()->id)->get();
//     $userPhoto = $userInfo->pluck('image');
//     // dd($userPhoto);
//     if($userPhoto !== '') {
//         unlink($dest.$userPhoto);
//     }
//     //Update new picture
//     Author::where('id', auth()->user()->id)->get()->update(['image'=>$new_image_name]);
//     return response()->json(['status'=>1, 'msg'=>'Your profile pricture updated', 'name'=>$new_image_name]);
// }



