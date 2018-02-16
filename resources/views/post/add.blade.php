@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
      <!--     @if(session()->has('success')) -->
            <!--   <div class="alert alert-success alert-dismissable" id="success_msg">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    
               </div>
 -->        <!--   @endif -->
         <div class="alert alert-success" id="success_msg"></div>
            <div class="panel panel-default">
                <div class="panel-heading">Create Post</div>

                <div class="panel-body">
                 <div class="col-md-offset-3">
                    <div >
                       <form class="form-horizontal form_data" id="show_form" data-parsley-validate>
                        {{csrf_field()}}
                        <div class="row">
                           <div class="col-md-6"> 
                               <div class="form-group" style="margin-left: 10px;">  
                                  <input type="text" name="title" placeholder="Title" class="form-control title" required>
                                  <p id="title" style="color: red;"></p>
                               </div>
                           </div>
                         </div>
                         <div class="row">
                           <div class="col-md-6">
                              <div class="form-group" style="margin-left: 10px;">
                                  <textarea class="form-control body" name="body" placeholder="body" required></textarea>
                                  <p id="body" style="color: red;"></p>
                              </div>
                           </div>
                        </div>
                         <div class="form-group" style="margin-left: 10px;">
                            <button class="btn btn-primary create_post" type="submit">Create</button>
                         </div>
                       </form>
                    </div>
                   <div>
                      <div > 
                        <div class="create_new"><a href="{{url('posts/create')}}">Create Post</a></div>
                         <h3 class="thank">{{ config('post.success.message') }}</h3>
                      </div>
                   </div>
                 </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript" src="{{asset('js/app.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function(){
    //hide all div before operation
      $('#success_msg').hide();
      $('#title').hide();
      $('#body').hide();
      $('.create_new').hide();
      $('.thank').hide();
     $('.create_post').on('click',function(e){
      e.preventDefault();

      //get value of title and body
      var title = $('.title').val();
      var body = $('.body').val();
      //alert(body);

      //if title and body are empty
      if(title=='' && body == '')
      {
        $('#title').show();
        $('#title').html('title is required');
        $('#body').show();
        $('#body').html('body is required');
      }

      //if title is empty
      else if(title == '')
      {
        $('#title').show();
        $('#title').html('title is required');
      }
       //if body is empty
      else if(body == '')
      {
        $('#body').show();
        $('#body').html('body is required');
      }

      //send request if title and body is not empty
       if(title !='' && body !='')
       {
             var data = $('.form_data').serialize();
             var url = '{{url("posts")}}';

             $.ajax({
             type : 'POST',
             url : url,
             headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
             data : data,
      
               //display success message after success response
               success:function(response){
                  console.log(response.status);
                    if(response.status)
                    { 
                        $('.form_data').remove();
                       $('.thank').show('slow');
                       $('.thank').fadeOut(5000);
                        $('.create_new').show('slow');
                      /* $('#success_msg').show();
                       $('#success_msg').html(response.message);
                        $('#success_msg').fadeOut(4000);*/
                    }
                 }//end success function
           });//end ajax function
       }//end if
     
     });//end click event function
  });
</script>
