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
                                <h1>Material</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Material</a></li>
                                    <li class="active">Material List</li>
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
                                <button type="button" onclick="add_data()" class="btn btn-success btn-sm" data-toggle="modal" data-target="#scrollmodal"> Add Material </button>
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#import_modal"> Import Material </button>
                                <button type="button" onclick="history.back()" class="btn btn-success btn-sm pull-right">Back</button>
                                <!-- <strong class="card-title">Data Table</strong> -->
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Material Name</th>
                                            <th>Material Type</th>
                                            <th>Material Unit</th>
                                            <th>Material Cost</th>
                                            <th>Updated Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($materials as $key=>$material)
                                        <tr>
                                            <td>{{ $material['material_name'] }}</td>
                                            <td>{{ $material['material_type'] }}</td>
                                            <td>{{ $material['material_unit'] }}</td>
                                            <td>{{ $material['material_cost'] }}</td>                                          
                                            <td>{{ date('Y-m-d',strtotime($material['updated_at'])) }}</td>                                          
                                            <td class="text-center"><i class="fa fa-circle fa-1" style="font-size :20px; color:{{ $material['deleted_at']==NULL ? '#44b749' : '#dc3545'}}" aria-hidden="true"></i></td>
                                            
                                            <td class="text-center">

                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-1" role="group" aria-label="Basic example">
                                                <button type="button" data-toggle="modal" data-target="#scrollmodal" onClick="get_data({{ $material['material_id'] }})" class="btn btn-sm btn-secondary"><i class="fa fa-pencil " ></i></button>                                                
                                                </div>
                                            </div>
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-1" role="group" aria-label="Basic example">                                              
                                                <button type="button" onclick="delete_material({{ $material['material_id'] }})" class="btn btn-sm btn-secondary"><i class="fa fa-trash" ></i></button>                                                
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
                            <h5 class="modal-title" id="scrollmodalLabel">Material Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <form id="add_materials">
                            
                        @csrf
                        <input type="hidden" value="" id="material_id" name="material_id">

                        <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12"> 

                                <div class="row">                                   
                                    <div class="col-lg-6">                                        
                                        <div class="form-group">
                                            <label for="material_type" class=" form-control-label">MATERIAL TYPE</label>
                                            <select class="form-control select2" id="material_type" name="material_type" multiple="multiple" style="width: 100%;"></select>                                           
                                        </div>                                       
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="material_name" class=" form-control-label">MATERIAL NAME</label>
                                            <input type="text" id="material_name" name="material_name" placeholder="Ex.Cement,Steel.etc" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="material_unit" class=" form-control-label">MATERIAL UNIT</label>
                                            <input type="text" id="material_unit" name="material_unit" placeholder="Ex.No,Kg. etc" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">                                       
                                        <div class="form-group">
                                            <label for="material_cost" class="form-control-label">MATERIAL COST</label>
                                            <input type="number" id="material_cost" name="material_cost" placeholder="Ex.100,1000. etc" class="form-control">
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

                                <div class="w-100 text-center"><span class="material-err"></span></div>

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
                            <h5 class="modal-title" id="import_modalLabel">Material Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

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
                                        Note*- To upload file please ensure that your columns names are spelt the same as the headers given below. You must have all these headers in your import file to successfully import Material. If you do not have information to populate specific columns, you may leave them blank but do not remove whole column.</p>
                                </div>
                            </div>

                            
                            <p class="text-center">Excel Import Layout <a href="{{asset('assets/files/add_material_sample_file.xlsx')}}" download="" style="color:black"> <u>Download Template</u></a><br>
                              
                            </p>                               
                             
                            </div>
                        </div>                            
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary upload-btn">Upload</button>
                        </div>
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
    <script src="{{asset('assets/js/init/datatables-init.js')}}"></script>
    <script src="{{asset('assets/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.validate.js')}}"></script>
    <script src="{{asset('assets/js/common.js')}}"></script>

    

    <script type="text/javascript">
        $(document).ready(function() {

          $('.material-nav').addClass('active');

          

        $('.select2').select2({
            data: JSON.parse('<?php echo json_encode(array_column($material_types, 'material_type')) ?>'),
            tags: true,
            maximumSelectionLength: 1,
            tokenSeparators: [',', ' '],
            placeholder: "Select or type keywords",           
        });

        
    $(".upload-btn").click(function(){

            var fd = new FormData();
            var files = $('#userfile')[0].files;

            redUrl = base_url+'/material-import';

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

      var materials=JSON.parse('<?php echo json_encode($materials) ?>'); 

function add_data()
{
  $('#add_materials')[0].reset();
  $('#material_id').val('');
  $('#material_type').val(null).trigger('change');
  $('#btn_title').html('Submit');
}


function get_data(material_id)
{           
    var result = materials.find(item => item.material_id === material_id);
    console.log(result);
    $("#material_name").val(result.material_name);
    $("#material_cost").val(result.material_cost);
    $('#material_type').val(result.material_type).trigger('change');
    $("#material_unit").val(result.material_unit);
    $("#material_id").val(material_id);
    $('#btn_title').html('Update');

    $(result.is_active==1 ? '#yes' : '#no').prop("checked", true);
}


$("#add_materials").validate({
    rules: {
        material_name: {
            required: true
        },
        material_type: {
            required: true
        },
        material_unit: {
            required: true
        },
        material_cost: {
            required: true,
            // number: true,
            //  minStrict: 0
        },
      
    },
    messages: {
        material_name: {
            required: "Please Enter Material Name"
        },
        material_type: {
            required: "Please Select Material Type"
        },
        material_unit: {
            required: "Please Enter Material Unit"
        },
        material_cost: {
            required: "Please Enter Material Cost",
            // minStrict: "Material Cost must not be 0"
        },
       
    },      
      submitHandler: function (form, message) {
       
              redUrl = base_url+'/add-materials';

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

                      $(".material-err").css("color", "#28a745");
                      $(".material-err").html(res.msg);
                      setTimeout(function () {
                         location.reload();
                      }, 500);


                  } else {
                      // fp1.close();
                      $(".material-err").css("color", "red");
                      $(".material-err").html(res.msg);
                     
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


function delete_material(material_id)
{
    if(confirm("Do you want to delete material ?"))    
    {
        redUrl = base_url+'/add-materials';

        $.ajax({
              url: redUrl,
              type: 'post',
              data: { _token: "{{ csrf_token() }}", delete:1, material_id:material_id},
              dataType: 'json',
              success: function (res) {

                  if (res.status) {

                      $(".material-err").css("color", "#28a745");
                      $(".material-err").html(res.msg);
                      setTimeout(function () {
                         location.reload();
                      }, 500);


                  } else {
                      // fp1.close();
                      $(".material-err").css("color", "red");
                      $(".material-err").html(res.msg);
                     
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

