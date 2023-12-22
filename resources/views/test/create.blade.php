
@extends('layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">                       
                        <h4>  </h4>
                    </div>
                    <div class="col-sm-6">
                          </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
            <div class="row mt-4">
                                <div class="col">
                                    <span id="editmsg"></span>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped data-table dt-select cms_table_width" id="user_table">
                                       
                                        @if(count($data))    
                                
                                        <thead>
                                            <tr>
                                                <!-- <th style="text-align:center;"><input type="checkbox" id="select-all"/></th> -->
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Image</th>
                                                <th>Address</th>                                               
                                                <th>Gender</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            @endif
                                            <tbody>
                                            @php
                                              $i=1;
                                             $j=0;
                                              @endphp
                                              @foreach($data as $list)  
                                             
                                              <tr id="row<?php echo $j;?>">
                                                <td>@php echo $i++;  @endphp</td>
                                                <td id="namelist<?php echo $j;?>">{{$list['name']}}</td>
                                                    <td id="imagelist<?php echo $j;?>"> <a href="{{ asset('file/' . $list['image']) }}" target="_blank"><img src="{{ asset('file/' . $list['image']) }}" width="50" height="50"></a></td>
                                              
                                                <td id="addresslist<?php echo $j;?>">{{$list['address']}}</td>
                                                <td id="genderlist<?php echo $j;?>">{{$list['gender']}}</td>
                                                <td><a href="#" class="btn btn-primary" onClick="showEdit(<?php echo $i-2;?>)">Edit</a>
                                                <a href="#" class="btn btn-primary" onClick="showView(<?php echo $i-2;?>)">View</a>
                                                <a href="#" class="btn btn-primary" onClick="deletelist(<?php echo $i-2;?>)">Delete</a>
                              
                                            </td>
                                               </tr>
                                               @php
                                               $j++;
                                               @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                </div>

                <div class="row" id="editform" style="display:none">
                    <div class="col-md-12">
                        <div class="card card-gray-dark card-outline">
                            <div class="card-header">
                                <h3 class="card-title  mb-0"><i class="fas fa-align-justify"></i> Edit</h3>
                            </div>
                            <form role="form"  enctype="multipart/form-data" id="editsubmit">
                            {{csrf_field()}}
                                <div class="card-body">
                                    <input type="hidden" id="editid" name="editid" value="">
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">Name<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                           <input class="form-control {{ $errors->has("name") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="name" id="editname" placeholder="Please enter Name"
                                                    value="" required>
                                                                                     
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">Image<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                           <input class="form-control {{ $errors->has("image") ? 'is-invalid' : '' }}"
                                                    type="file"
                                                    name="image" id="editimage" placeholder="Please enter Image"
                                                    value="{{old('image')}}" required>
                                                    
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">Address<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                           <textarea class="form-control {{ $errors->has("address") ? 'is-invalid' : '' }}"                                                    
                                                    name="address" id="editaddress" placeholder="Please enter Address"
                                                     required></textarea>
                                                  
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">Gender<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                                <select class="form-control" name="gender" id="editgender" required>
                                                    <option value="">--Select--</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>                                                            
                                                </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <div class="col text-right">
                                        
                                        <button  class="btn btn-primary" id="editbutton"> Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row" id="view" style="display:none">
                    <div class="col-md-12">
                        <div class="card card-gray-dark card-outline">
                            <div class="card-header">
                                <h3 class="card-title  mb-0"><i class="fas fa-align-justify"></i> View</h3>
                            </div>
                                 <div class="card-body">
                                      <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">Name</label>
                                        <div class="col-md-10">
                                          <span id="nameview"></span>
                                                                                     
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">Image</label>
                                        <div class="col-md-10">
                                        <span id="imageview"></span>              
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">Address</label>
                                        <div class="col-md-10">
                                        <span id="addressview"></span>          
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">Gender</label>
                                        <div class="col-md-10">
                                        <span id="genderview"></span>                                       
                                     </div>
                                    </div>

                                </div>
                              
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-gray-dark card-outline">
                            <div class="card-header">
                                <h3 class="card-title  mb-0"><i class="fas fa-align-justify"></i> Create</h3>
                            </div>
                            <form role="form" action="{{action('TestController@store')}}" method="POST"
                                    enctype="multipart/form-data" id="userForm">
                                {{csrf_field()}}
                                <div class="card-body">

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">Name<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                           <input class="form-control {{ $errors->has("name") ? 'is-invalid' : '' }}"
                                                    type="text"
                                                    name="name" id="name" placeholder="Please enter Name"
                                                    value="{{old('name')}}" required>
                                                    <span class="form-text text-danger"
                                                    id="error_name">{{ $errors->getBag('default')->first('name') }}</span>
                                 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">Image<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                           <input class="form-control {{ $errors->has("image") ? 'is-invalid' : '' }}"
                                                    type="file"
                                                    name="image" id="image" placeholder="Please enter Image"
                                                    value="{{old('image')}}" required>
                                                    <span class="form-text text-danger"
                                                    id="error_priority">{{ $errors->getBag('default')->first('image') }}</span>
                                 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">Address<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                           <textarea class="form-control {{ $errors->has("address") ? 'is-invalid' : '' }}"
                                                    type="textarea"
                                                    name="address" id="address" placeholder="Please enter Address"
                                                     required></textarea>
                                                    <span class="form-text text-danger"
                                                    id="error_priority">{{ $errors->getBag('default')->first('address') }}</span>
                                 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="">Gender<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                                <select class="form-control" name="gender" required>
                                                    <option value="">--Select--</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>                                                            
                                                </select>
                                                <span class="form-text text-danger"
                                                    id="error_project_id">{{ $errors->getBag('default')->first('gender') }}</span>
                                 
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <div class="col text-right">
                                        <a class="btn btn-danger" href=""> Cancel </a>
                                        <button type="submit" class="btn btn-primary"> Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJsInclude')
    <script>
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function showEdit(i){
              
                var url = '{{route('test.fetchdata')}}';
                data = {
                    id: i
                };
                $.ajax({
                    url,
                    data,
                    success: function (data){  
                       $("#editform").css("display","block");
                       $("#editid").val(i);
                       $("#editname").val(data.name); 
                       $("#editaddress").val(data.address);
                       var gender=(data.gender=='Male')?1:2 ;
                       $('#editgender option[value='+gender+']').attr("selected", "selected");
                       
                       // console.log(data.name);
                    }
                });
        }
        function showView(i){
            var url = '{{route('test.fetchdata')}}';
                data = {
                    id: i
                };
                $.ajax({
                    url,
                    data,
                    success: function (data){  
                       $("#view").css("display","block");                      
                       $("#nameview").html(data.name); 
                       $("#addressview").html(data.address);
                       $("#genderview").html((data.gender==1)?'Male':'Female');
                       $("#imageview").html('<img src="{{ asset('file/') }}/'+data.image+'" width="50" height="50">');
                      
                       // console.log(data.name);
                    }
                });
        }

        function deletelist(i){
           // var url ='destroy/' + i;
            var url='{{url('/deleteprocess')}}';;
            console.log(url);
                data = {
                      id: i
                };
                $.ajax({
                    type: 'DELETE',
                    url,
                    data,
                    success: function (data){  
                        $("#editmsg").html("<center><b>Deleted Successfully</b></center>"); 
                        $('#row'+i).remove();                
                       // console.log(data.name);
                    }
                });
        }    
         $(document).ready(function () {

        table = $('#user_table').DataTable();       
         });
         $(function () {            
             $('#userForm').validate({
                 rules: {
                   name:
                   {
                    required:true
                   },
                   image:
                   {
                    required:true, 
                    accept:"jpg,jpeg,png"                 
                   } ,
                   address:
                   {
                    required:true
                   } ,
                   gender:
                   {
                    required:true
                   }
                 },  
                 messages: {                    
                    image: {
                        accept: "Only this types jpg,jpeg are allowed" 
                     }
                 },               
                 errorElement: "span",
                 errorClass: "form-text text-danger is-invalid"
             });


             $('#editsubmit').validate({
                 rules: {
                   name:
                   {
                    required:true
                   },
                   image:
                   {
                    required:true, 
                    accept:"jpg,jpeg,png"                 
                   } ,
                   address:
                   {
                    required:true
                   } ,
                   gender:
                   {
                    required:true
                   }
                 },  
                 messages: {                    
                    image: {
                        accept: "Only this types jpg,jpeg are allowed" 
                     }
                 },               
                 errorElement: "span",
                 errorClass: "form-text text-danger is-invalid"
             });

             $('#userForm').submit(function(){
                 $('button[type=submit]').attr("disabled", true);
                 setTimeout(function()
                 {
                     $('button[type=submit]').attr("disabled", false);
                 }, 3000);
             });
             
             $('#editsubmit').on('submit', function(e){
                //alert("Hello");
                e.preventDefault(); 
                var url = '{{route('test.updatedata')}}';
               
              //  var formData = $(this).serialize(); 
                //var data= new FormData(document.getElementById('editsubmit'));
                // var data=new FormData();
                // data.append( 'name', 'test' );

                // console.log(data);
               if($("#editsubmit").valid()){
                $.ajax({
                type: 'POST',
                url: url,
                data: new FormData(this),
                contentType: false,
            cache: false,
            processData:false,
              
                success: function(data){
                   // alert(data);
                   console.log(data.name);
                   $("#editmsg").html("<center><b>Edited Successfully</b></center>");
                    $("#namelist"+$("#editid").val()).html(data.name);
                    $("#imagelist"+$("#editid").val()).html(' <a href="{{ asset('file/')}}/'+ data.image+'" target="_blank"><img src="{{ asset('file/') }}/'+data.image+'" width="50" height="50"></a>');
                    $("#addresslist"+$("#editid").val()).html(data.address);
                    $("#genderlist"+$("#editid").val()).html((data.gender==1)?'Male':'Female');
              
                }
                });
                }
                // $.ajax({
                //    url,
                //     data,
                   
                //     success: function (data){  
                //        $("#editform").css("display","block");
                //        $("#editname").val(data.name); 
                //        $("#editaddress").val(data.address);
                //        var gender=(data.gender=='Male')?1:2 ;
                //        $('#editgender option[value='+gender+']').attr("selected", "selected");
                       
                //         console.log(data.name);
                //     }
                // });
                //e.preventDefault(); 
             });
         });
    </script>
@endsection
