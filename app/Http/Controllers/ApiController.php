<?php

namespace App\Http\Controllers;

use App\Models\UserM;
use Exception;
use Illuminate\Http\Request;

class ApiController extends Controller
{


    public function getData()
    {
        $getData = UserM::all();
       return response()->json(['getData' => $getData] , 200);
    }

    public function store(Request $request)
    {
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
            return response()->json(['user'=>$obj],200);

        } catch (Exception $ex) {
            return back()->withError($ex->getMessage());
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit=UserM::find($id);
        return response()->json(['edit'=>$edit],200);
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
        return response()->json(['userUpdate'=>$obj],200);

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
        $destroy=UserM::where('user_id',$id)->delete();
        return response()->json(['destroy'=>$destroy],200);
    }
}
