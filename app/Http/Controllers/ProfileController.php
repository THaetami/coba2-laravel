<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Comentary;
use App\Models\Puisi;
use Illuminate\Support\Facades\Hash; //enkripsi password

class ProfileController extends Controller
{

    public function index()
    {
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
        // dd($request);

        $email = Author::where('id', auth()->user()->id)->pluck('email')->first();

        $rules = [
            'name' => 'required|max:30|min:4|regex:/^[a-zA-Z ]*$/'
        ];


        if ($request->email != $email) {
            $rules['email'] = 'required|unique:authors';
        }

        if ($request->password != '') {
            $rules['password'] = 'required|min:5|max:12|regex:/^[a-zA-Z0-9]*$/';
        }

        $validatedData = $request->validate($rules);

        $validatedData['password'] = Hash::make($request->password);

        $validatedData['id'] = auth()->user()->id;

        Author::where('id', Author::where('id', auth()->user()->id)->pluck('id'))->update($validatedData);

        Comentary::where('author_id', auth()->user()->id)->update(['komentator' => $request->name]);

        Puisi::where('author_id', auth()->user()->id)->update(['penulis' => $request->name]);


        return redirect('/myprofile');

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



