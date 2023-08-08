@include('admin/header')


    <link rel="stylesheet" href="{{asset('assets/css/lib/datatable/dataTables.bootstrap.min.css')}}">
    <link href="https://oliveindesign.com/client/khalatkar-iroad/application/css/hint.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <style> 
        .page-title span{
            color: #44b749;
            line-height: 30px;
            font-size: 20px;
            /* color: #2d3037; */
            padding-left: 18px;
            border-left: 6px solid #44b749
        }     

        .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        color: inherit;
        background-color: transparent;
    } 

    .nav-link {
        display: block;
        padding: none;
    }
        /* *************************************** */

        .nav-link .active>h5 {
            background: #4caf50;
            }
    
        .nav-link .components-img>h5:hover {
            background-color: #212529;
        }

    .site-details h4, .users-details h4 {
        font-size: 20px;
        padding: 15px 0px 40px 15px;
        color: #000;
        font-weight: bold;
    }

    .components-img h5 .icon.plain_road {
            background: url('../assets/images/components/plain_road_active.png') no-repeat center center;
        }

    .components-img h5 .icon.flyover {
            background: url('../assets/images/components/flyover_active.png') no-repeat center center;
        }

    .components-img h5 .icon.underpass {
            background: url('../assets/images/components/underpass_active.png') no-repeat center center;
        }

    .components-img h5 {
        padding: 10px;
        text-decoration: none;
        font-size: 18px;
        color: #fff;
        display: block;
        transition: 0.3s;
        text-align: left;
        border: 1px solid #aaaaaa;
        /* margin: 10px 0px; */
        padding: 22px 0px;
        cursor: pointer;
        background: #005497;
    }

    .components-img h5 .icon {
        width: 55px;
        height: 45px;
        display: block;
        float: left;
        margin-top: -14px;
        margin-left: 10px;
        margin-right: 20px;
    }

    .road-components-img {
        /* height: 787px; */
        /* padding: 10px; */
        border: 1px solid #aaaaaa;
        margin: 0px 0px 15px 0px;
    }

    #div1 {
    /* height: 786px; */
            /* padding: 10px 0px 80px 0px; */
            border: 1px solid #aaaaaa;
            margin: 0px 0px 15px 0px;
            overflow-y: scroll;
        }

        </style>

