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
                                <h1>Vendors</h1>
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
                                <button type="button" class="btn btn-success btn-sm reset-btn" data-toggle="modal" data-target="#scrollmodal"> Add Vendor </button>                               
                                <button type="button" onclick="history.back()" class="btn btn-success btn-sm pull-right">Back</button>
                                <!-- <strong class="card-title">Data Table</strong> -->
                            </div>
                            <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Vendor Name</th>
                                            <th>Shop Name</th>
                                            <th>Email</th>
                                            <th>Mobile No</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($vendors as $key=>$vendor)
                                        <tr>
                                            <td>{{ $vendor['first_name']." ".$vendor['last_name'] }}</td>
                                            <td>{{ $vendor['shop_name'] }}</td>
                                            <td>{{ $vendor['email_id'] }}</td>
                                            <td>{{ $vendor['mobile'] }}</td>                                          
                                            <td class="text-center"><i class="fa fa-circle fa-1" style="font-size :20px; color:{{ $vendor['deleted_at']==NULL ? '#44b749' : '#dc3545'}}" aria-hidden="true"></i></td>
                                            
                                            <td class="text-center">

                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-1" role="group" aria-label="Basic example">
                                                <button type="button" data-toggle="modal" data-target="#scrollmodal" onClick="get_data({{ $vendor['user_id'] }})" class="btn btn-sm btn-secondary"><i class="fa fa-pencil" ></i></button>                                                
                                                </div>
                                            </div>
                                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="btn-group mr-1" role="group" aria-label="Basic example">                                              
                                                <button type="button" onclick="delete_vendor({{ $vendor['user_id'] }})" class="btn btn-sm btn-secondary"><i class="fa fa-trash" ></i></button>                                                
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
                            <h5 class="modal-title" id="scrollmodalLabel">Vendor Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <form id="add_vendors">
                            
                            @csrf
                            <input type="hidden" value="" id="vendor_id" name="vendor_id">
                            <input type="hidden" value="{{ $vendor_role_id }}" id="vendor_role_id" name="vendor_role_id">

                        <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12"> 

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="vendor_name" class=" form-control-label">VENDOR NAME</label>
                                            <input type="text" name="vendor_name" id="vendor_name" placeholder="Ex.John,Tom.etc" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">                                        
                                        <div class="form-group">
                                            <label for="shop_name" class=" form-control-label">SHOP NAME</label>
                                            <input type="text" name="shop_name" id="shop_name" placeholder="Ex.Shop1,Shop2.etc" class="form-control">
                                        </div>                                       
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="mobile" class=" form-control-label">PHONE NUMBER</label>
                                            <input type="number" name="mobile" id="mobile" placeholder="Ex.9999999999.etc" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">                                       
                                        <div class="form-group">
                                            <label for="email_id" class=" form-control-label">EMAIL ID</label>
                                            <input type="text" name="email_id" id="email_id" placeholder="Ex.abc@gmail.com.etc" class="form-control">
                                        </div>                                       
                                    </div>
                                </div> 

                                <div class="row">
                                        <div class="col-lg-6">                                        
                                            <div class="form-group">
                                                <label for="material_type" class=" form-control-label">MATERIAL TYPE</label>
                                                <select class="form-control select2 material_type" id="material_type" name="material_type" multiple="multiple" style="width: 100%;"></select>                                           
                                            </div>                                       
                                        </div>
                                        <div class="col-lg-6">                                        
                                            <div class="form-group">
                                                <label for="material_name" class=" form-control-label">MATERIAL NAME</label>
                                                <select class="form-control select2 materials" id="material_name" name="material_name[]" multiple="multiple" style="width: 100%;"></select>                                           
                                            </div>                                       
                                        </div>
                                </div> 
                            

                                <div class="w-100 text-center"><span class="vendor-err"></span></div>

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
    <script src="{{asset('assets/js/init/datatables-init.js')}}"></script>
    <script src="{{asset('assets/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.validate.js')}}"></script>
    <script src="{{asset('assets/js/common.js')}}"></script>


    <script type="text/javascript">

        var $material_type = $(".material_type");
        var $materials = $(".materials");
        var material_types=JSON.parse('<?php echo json_encode($material_types) ?>'); 
        var selected_material=[];

        $(document).ready(function() {

         $('.vendor-nav').addClass('active');    
         
         $(".reset-btn").click(function(){
                selected_material=[]
                $materials.empty(); //remove selected elements
                $material_type.val(null).trigger("change"); //remove selected elements
                $("#add_vendors").trigger("reset");

                $('#vendor_id').val('');
                $('#btn_title').html('Submit');
            });
        
          $material_type.select2({
            data: JSON.parse('<?php echo json_encode(array_column($material_types, 'material_type')) ?>'),
            tags: false,
            closeOnSelect: false,
            // maximumSelectionLength: 1,
            tokenSeparators: [',', ' '],
            placeholder: "Select or type keywords",           
            }).on("select2:select", function (e) {     

                material_type_select(e);

            }).on("select2:unselect", function (e) {
                material_type_unselect(e);
            });     
           

            $materials.select2({
                data: [],
                tags: false,
                closeOnSelect: false,
                // maximumSelectionLength: 1,
                tokenSeparators: [',', ' '],
                placeholder: "Select or type keywords",           
            }).on("select2:select", function (e) { 

                selected_material.push(e.params.data.text);  // add selected material into array
                
            }).on("select2:unselect", function (e) {  
             
                selected_material = jQuery.grep(selected_material, function(value) {
                    return value != e.params.data.text;
                });             

            });

     });  //end of ready function

     function material_type_select(e)
            {
                materials = [];
            
                $.each($material_type.val(), function (key1, val1) {

                    material_type = material_types.find(item => item.material_type === val1);                

                    $.each(material_type.materials, function (key, val) {
                        materials.push(new Option(val.material_name, val.material_name, false, false));
                    });

                });              

                $materials.val(null).trigger("change"); //remove selected elements
                $materials.empty();   //remove element  select2  options      
                $materials.append(materials).trigger('change'); //append element as option into select2               
                $materials.val(selected_material).trigger("change");   
            }

     function material_type_unselect(e)
            {
                materials = [];
               

                if($material_type.val()!=null) //add material value in dropdown again
                {
                    $.each($material_type.val(), function (key1, val1) {

                    material_type = material_types.find(item => item.material_type === val1);

                    $.each(material_type.materials, function (key, val) {
                        materials.push(new Option(val.material_name, val.material_name, false, false));
                        
                    });

                    }); 
                } 

                removed_material = material_types.find(item => item.material_type === e.params.data.text); //remove all selected material of material type 

                $.each(removed_material.materials, function (key, val) {
                    
                    selected_material = jQuery.grep(selected_material, function(value) {
                                return value != val.material_name;
                            });
                    
                });
            
                $materials.val(null).trigger("change"); //remove selected elements
                $materials.empty();   //remove element  select2  options      
                $materials.append(materials).trigger('change'); //append element as option into select2
                $materials.val(selected_material).trigger("change");     
            }

      var vendors=JSON.parse('<?php echo json_encode($vendors) ?>'); 



