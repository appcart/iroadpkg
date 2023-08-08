@include('admin/header')

    <link rel="stylesheet" href="{{asset('assets/css/lib/datatable/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">                       
                            <div class="page-title">
                                <h1>Monitoring Activities</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <!-- <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Table</a></li>
                                    <li class="active">Data table</li>
                                </ol> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-success btn-sm reset-btn" data-toggle="modal" data-target="#scrollmodal"> Add Monitoring Activity </button>                               
                                <button type="button" onclick="history.back()" class="btn btn-success btn-sm pull-right">Back</button>
                                <!-- <strong class="card-title">Data Table</strong> -->
                            </div>
                            <div class="card-body">
                           
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Activity Name</th>
                                            <th>Activity Description</th>
                                            <th>Updated Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($activities as $key=>$activity)
                                        <tr>
                                            <td>{{ $activity['activity_name'] }}</td>
                                            <td>{{ $activity['activity_description'] }}</td>
                                            <td>{{ date('Y-m-d',strtotime($activity['updated_at']))  }}</td>

                                            <td class="text-center">
                                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                    <div class="btn-group mr-1" role="group" aria-label="Basic example">
                                                    <button type="button" data-toggle="modal" data-target="#scrollmodal" onClick="get_data({{ $activity['activity_id'] }})" class="btn btn-sm btn-secondary"><i class="fa fa-pencil " ></i></button>                                                
                                                    </div>
                                                </div>
                                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                    <div class="btn-group mr-1" role="group" aria-label="Basic example">                                              
                                                    <button type="button" onclick="delete_activity({{ $activity['activity_id'] }})" class="btn btn-sm btn-secondary"><i class="fa fa-trash" ></i></button>                                                
                                                    </div>
                                                </div>   
                                            </td>

                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


        

        <div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <!-- <div class="modal-header"> -->
                        <div class="modal-header" style="display:flex">
                            <h5 class="modal-title" id="scrollmodalLabel">Monitoring Activities</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <form id="add_activity">
                            
                            @csrf
                            <input type="hidden" value="" id="activity_id" name="activity_id">

                        <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12"> 

                                <div class="row activity_row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="monitoring_activity" class=" form-control-label">New Activity 1</label>
                                            <input type="text" name="activity_name[]" id="activity_name" placeholder="Activity" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-5">                                        
                                        <div class="form-group">
                                            <label for="textarea-input" class=" form-control-label"></label>
                                            <textarea name="activity_description[]" id="activity_description" id="textarea-input" rows="2" placeholder="Activity Description" class="form-control"></textarea>
                                        </div>                                       
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1">
                                        <a href="javascript:void(0)" class="closeBtn addmore"><i class="fa fa-plus-square" style="color: #44b749;"></i></a>
                                    </div>
                                </div>      
                                
                                <div class="w-100 text-center"><span class="activity-err"></span></div> 

                            </div>
                        </div>                            
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary"><span id="btn_title">Submit</span></button>
                        </div>
                        
                    </form>

                    </div>
                </div>
            </div>




        <div class="clearfix"></div>

        @include('admin/footer')

    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/jszip.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/buttons.colVis.min.js')}}"></script>
    <!-- <script src="{{asset('assets/js/init/datatables-init.js')}}"></script> -->
    <script src="{{asset('assets/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.validate.js')}}"></script>
    <script src="{{asset('assets/js/common.js')}}"></script>


    <script type="text/javascript">
        
        $(document).ready(function() {

            $('.monitoring-nav').addClass('active');

            $(".reset-btn").click(function(){
                $('.addmore').css('display','block');
                $("#add_activity").trigger("reset");           
                $('#activity_id').val('');
                $('#btn_title').html('Submit');
            });



          $('#bootstrap-data-table').DataTable({
        
            "columns": [
                    { "width": "35%" },
                    { "width": "45%" },
                    { "width": "12%" },
                    { "width": "10%" }
            ]
    });
         
       
          $(document).on('click', '.addmore', function (ev) {
                
                              
                                var activity='';
                                activity+='<div class="row activity_row">';
                                activity+='<div class="col-lg-5">';
                                activity+='<div class="form-group">';
                                activity+='<label for="monitoring_activity" class=" form-control-label">New Activity</label>';
                                activity+='<input type="text" name="activity_name[]" placeholder="Activity" class="form-control">';
                                activity+='</div>';
                                activity+='</div>';
                                activity+='<div class="col-lg-5">';
                                activity+='<div class="form-group">';
                                activity+='<label for="textarea-input" class=" form-control-label"></label>';
                                activity+='<textarea name="activity_description[]" id="textarea-input" rows="2" placeholder="Activity Description" class="form-control"></textarea>';
                                activity+='</div>';                                       
                                activity+='</div>';
                                activity+='<div class="col-lg-1 col-md-1 col-sm-1">';
                                activity+='<a href="javascript:void(0)" class="closeBtn addmore"><i class="fa fa-plus-square" style="color: #44b749;"></i></a>';
                                activity+='</div>';
                                activity+='<div class="col-lg-1 col-md-1 col-sm-1">';
                                activity+='<a href="javascript:void(0)" class="closeBtn removemore"><i class="fa fa-minus-square remove" style="color: #dc3545;"></i></a>';
                                activity+='</div>';
                                activity+='</div>';

                                $( activity ).insertAfter( $(this).parent().parent() );

                                reset_properteis();

        });

        
         function reset_properteis() {
            $(".activity_row").each(function(index,val) {
                var cnt = index + 1;
                console.log(val);
                $(val).find('label:first-child').text("New Activity "+cnt);             
                // $(this).find('label:first-child').text("New Activity "+cnt);  //or we can using a "this" keyword
            });
        }

        $(document).on('click', '.removemore', function () {
            $(this).parent().parent().remove();
            reset_properteis();
        });

      } );

      
