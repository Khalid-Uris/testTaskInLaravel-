<?php

namespace App\Http\Controllers;

use App\Models\UserM;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.addUser');
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
            'name'=>'required|alpha',
            'email'=>'required|email',
            'phone_no'=>'required|numeric',
            'Image'=>'required|image',
            'password'=>'required'
        ]);

        try {
            $image = $request->file('Image');
            if(isset($image)){

                $image_name = $image->getClientOriginalName();
                $image_name = str_replace("" ,'_',time().$image_name);
                $image_path = 'upload/UderImages/';

                $image->move($image_path,$image_name);

                $Image = $image_path.$image_name;
            }else{
                $Image = null;
            }

            $obj=new UserM();
            $obj->name=$request->name;
            $obj->email=$request->email;
            $obj->phone_no=$request->phone_no;
            $obj->Image=$request->Image;
            $obj->password=$request->password;
            $obj->save();

            // return $obj;
            return redirect()->route('admin.showUser');

        } catch (Exception $ex) {
            return back()->withError($ex->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // return session('admin_id');

        $show=UserM::all();
        return view('admin.showUser')->with('show',$show);


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
        $edit=UserM::where('user_id',$id)->first();
        return view('admin.editUser')->with('edit',$edit);
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
        $request->validate([
            'name'=>'required|alpha',
            'email'=>'required|email',
            'phone_no'=>'required|numeric',
            'Image'=>'required|image',
            'password'=>'required'
        ]);

        try {
            $image = $request->file('Image');
        if(isset($image)){

            $image_name = $image->getClientOriginalName();
            $image_name = str_replace("" ,'_',time().$image_name);
            $image_path = 'upload/UderImages/';

            $image->move($image_path,$image_name);

            $Image = $image_path.$image_name;
        }else{
            $Image = $request->previous_image;

        }

        $obj=UserM::where('user_id',$id)->first();
        $obj->name=$request->name;
        $obj->email=$request->email;
        $obj->phone_no=$request->phone_no;
        $obj->Image=$request->Image;
        $obj->password=$request->password;
        $obj->save();

        // return $obj;
        return redirect()->route('admin.showUser');

        } catch (Exception $ex) {
            return back()->withError($ex->getMessage());
        }


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
        $destroy=UserM::where('user_id',$id)->delete();
        return redirect()->route('admin.showUser');
    }
}