function get_data(vendor_id)
{           
    var result = vendors.find(item => item.user_id === vendor_id); 
    selected_material=[]; var material_types=[];

     $materials.empty(); //remove selected elements
     $material_type.val(null).trigger("change"); //remove selected elements

    if(result.vendor_materials.length>0)
    {
        $.each(result.vendor_materials, function (key, val) {
            selected_material.push(val.material_name);
            material_types.push(val.material_type);
        }); 

        $material_type.val(material_types).trigger("change");
        material_type_select("");
    } 



    $("#vendor_name").val(result.first_name+" "+ (result.last_name!=null ? result.last_name : ""));
    $("#shop_name").val(result.shop_name);
    $("#mobile").val(result.mobile);
    $("#email_id").val(result.email_id);
    $("#vendor_id").val(vendor_id);
    $('#btn_title').html('Update');
}

jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z ]+$/i.test(value);
}, "Please enter letters only. "); 


$("#add_vendors").validate({
    rules: {
        vendor_name: {
          required: true,
          lettersonly: true, 
         
          maxlength:30, 
        },
        shop_name: {
          required: true,
          // lettersonly: true,
         
          maxlength:30, 
        },
        mobile: {
          required: true,
          number: true,
          minlength:10,
          maxlength:10,
          
        },
        email_id: {
          required: true,
          email: true
        },
        material_type: {
          required: true
        },
        material_name: {
          required: true
        }
            
        
      },
      messages: {
        vendor_name: {
          required: "Please Enter Vendor Name",
         
          maxlength:"Vendor Name should be maximum of 30 Charachers"
        },
        shop_name: {
          required: "Please Enter Shop Name", 
          
          maxlength:"Shop Name should be maximum of 30 Charachers"
        },
        mobile: {
          required: "Please Enter Mobile Number",
          minlength:"Mobile number should be 10 digits",
          maxlength:"Mobile number should be 10 digits"
//          required: "Please enter Mobile Number"
        },
        email_id: {
          required: "Please enter Email Id",
          email: "Please enter valid Email Id"
        },
        material_type: {
          required: "Please Select Material Type"
        },
        material_name: {
          required: "Please Select Material Type"
        }     
       
      },    
      submitHandler: function (form, message) {
              
          redUrl = base_url+'/add-vendors'; 

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

                      $(".vendor-err").css("color", "#28a745");
                      $(".vendor-err").html(res.msg);
                      setTimeout(function () {
                         location.reload();
                      }, 500);

                  } else {
                      // fp1.close();
                      $(".vendor-err").css("color", "red");
                      $(".vendor-err").html(res.msg);
                     
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


function delete_vendor(vendor_id)
{
    if(confirm("Do you want to delete vendor ?"))    
    {
        redUrl = "{{url('/admin/add-vendors')}}";  
        $.ajax({
              url: redUrl,
              type: 'post',
              data: { _token: "{{ csrf_token() }}",delete:'1',vendor_id:vendor_id},
              dataType: 'json',
              success: function (res) {

                  if (res.status) {

                      $(".vendor-err").css("color", "#28a745");
                      $(".vendor-err").html(res.msg);
                      setTimeout(function () {
                         location.reload();
                      }, 500);


                  } else {
                      // fp1.close();
                      $(".vendor-err").css("color", "red");
                      $(".vendor-err").html(res.msg);
                     
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