$("#add_activity").validate({
    rules: {
        "activity_name[]": {
          required: true
        },
        "activity_description[]": {
          required: true
        }  
        
      },
      messages: {
        "activity_name[]": {
          required: "Please Enter Each Activity Name"         
        },
        "activity_description[]": {
          required: "Please Enter Each Activity Description"
        }     
       
      },    
      submitHandler: function (form, message) {
              
          redUrl = base_url+'/add-activity'; 

          $.ajax({
              url: redUrl,
              type: 'post',
              data: new FormData(form),
              dataType: 'json',
              contentType: false, // The content type used when sending data to the server.
              cache: false, // To unable request pages to be cached
              processData: false, // To send DOMDocument or non processed data file it is set to false
              success: function (res) {

                  if (res.status) {

                      $(".activity-err").css("color", "#28a745");
                      $(".activity-err").html(res.msg);
                      setTimeout(function () {
                         location.reload();
                      }, 500);

                  } else {
                      // fp1.close();
                      $(".activity-err").css("color", "red");
                      $(".activity-err").html(res.msg);
                     
                      setTimeout(function () {
                          // location.reload(); 
                      }, 3000);
                  }

              },
              error: function (xhr, textStatus, errorThrown) {
                
              }
          });

      }
  }); 

  var activities=JSON.parse('<?php echo json_encode($activities) ?>'); 

function get_data(activity_id)
{           
    var result = activities.find(item => item.activity_id === activity_id); 

    $(".activity_row").each(function(index,val) {
        if(index!=0)
        {
            $(this).remove();
        }
    });

    $('.addmore').css('display','none');
    $("#activity_name").val(result.activity_name);
    $("#activity_description").val(result.activity_description);
    $("#activity_id").val(activity_id);
    $('#btn_title').html('Update');
}

  
function delete_activity(activity_id)
{
    if(confirm("Do you want to delete activity ?"))    
    {
        redUrl = "{{url('/admin/add-activity')}}";  
        $.ajax({
              url: redUrl,
              type: 'post',
              data: { _token: "{{ csrf_token() }}",delete:'1',activity_id:activity_id},
              dataType: 'json',
              success: function (res) {

                  if (res.status) {

                      $(".activity-err").css("color", "#28a745");
                      $(".activity-err").html(res.msg);
                      setTimeout(function () {
                         location.reload();
                      }, 500);


                  } else {
                      // fp1.close();
                      $(".activity-err").css("color", "red");
                      $(".activity-err").html(res.msg);
                     
                      setTimeout(function () {
                          // location.reload(); 
                      }, 3000);
                  }
                 


              },
              error: function (xhr, textStatus, errorThrown) {
                
              }
          });
    }
}

  </script>


</body>
</html>

