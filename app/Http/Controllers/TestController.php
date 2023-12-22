<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;
class TestController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $file=fopen(public_path().'/user/data.json','r');   
        $result=[]  ;        
        if(!empty(file_get_contents(public_path().'/user/data.json'))){
            $result=json_decode(file_get_contents(public_path().'/user/data.json') ,true)  ;
        }       
        $data=[];
        $keylist=['name','image','address','gender'];
        $k=0;
        foreach($result as $list){
            $i=0;
             if(is_array($list)){
            foreach($list as $key=>$val){
                $data[$i++][$keylist[$k]]=$val;
            }
            }else{
                $data[$i++][$keylist[$k]]=$list;
            }
          
            $k++;
        }
      
        return view('test.create',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'name' => 'required',     
            'image'=>'mimes:jpg,jpeg,png',
            'address'=>'required',
            'gender'=>'required'
        ]);
        $tasklist=[];
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input=$request->all();
        $data=[];
        if ($request->hasFile('image')){           
            $rand_val           = date('YMDHIS') . rand(11111, 99999);
            $file_name    = md5($rand_val);
            $file               = $input['image'];
            $fileName           = $file_name.'.'.$file->getClientOriginalExtension();
            $destinationPath    = public_path().'/file';
            $file->move($destinationPath,$fileName);
            $data['image']    = $fileName ;
          
        }

        if (! File::exists(public_path().'/user/data.json')) 
            {
                File::makeDirectory(public_path().'/user', $mode = 0777, true, true);   
            }
             $file=fopen(public_path().'/user/data.json','r');   
            $result=[]  ;
           
            if(!empty(file_get_contents(public_path().'/user/data.json'))){
                $result=json_decode(file_get_contents(public_path().'/user/data.json') ,true)  ;
            }
             fclose($file);
            $file=fopen(public_path().'/user/data.json','w');   
           
           if(count($result)){
            $result=array_merge_recursive($result,['name'=>$input['name'],'image'=>$data['image'],'address'=>$input['address'],'gender'=>($input['gender']==1)?'Male':'Female']);

           }else{
            $result=['name'=>$input['name'],'image'=>$data['image'],'address'=>$input['address'],'gender'=>($input['gender']==1)?'Male':'Female'];
           }
           $data= json_encode($result);
           fwrite($file, $data);
           fclose($file);
           return redirect()->action('TestController@create');
   
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
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       
        $input=$request->all();
        $file=fopen(public_path().'/user/data.json','r');   
        $result=$data=[]  ;
       
        if(!empty(file_get_contents(public_path().'/user/data.json'))){
            $result=json_decode(file_get_contents(public_path().'/user/data.json') ,true)  ;
        }
        if(is_array($result['name'])){
         unlink(public_path().'/file/'.$result['image'][$input['id']]);
          unset($result['name'][$input['id']]);
          unset($result['image'][$input['id']]);
          unset($result['address'][$input['id']]);
          unset($result['gender'][$input['id']]);
         }else{
            unlink(public_path().'/file/'.$result['image']);
            $result=[];
        
        }
        $file=fopen(public_path().'/user/data.json','w');   
        $data= json_encode($result);
        fwrite($file, $data);
        fclose($file);
        return response()->json(['success'=>'true']); 
    }
    public function fetchData(Request $request){
        
        $input=$request->all();
            $file=fopen(public_path().'/user/data.json','r');   
            $result=$data=[]  ;
           
            if(!empty(file_get_contents(public_path().'/user/data.json'))){
                $result=json_decode(file_get_contents(public_path().'/user/data.json') ,true)  ;
            }
           
            if(is_array($result['name'])){
                $keylist=['name','image','address','gender'];
                $data=['name'=>$result['name'][$input['id']],'image'=>$result['image'][$input['id']],'address'=>$result['address'][$input['id']],'gender'=>$result['gender'][$input['id']]];
            }else{
                $data=['name'=>$result['name'],'image'=>$result['image'],'address'=>$result['address'],'gender'=>$result['gender']];
          
            }
            return response()->json($data); 
    }
    function updateData(Request $request){
    
       $input=$request->all();
       $file=fopen(public_path().'/user/data.json','r');   
       $result=$data=[]  ;
      
       if(!empty(file_get_contents(public_path().'/user/data.json'))){
           $result=json_decode(file_get_contents(public_path().'/user/data.json') ,true)  ;
       }
     
   
    if ($request->hasFile('image')){           
        $rand_val           = date('YMDHIS') . rand(11111, 99999);
        $file_name    = md5($rand_val);
        $file               = $input['image'];
        $fileName           = $file_name.'.'.$file->getClientOriginalExtension();
        $destinationPath    = public_path().'/file';
        $file->move($destinationPath,$fileName);
        $data['image']    = $fileName ;
      
    }
    if(is_array($result['name'])){
        unlink(public_path().'/file/'.$result['image'][$input['editid']]);
        $result['name'][$input['editid']]=$input['name'];
        $result['address'][$input['editid']]=$input['address'];
        $result['gender'][$input['editid']]=($input['gender']==1)?'Male':'Female';
        $result['image'][$input['editid']]=$fileName;
    }else{
        unlink(public_path().'/file/'.$result['image']);
         $data=['name'=>$input['name'],'image'=>$fileName,'address'=>$input['address'],'gender'=>($input['gender']==1)?'Male':'Female'];   
     }
     $file=fopen(public_path().'/user/data.json','w');   
     $data= json_encode($result);
     fwrite($file, $data);
     fclose($file);
     $input['image'] =$fileName;
     return response()->json($input); 
    }
}
