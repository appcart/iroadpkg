@include('admin/header')


    <link rel="stylesheet" href="{{asset('assets/css/lib/datatable/dataTables.bootstrap.min.css')}}">
    <link href="{{asset('assets/css/hint.min.css.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <style>
        .modal-lg {
  max-width: 80%;
}
        </style>

   
<?php $prefix= $profile_data['prefix'];  ?>

        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">                       
                            <div class="page-title">
                                <h1>Sites</h1>
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
                             <div class="card-header">
                                <button type="button" class="btn btn-success btn-sm add-site-btn" data-toggle="modal" data-target="#scrollmodal"> Add New Site </button>                               
                                <button type="button" onclick="history.back()" class="btn btn-success btn-sm pull-right">Back</button>
                                <!-- <strong class="card-title">Data Table</strong> -->
                            </div>

        <div class="site-container">         

        @foreach($sites as $key=>$val)
        <div class="common-edit-btn">
        <ul>
            <!-- <li class="brd-btm-none"><a class="hint--top" href="{{ $prefix }}/project-details?site_id={{ base64_encode($val['site_id']) }}" aria-label="Click to view project details"> Project Details</a></li> -->
            <li class="brd-btm-none"><a class="hint--top" href="{{ $prefix }}/add-project-details?site_id={{ base64_encode($val['site_id'])  }}" aria-label="Click to add project details">Add Project Details</a></li>
        </ul>
    </div>
        <div class="site-points">
        <div class="project-content">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <h4><a aria-label="Click to go dashboard" class="hint--top" href="{{ $prefix }}/add-project-details?site_id={{ base64_encode($val['site_id'])  }}">{{ $val['site_name'] }}</a></h4>
            </div>   
        

            <div class="col-lg-12 col-md-12">
                <div class="row px-2">

                    <div class="col-lg-4 col-md-6 col-sm-6"><div class="sub-project-plan"><span class="img" style="padding: 11px 10px;"><img src="{{asset('assets/images/icons/length.png')}}"></span>
                            <div class="plan-heading"><span class="heading">Length</span>
                                <span class="sub-heading">
                                    {{ $val['road_length'] }} m.</span></div>
                                    <!--//41864.54314796049 m.</span></div>-->
                                    <!--// m.</span></div>-->
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="sub-project-plan"><span class="img"><img src="{{asset('assets/images/icons/junctions.png')}}"></span>
                            <div class="plan-heading"> <span class="heading"> Junctions</span>
                                <span class="sub-heading">{{ $val['no_of_junction'] }}</span></div>
                        </div></div>

                    <div class="col-lg-5 col-md-6 col-sm-7"><div class="sub-project-plan"><span class="img"><img src="{{asset('assets/images/icons/manager.png')}}"></span>
                            <div class="plan-heading"><span class="heading">Project Manager</span>
                                <span class="sub-heading">-</span></div>
                        </div></div>

                    <div class="col-lg-4 col-md-6 col-sm-5"><div class="sub-project-plan"><span class="img"><img src="{{asset('assets/images/icons/road.png')}}"></span>
                            <div class="plan-heading"><span class="heading">Type of Road</span>
                                <span class="sub-heading">Concrete</span></div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6"><div class="sub-project-plan"><span class="img"><img src="{{asset('assets/images/icons/date.png')}}"></span>
                            <div class="plan-heading"><span class="heading">Date</span>
                                <span class="sub-heading">{{ date('F d Y',strtotime($val['project_start_date'])) }}</span></div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-7"><div class="sub-project-plan"><span class="img"><img src="{{asset('assets/images/icons/length.png')}}"></span>
                            <div class="plan-heading"><span class="heading">Design Chainage</span>
                                <span class="sub-heading">{{ $val['design_chainage'] }}</span></div>
                        </div>
                    </div>


                    <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="sub-project-plan"><span class="img"><img src="{{asset('assets/images/icons/location.png')}}"></span>
                        <div class="plan-heading"><span class="heading">Location</span>
                        <span class="sub-heading">{{ $val['road_name'] }}</span></div>
                        </div>
                    </div> 
                </div>
            </div>

        </div>
        </div> 
        </div>   
        
        @endforeach

      
                      
      

    </div> <!-- Site container close  -->
           
        </div><!-- .content -->



        <div class="clearfix"></div>

        @include('admin/footer')

    </div><!-- /#right-panel -->

    <!-- Right Panel -->





 <!-- ****************************** Site Form ****************************** -->
    

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

                        <form id="add_site">
                        @csrf

                        <input type="hidden" value="" id="site_id" name="site_id">
                        <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12"> 

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="site_name" class=" form-control-label">SITE NAME</label>
                                            <input type="text" id="site_name" name="site_name" placeholder="Site Name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">                                       
                                        <div class="form-group">
                                            <label for="no_of_junction" class=" form-control-label">JUNCTIONS</label>
                                            <input type="number" id="no_of_junction" name="no_of_junction" placeholder="No Of Junction" class="form-control">
                                        </div>                                       
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="road_length" class=" form-control-label">LENGTH OF ROAD</label>
                                            <label class="input-group">
                                                <input type="text" id="road_length" readonly name="road_length" placeholder="" class="form-control">
                                                <span class="input-group-addon">Meters</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">                                       
                                        <div class="form-group">
                                            <label for="tender_budget" class=" form-control-label">TENDER BUDGET</label>
                                            <label class="input-group">
                                                <input type="number" id="tender_budget" name="tender_budget" placeholder="Tender Budget" class="form-control">
                                                <span class="input-group-addon">INR</span>
                                            </label>
                                        </div>                                       
                                    </div>
                                </div> 

                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="project_start_date" class=" form-control-label">PROJECT START DATE</label>
                                            <input max="{{date('Y-m-d')}}" type="date" id="project_start_date" name="project_start_date" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">                                       
                                        <div class="form-group">
                                            <label for="project_end_date" class=" form-control-label">PROJECT END DATE</label>
                                            <input min="{{date('Y-m-d')}}" type="date" id="project_end_date" name="project_end_date" placeholder="" class="form-control">
                                        </div>                                       
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="design_chainage" class=" form-control-label">DESIGN CHAINAGE</label>                                           
                                            <input type="text" id="design_chainage" name="design_chainage" placeholder="" class="form-control">                                                                                        
                                        </div>
                                    </div>                                   
                                </div> 
                                
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                        <button type="button" id="refresh" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i> Refresh</button>
                                        </div> 
                                    </div> 
                                </div> 
                                
                                <div class="row">
                                    <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="road_name"  class=" form-control-label">Name Of Road</label>                                           
                                                <input type="text" name="road_name"  id="road_name"  placeholder="Enter Name Of Road" class="form-control">                                                                                        
                                            </div>
                                    </div>   
                                </div> 
                                <br>
                                
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <ul class="coord list-unstyled col-lg-12 col-md-12" style="display: none;">
                                        </ul>
                                   </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2 id="map_canvas" style="width:97%; height:500px">Please search road</h2>
                                    </div>
                                </div>

                              <!-- ******************************************* Display None Field **************************** -->

                              <div class="col-lg-6" style="display: none;">
                                <div class="row">
                                    <div class="col-lg-offset-0 col-lg-12 col-md-offset-0 col-md-12 col-sm-offset-2 col-sm-8">
                                        <label class="sub-heading-map">CENTER</label>
                                    </div>

                                    <div class="col-lg-offset-0 col-lg-6 col-md-offset-0 col-md-6 col-sm-offset-2 col-sm-8">
                                        <div class="form-group">
                                            <label>LATITUDE</label>
                                            <input type="text" class="form-control" id="lat" value="21.1458">
                                            <!-- <input type="text" id="name" placeholder="Add here"> -->
                                        </div>
                                    </div>
                                    <div class="col-lg-offset-0 col-lg-6 col-md-offset-0 col-md-6 col-sm-offset-2 col-sm-8">
                                        <div class="form-group">
                                            <label>LONGITUDE</label>
                                            <input type="text" class="form-control" id="lng" value="79.0882">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6" style="display: none;">
                                <div class="row">
                                    <div class="col-lg-offset-0 col-lg-12 col-md-offset-0 col-md-12 col-sm-offset-2 col-sm-8">
                                        <label class="sub-heading-map">START POINT</label>
                                    </div>

                                    <div class="col-lg-offset-0 col-lg-6 col-md-offset-0 col-md-6 col-sm-offset-2 col-sm-8">
                                        <div class="form-group">
                                            <label>LATITUDE</label>
                                            <input type="text" class="form-control" id="lat_pt1" placeholder="Add here">
                                        </div>
                                    </div>
                                    <div class="col-lg-offset-0 col-lg-6 col-md-offset-0 col-md-6 col-sm-offset-2 col-sm-8">
                                        <div class="form-group">
                                            <label>LONGITUDE</label>
                                            <input type="text" class="form-control" id="lng_pt1" placeholder="Add here">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6" style="display: none;">
                                <div class="row">
                                    <div class="col-lg-offset-0 col-lg-12 col-md-offset-0 col-md-12 col-sm-offset-2 col-sm-8">
                                        <label class="sub-heading-map">END POINT</label>
                                    </div>

                                    <div class="col-lg-offset-0 col-lg-6 col-md-offset-0 col-md-6 col-sm-offset-2 col-sm-8">
                                        <div class="form-group">
                                            <label>LATITUDE</label>
                                            <input type="text" class="form-control" id="lat_pt2" placeholder="Add here">
                                        </div>
                                    </div>
                                    <div class="col-lg-offset-0 col-lg-6 col-md-offset-0 col-md-6 col-sm-offset-2 col-sm-8">
                                        <div class="form-group">
                                            <label>LONGITUDE</label>
                                            <input type="text" class="form-control" id="lng_pt2" placeholder="Add here">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ***********************  End Display None field ********************** -->


                               

                                <div class="w-100 text-center"><span class="site-err"></span></div>

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

           

            <!-- *********************************** Site Form End *************************** -->


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
    <!-- <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1P8vWnk2SAriRzCMObr_Jvwmd9ppNvIw&libraries=places&v=weekly"  defer></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1P8vWnk2SAriRzCMObr_Jvwmd9ppNvIw&libraries=places,drawing"></script>
    <!-- <script type="text/javascript" src="{{asset('assets/js/maps/road-google-map.js')}}"></script> -->
    <script src="{{asset('assets/js/common.js')}}"></script>


    <script type="text/javascript">
        $(document).ready(function() {

            $('.labour-nav').addClass('active');

          $('#bootstrap-data-table-export').DataTable();

          $(".add-site-btn").click(function(){
                $("#add_site").trigger("reset");
                initAutocomplete();               
                $("#map_canvas").html("Please search road");
          });

      } );


