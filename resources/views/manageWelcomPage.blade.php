@extends('layouts.admin_layout')

@section('title')
   Feedback Type

@endsection

     @section('content')
         <style>
             .bmd-form-group label{
                 color:black;
             }
             .pt-3-half { padding-top: 1.4rem; }
         </style>



         <div class="container">
             @if (Session::has('error'))
                 <div class="alert alert-danger text-center">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                     <p>{{ Session::get('error') }}</p>
                 </div>
             @endif
                 @if (Session::has('success'))
                     <div class="alert alert-success text-center">
                         <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                         <p>{{ Session::get('success') }}</p>
                     </div>
                 @endif


                 <div class="row">
                     <div class="col-md-12" style="text-align: left !important;">
                         <button   data-toggle="modal" data-target="#exampleModal"  class="btn btn-md btn-primary"
                                   id="addBtn" type="button">
                             Add User
                         </button>
                     </div>
                 </div>

             <div class="row">

                 <div class="col-md-12">

                     <div class="card">

                         <div class="card-body">
                             <div class="table-responsive">
                                 <table class="table">
                                     <thead class=" text-primary">
                                     <tr><th>
                                             Feedback
                                         </th>

                                         <th>
                                             Password
                                         </th>

                                         <th>
                                             Action
                                         </th>
                                     </tr></thead>
                                     <tbody id="tbody">
                                     @foreach($feedbacks as $f)
                                     <tr>
                                         <td contenteditable='true' onblur="updateFeedback(this,{{$f->id}})">
                                          {{$f->feedback}}

                                         </td>
                                         <td contenteditable='true' onblur="updateFeedback(this,{{$f->id}})">
                                             {{$f->password}}

                                         </td>

{{--                                         <td>--}}
{{--                                             {{$f->feedback}}--}}

{{--                                         </td>--}}
{{--                                         <td>--}}
{{--                                             {{$f->password}}--}}

{{--                                         </td>--}}

                                         <td>
{{--                                             <button class="btn btn-info" type="button" onclick="updateKey({{$f->id}})">Update</button>--}}
                                             <button class="btn btn-danger" type="button" onclick="removeRow(this,{{$f->id}})">Remove</button>
                                         </td>

                                     </tr>
                                         @endforeach

                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>

                 </div>


             </div> <!-- row.// -->

         </div>
         <!--container end.//-->

         <br><br>


         <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Add User Type</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <form>
                     <div class="modal-body">
                         <span id="form_result"></span>
                             <div class="form-group">
                                 <input type="text" class="form-control mt-3" placeholder="User Type" id="feedback">
                             </div>
                             <div class="form-group">
                                 <input type="text" class="form-control mt-3" placeholder="Password (Optional)" id="password">
                             </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <button type="button" onclick="addFeedback(this)" class="btn btn-primary">Add</button>
                     </div>
                     </form>

                 </div>
             </div>
         </div>

         <div class="modal key_change" tabindex="-1" role="dialog">
             <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title">Update Password (Key)</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                     <div class="modal-body">
                         <input type="text" class="form-control" id="fillableKey">
                         <input type="hidden" class="form-control" id="feedbackId">
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-primary" onclick="updatePsswordKey()">Save changes</button>
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     </div>
                 </div>
             </div>
         </div>


         <script>

             function addFeedback(obj) {
                 $(obj).prop('disabled', true);
                 $('#form_result').html(null);
                 $('#form_result').html('<p>Processing...</p>');
                 var feedback = $('#feedback').val();
                 var password = $('#password').val();


                 $.ajax({
                     url: '/addFeedbackType',
                     type: 'POST',
                     data: {feedback:feedback,password:password},

                     statusCode: {
                         500: function() {
                             alert("Something went wrong !");
                         }
                     },
                     success: function(response) {
                         $(obj).prop('disabled', false);
                         $(obj).closest('form').trigger("reset");

                         // $('#exampleModal').modal('hide');

                         if(response.success==1 && response.action=='add'){

                             $('#exampleModal').modal('hide');

                             $('#tbody').prepend(' <tr><td contenteditable="true" onblur="updateFeedback(this,'+response.feedback.id+')" spellcheck="false">\n' +

                                 '\n' +response.feedback.feedback+
                                    '                                    </td>\n' +
                                 '                                         <td contenteditable="true" onblur="updateFeedback(this,'+response.feedback.id+')">\n' +
                                 '                                             '+response.feedback.password+'\n' +
                                 '\n' +
                                 '                                         </td>\n' +
                                 '\n' +
                                 '                                         <td>\n' +
                                 '                                             <button class="btn btn-danger" type="button" onclick="removeRow(this,'+feedback.id+')">Remove</button>\n' +
                                 '                                         </td><tr>');

                             $.notify({
                                 icon: "add_alert",
                                 message: 'Feedback added successfully !'

                             },{
                                 type: 'success',
                                 timer: 1000,
                                 placement: {
                                     from: 'top',
                                     align: 'right'
                                 }
                             });
                         }else if(response.success==1 && response.action=='update'){
                             $('#exampleModal').modal('hide');
                             $.notify({
                                 icon: "add_alert",
                                 message: 'Feedback updated successfully !'

                             },{
                                 type: 'success',
                                 timer: 1000,
                                 placement: {
                                     from: 'top',
                                     align: 'right'
                                 }
                             });
                         } else if(response.success==166 && response.action=='alreadyExist'){

                             html = '<div class="alert alert-danger">This user type is already exists</div>';


                         $('#form_result').html(html);

                         }



                         else{

                             $.notify({
                                 icon: "add_alert",
                                 message: 'Feedback is required !'

                             },{
                                 type: 'danger',
                                 timer: 1000,
                                 placement: {
                                     from: 'top',
                                     align: 'right'
                                 }
                             });

                         }


                     }

                 });






             }
         </script>

         <script>

             function removeRow(obj,id) {

                 if(id!=0){  Swal.fire({
                     title: 'Are you sure?',
                     text: "You won't be able to revert this!",
                     icon: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: '#3085d6',
                     cancelButtonColor: '#d33',
                     confirmButtonText: 'Yes, delete it!'
                 }).then((result) => {
                     if (result.isConfirmed) {
                         $.ajax({
                             url: '/deleteFeedbacktype',
                             type: 'POST',
                             data: { id:id },
                             success: function(response){

                                 $(obj).closest('tr').remove();

                                 $.notify({
                                     icon: "add_alert",
                                     message: 'Record removed successfully  !'

                                 },{
                                     type: 'success',
                                     timer: 1000,
                                     placement: {
                                         from: 'top',
                                         align: 'right'
                                     }
                                 });


                             }
                         });

                     }
                 })}else{
                     $(obj).closest('tr').remove();

                 }




             }

             function updateKey(id) {

                 $.ajax({
                     url: "http://managersqr.managershq.com.au/get/usertype/"+id,
                     success: function(result){
                         $("#feedbackId").val(result.feedbacks.id);
                         $("#fillableKey").val(result.feedbacks.password);
                     }});


             $('.key_change').modal('show');
             }

             function updatePsswordKey() {

                 var password = $('#fillableKey').val();
                 var feedbackId = $('#feedbackId').val();

                 $.ajax({
                     url: "http://managersqr.managershq.com.au/update/key/"+feedbackId+'/'+password,
                     success: function(result){
                         window.location.reload();
                     }});

             }


             $(document).on("click","#addBtn",function() {
                 $('#form_result').html(null);
             });

         </script>
    @endsection


