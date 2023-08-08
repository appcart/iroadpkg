@include('admin/header')



    <link rel="stylesheet" href="{{asset('assets/css/lib/datatable/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}" />

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">                       
                            <div class="page-title">
                                <h1>Machines</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Machines</a></li>
                                    <li class="active">Machine List</li>
                                </ol>
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
                                <button type="button" class="btn btn-success btn-sm"  onClick="add_data()" data-toggle="modal" data-target="#scrollmodal"> Add Machine </button>
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#import_modal"> Import Machine </button>
                                <button type="button" onclick="history.back()" class="btn btn-success btn-sm pull-right">Back</button>
                                <!-- <strong class="card-title">Data Table</strong> -->
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Machine Name</th>
                                            <th>Machine Type</th>
                                            <th>Machine Number</th>
                                            <th>Machine UID</th>
                                            <th>Machine Cost</th>
                                            <th>Hours</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($machines as $key=>$machine)
                                        <tr>
                                            <td>{{ $machine['machine_name'] }}</td>
                                            <td>{{ $machine['machine_type'] }}</td>
                                            <td>{{ $machine['machine_number'] }}</td>
                                            <td>{{ $machine['machine_uid'] }}</td>
                                            <td>{{ $machine['machine_cost'] }}</td>
                                            <td>{{ $machine['machine_hrs'] }}</td>
                                            <td class="text-center"><i class="fa fa-circle fa-1" style="font-size :20px; color:{{ $machine['deleted_at']==NULL ? '#44b749' : '#dc3545'}}" aria-hidden="true"></i></td>
                                            
                                            <td class="text-center">

                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-1" role="group" aria-label="Basic example">
                                                <button type="button" data-toggle="modal" data-target="#scrollmodal" onClick="get_data({{ $machine['machine_id'] }})" class="btn btn-sm btn-secondary"><i class="fa fa-pencil " ></i></button>                                                
                                                </div>
                                            </div>
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-1" role="group" aria-label="Basic example">                                              
                                                <button type="button" onClick="delete_machine({{ $machine['machine_id'] }})" class="btn btn-sm btn-secondary"><i class="fa fa-trash" ></i></button>                                                
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



        <div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel"  aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <!-- <div class="modal-header"> -->
                        <div class="modal-header" style="display:flex">
                            <h5 class="modal-title" id="scrollmodalLabel">Machine Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <form id="add_machines">
                        @csrf

                        <input type="hidden" value="" id="machine_id" name="machine_id">
                        <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12"> 

                                <div class="row">                                    
                                    <div class="col-lg-6">                                        
                                        <div class="form-group">
                                            <label for="machine_type" class="form-control-label">MACHINE TYPE</label>
                                            <select class="form-control select2" id="machine_type" name="machine_type" multiple="multiple" style="width: 100%;"></select>
                                            <!-- <input type="text" id="machine_type" name="machine_type" placeholder="Ex.JCB,Roller.etc" class="form-control"> -->
                                        </div>                                       
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="machine_name" class="form-control-label">MACHINE NAME</label>
                                            <input type="text" id="machine_name" name="machine_name" placeholder="Ex.Mixer,Roller.etc" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="machine_no" class=" form-control-label">MACHINE NUMBER</label>
                                            <input type="text" id="machine_no" name="machine_no" placeholder="Ex.1254.etc" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">                                       
                                        <div class="form-group">
                                            <label for="machine_uid" class=" form-control-label">MACHINE UID</label>
                                            <input type="text" id="machine_uid" name="machine_uid" placeholder="Ex.5246XX1.etc" class="form-control">
                                        </div>                                       
                                    </div>
                                </div> 

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="machine_hr" class=" form-control-label">MACHINE HOUR</label>
                                            <input type="number" id="machine_hr" name="machine_hr" placeholder="Ex.10,12.etc" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">                                       
                                        <div class="form-group">
                                            <label for="machine_cost" class="form-control-label">MACHINE COST</label>
                                            <input type="number" id="machine_cost" name="machine_cost" placeholder="Ex.100,1000. etc" class="form-control">
                                        </div>                                       
                                    </div>
                                </div> 

                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="is_active" class="form-control-label">Is Active ?</label>
                                        <div class="form-group">
                                            
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" id="yes" type="radio" name="is_active" id="inlineRadio1" value="Yes">
                                        <label class="form-check-label"  for="inlineRadio1">Yes</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" id="no" type="radio" name="is_active" id="inlineRadio2" value="No">
                                        <label class="form-check-label" for="inlineRadio2">No</label>
                                        </div>
                                          
                                        </div>
                                    </div>
                                </div> 

                                <div class="w-100 text-center"><span class="machine-err"></span></div>

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



        <div class="modal fade" id="import_modal" tabindex="-1" role="dialog" aria-labelledby="import_modalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <!-- <div class="modal-header"> -->
                        <div class="modal-header" style="display:flex">
                            <h5 class="modal-title" id="import_modalLabel">Machine Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <form id="upload_machines">

                        <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">            
                                
                            <div class="row clearfix">
                                <div class="col-md-4 col-sm-6"></div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                        <!-- <label>Upload File</label>  -->
                                        <input type="file" accept=".xls,.xlsx,.xlsm" id="userfile" name="userfile" data-placeholder="Upload File" class="form-control">
                                    </div>	            		
                                </div> <!-- /.col-md-4 -->		
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-2 col-sm-2"></div>
                                <div class="col-md-8 col-sm-8">
                                    <p style="font-size:13px; color: #000;">	
                                        Note*- To upload file please ensure that your columns names are spelt the same as the headers given below. You must have all these headers in your import file to successfully import machines. If you do not have information to populate specific columns, you may leave them blank but do not remove whole column.</p>
                                </div>
                            </div>

                            <p class="text-center">Excel Import Layout <a href="{{asset('assets/files/add_machine_sample_file.xlsx')}}" download="" style="color:black"> <u>Download Template</u></a><br>
                              
                            </p>                               
                             
                            </div>
                        </div>                            
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary upload-btn">Upload</button>
                        </div>

                        </form>
                    </div>
                </div>
            </div>

            

        <div class="clearfix"></div>

        @include('admin/footer')

    </div><!-- /#right-panel -->

    <!-- Right Panel -->



    <script src="{{asset('assets/js/lib/data-table/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/jszip.min.js')}}"></script>
    <!-- <script src="{{asset('assets/js/sweetalert2.all.min.js')}}"></script> -->
    <script src="{{asset('assets/js/lib/data-table/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/js/lib/data-table/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/js/init/datatables-init.js')}}"></script>
    <script src="{{asset('assets/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.validate.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('assets/js/common.js')}}"></script>
    

    <script type="text/javascript">
        $(document).ready(function() {
            $('.machine-nav').addClass('active');

            
    $(".upload-btn").click(function(){

            var fd = new FormData();
            var files = $('#userfile')[0].files;

            redUrl = base_url+'/machines-import';

            // Check file selected or not
            if(files.length > 0 ){
            fd.append('file',files[0]);
            fd.append('_token',"{{ csrf_token() }}");

            $.ajax({
                url: redUrl,
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response != 0){
                        $("#img").attr("src",response); 
                        $(".preview img").show(); // Display image element
                    }else{
                        alert('file not uploaded');
                    }
                },
            });

            }else{
            alert("Please select a file.");
            }
            
            });

      } );

      var machines=JSON.parse('<?php echo json_encode($machines) ?>'); 

      $('.select2').select2({
            data: JSON.parse('<?php echo json_encode(array_column($machine_types, 'machine_type')) ?>'),
            tags: true,
            maximumSelectionLength: 1,
            tokenSeparators: [',', ' '],
            placeholder: "Select or type keywords",           
        });

      function add_data()
      {
        $('#add_machines')[0].reset();
        $('#machine_id').val('');
        $('#btn_title').html('Submit');
      }

      function get_data(machine_id)
      {           
          var result = machines.find(item => item.machine_id === machine_id);
          $("#machine_name").val(result.machine_name);
          $("#machine_cost").val(result.machine_cost);
          $('#machine_type').val(result.machine_type).trigger('change');
          $("#machine_no").val(result.machine_number);
          $("#machine_uid").val(result.machine_uid);
          $("#machine_hr").val(result.machine_hrs);
          $("#machine_id").val(machine_id);
          $('#btn_title').html('Update');

          $(result.is_active==1 ? '#yes' : '#no').prop("checked", true);
      }


      $("#add_machines").validate({
                rules: {
                    machine_name: {
                        required: true
                    },
                    machine_type: {
                        required: true
                    },
                    machine_no: {
                        required: true
                    },
                    machine_uid: {
                        required: true
                    },
                    machine_hr: {
                        required: true
                    },
                    machine_cost: {
                        required: true,
                        // number: true,
                        // minStrict: 0
                    },
            },
            messages: {
                    machine_name: {
                        required: "Please Enter Machine Name"
                    },
                    machine_type: {
                        required: "Please Enter Machine Type"
                    },
                    machine_no: {
                        required: "Please Enter Machine Number"
                    },
                    machine_uid: {
                        required: "Please Enter Machine UID"
                    },
                    machine_hr: {
                        required: "Please Select Machine Hrs"
                    },
                    machine_cost: {
                        required: "Please Select Machine Cost",
                        // minStrict: "Machine Cost must not be 0"
                    },
            },        
            submitHandler: async function (form, message) {
             
                    redUrl =  base_url+'/add-machines'; 

                   

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

                            $(".machine-err").css("color", "#28a745");
                            $(".machine-err").html(res.msg);
                            setTimeout(function () {
                               location.reload();
                            }, 500);


                        } else {
                            // fp1.close();
                            $(".machine-err").css("color", "red");
                            $(".machine-err").html(res.msg);
                           
                            setTimeout(function () {
                                // location.reload(); 
                            }, 3000);
                        }

                       


                    },
                    error: function (xhr, textStatus, errorThrown) {
                        // console.log(xhr.responseJSON);
                        // if(xhr.status==419)
                        // {
                        //     $(".machine-err").css("color", "red");
                        //     $(".machine-err").html("Server error ! refresh page.");
                        // }   
                        // $(".btn-register").prop('disabled',false);
                        // $(".spinner-border").prop('hidden',true);

                        // setTimeout(function () {
                        //         location.reload(); 
                        //     }, 2000);
                    }
                });
        

            }
        }); 

        
        // My function
        const myfunction = async function(x, y) {
        // return 0
        Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {  
                    console.log(result) ;
                    if (result.isConfirmed) {
                        return true;
                        // Swal.fire(
                        // 'Deleted!',
                        // 'Your file has been deleted.',
                        // 'success'
                        // )
                    } else {
                        return false;
                    }
                })
        }

        

function delete_machine(machine_id)
{
    if(confirm("Do you want to delete machine ?"))    
    {
        redUrl = redUrl =  base_url+'/add-machines'; 
        $.ajax({
              url: redUrl,
              type: 'post',
              data: { _token: "{{ csrf_token() }}", delete:1, machine_id:machine_id},
              dataType: 'json',
              success: function (res) {

                  if (res.status) {

                      $(".machine-err").css("color", "#28a745");
                      $(".machine-err").html(res.msg);
                      setTimeout(function () {
                         location.reload();
                      }, 500);


                  } else {
                      // fp1.close();
                      $(".machine-err").css("color", "red");
                      $(".machine-err").html(res.msg);
                     
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