//    ****************************************************************** JS MAP ***************************************

// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
var coordinates=[];
var placeSearch, autocomplete;
var cli = 0;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'india',
  postal_code: 'short_name'
};

function initAutocomplete() {

  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
    (document.getElementById('road_name')),                                /** @type {!HTMLInputElement} */
    { types: ['geocode'], componentRestrictions: { country: "ind" } });

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);


}
var roadLengthinMeters = 0;
function distance(lat1, lon1, lat2, lon2, unit) {
  var radlat1 = Math.PI * lat1 / 180
  var radlat2 = Math.PI * lat2 / 180
  var theta = lon1 - lon2
  var radtheta = Math.PI * theta / 180
  var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
  if (dist > 1) {
    dist = 1;
  }
  dist = Math.acos(dist)
  dist = dist * 180 / Math.PI
  dist = dist * 60 * 1.1515
  if (unit == "K") { dist = dist * 1.609344 }
  if (unit == "N") { dist = dist * 0.8684 }
  return dist
}
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  var lat = place.geometry.location.lat();
  var lng = place.geometry.location.lng();
  // console.log(place.geometry.location.lng());
  document.getElementById("lat").value = lat;
  document.getElementById("lng").value = lng;

  document.getElementById("lat_pt1").value = "";
  document.getElementById("lng_pt1").value = "";

  document.getElementById("lat_pt2").value = "";
  document.getElementById("lng_pt2").value = "";

  // alert("maps");
  var arr_pts = [];
  var map = new google.maps.Map(document.getElementById("map_canvas"), getOptions());
  //	google.maps.event.addListener(map, 'click', function(event) {
  //	    //marker = new google.maps.Marker({position: event.latLng, map: map});
  //	     console.log(event.latLng.lat() + "," + event.latLng.lng());
  //	    arr_pts.push(event.latLng.lat() + "," + event.latLng.lng());
  //       console.log(arr_pts);
  html = "";
  //      $.each(arr_pts, function( index, value ) {
  //        sp = value.split(",");
  //        html += "<li class='col-lg-6 col-md-6'>"
  //          +"<input type='text' name='coords_lat[]' value='"+sp[0]+"' />"
  //          +"<input type='text' name='coords_lng[]' value='"+sp[1]+"' />"
  //          +"</li>";
  //      });
  //         console.log(html);
  //        $(".coord").html(html);
  //
  //	    cli = cli + 1;
  //	    	
  //	    if(cli > 0 && cli%2 == 0){
  //	    	document.getElementById("lat_pt2").value = event.latLng.lat();
  //        	document.getElementById("lng_pt2").value = event.latLng.lng();
  //	    }else if(cli > 0 && cli%2 != 0){
  //	    	  document.getElementById("lat_pt1").value = event.latLng.lat();
  //	        document.getElementById("lng_pt1").value = event.latLng.lng();
  //	    }
  //
  //
  //		// init directions service
  //		var dirService = new google.maps.DirectionsService();
  //		var dirRenderer = new google.maps.DirectionsRenderer({suppressMarkers: true});
  //		dirRenderer.setMap(map);
  //
  //	    request = setPath();
  //		dirService.route(request, function(result, status) {
  //		  if (status == google.maps.DirectionsStatus.OK) {
  //		    dirRenderer.setDirections(result);
  //		  }
  //		});
  //    originSplit = request.origin.split(",");
  //    destinationSplit = request.destination.split(",");
  //    
  //    console.log(originSplit);
  //    console.log(destinationSplit);
  //    
  //    var roadLength = distance(originSplit[0], originSplit[1], destinationSplit[0], destinationSplit[1], "K");
  //    var roadLengthinMeters = roadLength * 1000;
  ////            $("#road_length").val(roadLength);
  //            $("#road_length").val(roadLengthinMeters);
  //    // console.log("origin: " + originSplit[0] + ", <br />destination: " + request.destination);
  //	});


  var drawingManager = new google.maps.drawing.DrawingManager({
    // drawingMode: google.maps.drawing.OverlayType.MARKER,
    drawingControl: true,
    drawingControlOptions: {
      position: google.maps.ControlPosition.TOP_CENTER,     
      drawingModes: ['polyline']
    },
    // markerOptions: { icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png' },
    circleOptions: {
      fillColor: '#ffff00',
      fillOpacity: 1,
      strokeWeight: 5,
      clickable: false,
      editable: true,
      zIndex: 1
    }
  });



  google.maps.event.addListener(drawingManager, 'polylinecomplete', function (line) {
    //  alert(line.getPath().getArray().toString());
    //  console.log(line.getPath().getArray().toString());
    //  console.log(line.getPath());
    //  console.log(line.getPath().getArray());
    var lat_log_string = line.getPath().getArray().toString();

    var s = lat_log_string.split("(").join("");
    var s2 = s.split(")").join("");
    //  console.log(s);
    //  console.log(s2);
    // var ret = lat_log_string.replace('(','');
    // console.log(ret);
    // var ret2 = ret.replace(')','');
    // console.log(ret2);
    var arr = s2.split(",");
    //  console.log(arr); 
    console.log("----------------------");
    console.log(arr);
    console.log(arr.length);

    var ia;
    for (ia = 0; ia <= arr.length;) {

      arr_pts.push(arr[ia] + "," + arr[ia + 1]);
      ia = ia + 2;
      //    console.log(ia);
    }
    console.log(arr_pts);
    console.log("----------------------");

    coordinates=[];
    var lan_cat;
    var lat_cat;
    var route=1;
    $.each(arr_pts, function (index, value) {
      sp = value.split(",");
      html += "<li class='col-lg-6 col-md-6'>"
        + "<input type='text' name='coords_lat[]' value='" + sp[0] + "' />"
        + "<input type='text' name='coords_lng[]' value='" + sp[1] + "' />"
        + "</li>";

        if(sp[0]=="undefined")
        {
            route++;
        } else {
            single_coord = {"latitude" : sp[0],'longitude':sp[1],'route': route};
            coordinates.push(single_coord);
        }
    });

    $(".coord").html(html);
    //
    cli = cli + 1;

    if (cli > 0 && cli % 2 == 0) {
      document.getElementById("lat_pt2").value = arr[0];
      document.getElementById("lng_pt2").value = arr[1];
    } else if (cli > 0 && cli % 2 != 0) {
      document.getElementById("lat_pt1").value = arr[0];
      document.getElementById("lng_pt1").value = arr[1];
    }
    var dist = distance(arr[0], arr[1], arr[arr.length - 2], arr[arr.length - 1], "K");
    console.log("dist" + dist);
    // init directions service
    var dirService = new google.maps.DirectionsService();
    var dirRenderer = new google.maps.DirectionsRenderer({ suppressMarkers: true });
    dirRenderer.setMap(map);

    request = setPath();
    dirService.route(request, function (result, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        dirRenderer.setDirections(result);
      }
    });
    //    originSplit = request.origin.split(",");
    //    destinationSplit = request.destination.split(",");
    originSplit = '';
    destinationSplit = '';

    console.log(originSplit);
    console.log(destinationSplit);

    //    var roadLength = distance(originSplit[0], originSplit[1], destinationSplit[0], destinationSplit[1], "K");
    //    var roadLengthinMeters = roadLength ;
    roadLengthinMeters = roadLengthinMeters + dist * 1000;
    //            $("#road_length").val(roadLength);
    $("#road_length").val(roadLengthinMeters);
    // console.log("origin: " + originSplit[0] + ", <br />destination: " + request.destination);

    //   console.log(event.latLng.lat() + "," + event.latLng.lng());
    //	    arr_pts.push(event.latLng.lat() + "," + event.latLng.lng());
    //       console.log(arr_pts);
  });


  console.log(drawingManager);
  drawingManager.setMap(map);


  /*for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }*/

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  /*for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }*/
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
      // console.log(document.getElementById("lat").value);
      var geolocation = {
        lat: document.getElementById("lat").value, //position.coords.latitude,
        lng: document.getElementById("lng").value //position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}

/*google.maps.event.addListener(autocomplete, 'place_changed', function () {
    var place = autocomplete.getPlace();
      console.log(place.geometry.location.lat())
});*/

// initAutocomplete();  // inits autocomplete



// init map
function getOptions() {
  var myOptions = {
    center: new google.maps.LatLng(document.getElementById("lat").value, document.getElementById("lng").value),
    zoom: 18,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  return myOptions;
}
//var map = new google.maps.Map(document.getElementById("map_canvas"), getOptions());


function setPath() {
  // highlight a street
  var request = {
    origin: document.getElementById("lat_pt1").value + ","
      + document.getElementById("lng_pt1").value,
    //			  destination: document.getElementById("lat_pt2").value +","
    //                  + document.getElementById("lng_pt2").value,
    destination: "",
    //waypoints: [{location:"48.12449,11.5536"}, {location:"48.12515,11.5569"}],
    travelMode: google.maps.TravelMode.DRIVING
  };
  console.log(request)
  return request;
}




    $("#refresh").on('click', function () {
        // var map = new google.maps.Map(document.getElementById("map_canvas"), getOptions());
        fillInAddress();
        roadLengthinMeters = 0;
        $("#road_length").val("");
        $(".coord").html("");
    });




    $("#add_site").validate({
        rules: {
            site_name: {
             required: true,
            },
            no_of_junction: {
              required: true,
              number:true
            },
            road_length: {
             required: true,
            },
            tender_budget: {
             required: true,
            },
            project_start_date: {
              required: true
            },
            project_end_date: {
              required: true
            }
        },
        messages: {
           
            site_name: {
              required: "Please Enter Site Name",
            },
            no_of_junction: {
             required: "Please Enter No Of Junctions",
            },
            road_length: {
              required: "Please Select Road Track",
            },
            tender_budget: {
               required: "Please Select Tender Budget",
            },
            project_start_date: {
             required: "Please Select Project Start Date"
            },
            project_end_date: {
              required: "Please Select Project End Date"
            }
        
        },    
        submitHandler: function (form, message) {
                
            redUrl = base_url+'/add-site'; 

            fd=new FormData(form);

            fd.append("coordinates",JSON.stringify(coordinates));

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

                        $(".site-err").css("color", "#28a745");
                        $(".site-err").html(res.msg);
                        setTimeout(function () {
                            location.reload();
                        }, 500);

                    } else {
                        // fp1.close();
                        $(".site-err").css("color", "red");
                        $(".site-err").html(res.msg);
                        
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



  </script>


</body>
</html>