<?php $prefix= $profile_data['prefix'];  ?>

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">                       
                            <div class="page-title">
                                <h1><span>Site Name</span> - {{ $site['site_name'] }}</h1>
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
                            <!-- <div class="card-header">
                                    <button type="button" class="btn btn-success btn-sm add-site-btn" data-toggle="modal" data-target="#scrollmodal"> Add New Site </button>                               
                                    <button type="button" onclick="history.back()" class="btn btn-success btn-sm pull-right">Back</button>
                                        <strong class="card-title">Data Table</strong>
                            </div> --><!-- .card Header-->    
                            <div class="card-body">
                            <form id="component_chainage">
                        @csrf

                        <input type="hidden" value="{{ $site['site_id'] }}" id="site_id" name="site_id">
                        <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12"> 

                            <div class="site-details add-nameh4 mrg2015">
                                <h4>Project Details</h4>   
                            </div>

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="site_name" class=" form-control-label">SITE NAME</label>
                                            <input type="text" value="{{ $site['site_name'] }}" readonly id="site_name" name="site_name" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">                                       
                                        <div class="form-group">
                                            <label for="no_of_junction" class=" form-control-label">JUNCTIONS</label>
                                            <input type="text" value="{{ $site['no_of_junction'] }}" readonly id="no_of_junction" name="no_of_junction" placeholder="" class="form-control">
                                        </div>                                       
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="road_length" class=" form-control-label">LENGTH OF ROAD</label>
                                            <label class="input-group">
                                                <input type="text" value="{{ $site['road_length'] }} M" readonly id="road_length" readonly name="road_length" placeholder="" class="form-control">                                              
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">                                       
                                        <div class="form-group">
                                            <label for="tender_budget" class=" form-control-label">TENDER BUDGET</label>
                                            <label class="input-group">
                                                <input type="text" readonly value="{{ $site['tender_budget'] }}" id="tender_budget" name="tender_budget" placeholder="" class="form-control">                                               
                                            </label>
                                        </div>                                       
                                    </div>
                                </div> 

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="project_start_date" class=" form-control-label">PROJECT START DATE</label>
                                            <input type="text" value="{{ $site['project_start_date'] }}"  readonly id="project_start_date" name="project_start_date" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">                                       
                                        <div class="form-group">
                                            <label for="project_end_date" class=" form-control-label">PROJECT END DATE</label>
                                            <input type="text" value="{{ $site['project_end_date'] }}" readonly id="project_end_date" name="project_end_date" placeholder="" class="form-control">
                                        </div>                                       
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="design_chainage" class=" form-control-label">DESIGN CHAINAGE</label>                                           
                                            <input type="text" value="{{ $site['design_chainage'] }}" readonly id="design_chainage" name="design_chainage" placeholder="" class="form-control">                                                                                        
                                        </div>
                                    </div>                                   
                                </div> 

                                <div class="site-details add-nameh4 mrg2015">
                                <h4>Add Road Components</h4>   
                                </div>
                                
                                <div class="row">

                                    <div class="col-4">
                                        <div class="road-components-img">
                                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                           
                                            @foreach($road_components as $rc_key=>$component)
                                            <a class="nav-link" id="v-pills-home-tab{{ $rc_key }}" data-toggle="pill" href="#v-pills-home{{ $rc_key }}" role="tab" aria-controls="v-pills-home{{ $rc_key }}" aria-selected="true">
                                                <!-- Home -->
                                                <div class="col-lg-12 col-md-12 col-sm-12" id="{{ $component['component_id'] }}">
                                                    <div class="components-img" id="drag{{ $component['component_id'] }}" draggable="true" ondragstart="drag(event)">

                                                        <h5><span class="icon {{ $component['component_class'] }}"></span><span class="text">{{ $component['component_name'] }}</span></h5>
                                                        <input type="hidden" id="comp_id_{{ $component['component_id'] }}" name="comp_id[]" value="{{ $component['component_id'] }}">
                                                    </div>
                                                </div>
                                            </a>  
                                            @endforeach 

                                            <!-- <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                                <div class="col-lg-12 col-md-12 col-sm-12" id="11">
                                                    <div class="components-img" id="drag11" draggable="true" ondragstart="drag(event)">

                                                        <h5><span class="icon plain_road"></span><span class="text">Box Culvert</span></h5>
                                                        <input type="hidden" id="comp_id_11" name="comp_id" value="11">
                                                    </div>
                                                </div>  
                                            </a>
                                            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                                <div class="col-lg-12 col-md-12 col-sm-12" id="11">
                                                        <div class="components-img" id="drag11" draggable="true" ondragstart="drag(event)">

                                                            <h5><span class="icon plain_road"></span><span class="text">Box Culvert</span></h5>
                                                            <input type="hidden" id="comp_id_11" name="comp_id" value="11">
                                                        </div>
                                                </div>
                                            </a>
                                            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                            <div class="col-lg-12 col-md-12 col-sm-12" id="11">
                                                    <div class="components-img" id="drag11" draggable="true" ondragstart="drag(event)">

                                                        <h5><span class="icon plain_road"></span><span class="text">Box Culvert</span></h5>
                                                        <input type="hidden" id="comp_id_11" name="comp_id" value="11">
                                                    </div>
                                                </div>  
                                            </a> -->

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-8" id="div1">
                                        <div class="tab-content" id="v-pills-tabContent">

                                        @foreach($road_components as $rc_key=>$component)
                                        <!-- <div class="tab-pane fade show active" id="v-pills-home{{ $rc_key }}" role="tabpanel" aria-labelledby="v-pills-home-tab{{ $rc_key }}"> -->
                                        <div class="tab-pane fade" id="v-pills-home{{ $rc_key }}" role="tabpanel" aria-labelledby="v-pills-home-tab{{ $rc_key }}">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="chainage_block" class=" form-control-label">Enter No Of {{ $component['component_name'] }} Components</label>
                                                                    <input type="text" name="no_of_chainage" placeholder="Enter No Of {{ $component['component_name'] }} Components" class="form-control no_of_chainage">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="row">
                                                            <div class="col-lg-5">
                                                                <div class="form-group">
                                                                    <label for="chainage_block" class=" form-control-label">FROM</label>
                                                                    <input type="text" name="chainage_from[]" placeholder="Enter chainage in meters" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-5">                                        
                                                                <div class="form-group">
                                                                    <label for="shop_name" class=" form-control-label">TO</label>
                                                                    <input type="text" name="chainage_to[]" placeholder="Enter chainage in meters" class="form-control">
                                                                </div>                                       
                                                            </div>
                                                            <div class="col-lg-2">          
                                                                <a href="javascript:void(0)" class="closeBtn removemore"><i class="fa fa-trash" style="color: #dc3545"></i></a> 
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                </div>
                                        </div>
                                        @endforeach
                                        
                                        <!-- <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">culvert</div>
                                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div> -->
                                        </div>
                                    </div>
                                </div>                                

                            </div>
                        </div> 
                        <div class="row text-center"><div class="col-lg-12 chainage-msg"></div></div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" id="btnsubmit" class="btn btn-primary"><span id="btn_title">Submit</span></button>
                        </div>

                        </form>
                            </div><!-- .card body -->
                        </div><!-- .card -->
                    </div><!-- .col-md-12 -->
                </div><!-- .row -->
            </div><!-- .animated fadeIn -->
        </div><!-- .content -->



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

            $('.labour-nav').addClass('active');

          $('#bootstrap-data-table-export').DataTable();

          $(".add-site-btn").click(function(){
                $("#component_chainage").trigger("reset");
                initAutocomplete();               
                // $("#refresh").click();
          });

          $(".nav-link").click(function(){
                // Holds the product ID of the clicked element
                 $('.nav-link').find('.components-img').removeClass('active');
                 $(this).find('.components-img').addClass('active');
            });

            // $('.tab-pane').on('focusout', '.chainage_from', function() {
            //     var inputElements = $('.'+$(this).attr('parentClass')).find("input[name='chainage_from[]']").not(this);
            //     var currentVal=$(this).val();
            //     inputElements.each(function(index) {
            //             // var compId = $(this).val();
            //             alert($(this).val());
            //             if(currentVal<=5 && $(this).val()>=10)
            //             {                            
            //             }
            //      });
            // });
            // $('.tab-pane').on('focusout', '.chainage_to', function() {
            //     alert($(this).val());
            // });

          
            $('.no_of_chainage').focusout(function(){
                // alert(this.value);            
                var comp_id = $(".active").children("input[name='comp_id[]']").val();
              
                for(i=1; i<=this.value; i++)
                {
                    var prev_chainage_count=$(this).parent().parent().parent().siblings().length;

                    var activity='';
                    activity+='<div class="row comp-id' + comp_id + '" >';
                    activity+='<div class="col-lg-5">';
                    activity+='<div class="form-group">';
                    activity+='<label for="chainage_from'+comp_id+prev_chainage_count+'" class=" form-control-label">FROM</label>';
                    activity+='<input type="text" name="chainage_from[]" parentClass="comp-id' + comp_id + '" id="chainage_from'+comp_id+prev_chainage_count+'" placeholder="Enter chainage in meters" class="form-control chainage_from">';
                    activity+='</div>';
                    activity+='</div>';
                    activity+='<div class="col-lg-5">';
                    activity+='<div class="form-group">';
                    activity+='<label for="chainage_to'+comp_id+prev_chainage_count+'" class=" form-control-label">TO</label>';
                    activity+='<input type="text" name="chainage_to[]" parentClass="comp-id' + comp_id + '" id="chainage_to'+comp_id+prev_chainage_count+'" placeholder="Enter chainage in meters" class="form-control chainage_to">';
                    activity+='</div>';                                       
                    activity+='</div>';
                    activity+='<div class="col-lg-2">';
                    activity+='<a href="javascript:void(0)" class="closeBtn removemore"><i class="fa fa-trash" style="color: #dc3545; font-size:20px"></i></a>'; 
                    activity+='</div>';
                    activity+='</div>';

                    if($(this).parent().parent().parent().siblings().length > 0)
                    {
                        $( activity ).insertAfter( $(this).parent().parent().parent().siblings().last() );
                    } else {
                        $( activity ).insertAfter( $(this).parent().parent().parent());
                    }                    

                }
            });

            $(document).on('click', '.removemore', function () {
                $(this).parent().parent().remove();
                // reset_properteis();
            });           

      } );

      function reset_properteis() {
            $(".activity_row").each(function(index,val) {
                var cnt = index + 1;
                console.log(val);
                $(val).find('label:first-child').text("New Activity "+cnt);             
                // $(this).find('label:first-child').text("New Activity "+cnt);  //or we can using a "this" keyword
            });
        }

   
    var form=$("#component_chainage");
    form.validate({
        rules: {
            'no_of': {
                required: true,
            },
            // 'chainage_from[]': {
            //     number: true,
            // },
            // 'chainage_to[]': {
            //     number: true,
            // }          
        },
        messages: {           
            'no_of': {
                required: "Enter only number.",
            },
            // 'chainage_from[]': {
            //     number: "Enter only number.",
            // },
            // 'chainage_to[]': {
            //     number: "Enter only number.",
            // } 
        },   
        submitHandler: function (form, message) {   
            // console.log("submit form"); 
            
                      
          
            
           
            var chainage_data = [];
            $("input[name='comp_id[]']").each(function(index1) {
                var compId = $(this).val();
                var obj=[];

                var i=0;
                $('.comp-id'+$(this).val()).each(function(index, value) {
                  var chainage_from = $(this).find("input[name='chainage_from[]']");
                  var chainage_to = $(this).find("input[name='chainage_to[]']");
                  if(chainage_from.val()!='' && chainage_to.val()!='')
                  {
                      obj[i]={component:compId,chainage_from:chainage_from.val(),chainage_to:chainage_to.val()};
                      i++;
                  }
                });
                
                obj.length>0 ? chainage_data[index1]=obj : '';
            });            

            console.log(chainage_data);

            // return false;          

            redUrl = base_url+'/add-component-chainage'; 

            var fd=new FormData(form);
            fd.append('chainage_data', JSON.stringify(chainage_data));

            $.ajax({
                url: redUrl,
                type: 'post',
                data: fd,
                dataType: 'json',
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (res) {
                   
                    if (res.status) {
                        $(".chainage-msg").css("color", "#28a745");
                        $(".chainage-msg").html(res.message);
                        setTimeout(function () {
                            location.reload();
                        }, 500);
                    } else {
                        $(".chainage-msg").css("color", "red");
                        $(".chainage-msg").html(res.message);
                        
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

    // $("#btnsubmit").click(function(){
    //   if (form.valid() == true){       
    //   }   
    // });

  </script>


</body>
</html>

