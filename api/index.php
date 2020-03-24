<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from https://bootdey.com  -->
    <!--  All snippets are MIT license https://bootdey.com/license -->
    <title>YasnaTeam Smart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/jquery-3.4.1.min.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="js/bootstrap-toggle.min.js"></script>
    <script src="js/yasna.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <linl href="css/font-awesome/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 pb-5">
            <!-- Account Sidebar-->
            <div class="author-card pb-3">
                <div class="author-card-cover" style="background-image: url(img/cover.jpg);"></div>
                <div class="author-card-profile">
                    <div class="author-card-avatar"><img src="frontend-vuejs/public/img/theme/avatar.png" alt="Daniel Adams">
                    </div>
                    <div class="author-card-details">
                        <h5 class="author-card-name text-lg">کنترل داخلی یسناتیم</h5><span class="author-card-position">به روزرسانی: <span id="time"></span></span>
                    </div>
                </div>
            </div>
            <div class="wizard">
                <nav class="list-group list-group-flush">
                    <div class="list-group-item" href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="fe-icon-shopping-bag mr-1 text-muted"></i>
                                <div class="d-inline-block font-weight-medium text-uppercase">
                                <img src="img/cooling.png" width="32" height="32">
                                کولر سالن اصلی</div>
                            </div>
                            <div class="example">
                                <img src="img/alert.png" style="display:none;" id="cooling1_alert" />    
                                <input type="checkbox" data-toggle="toggle" data-on="روشن" data-off="خاموش" data-onstyle="warning" data-offstyle="info" id="cooling1">
                                <input type="checkbox" data-toggle="toggle" data-on="تند" data-off="کند" data-onstyle="danger" data-offstyle="success" id="cooling1_state">
				                <script>
                                    var cooling1 = $('#cooling1');
                                    var cooling1_state = $('#cooling1_state'); 
                                    $(function() {
                                        $('#cooling1').change(function() {
                                            if(!cooling1.prop('checked'))
                                            {
                                                cooling1_state.bootstrapToggle('enable');
                                                //alert(123);
                                            }
                                            else
                                            {
                                                cooling1_state.bootstrapToggle('disable');
                                                //alert(543);
                                            }
                                            
                                        })
                                    })
                                </script>
			</div>
                        </div>
                </div>

                <div class="list-group-item" href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="fe-icon-shopping-bag mr-1 text-muted"></i>
                                <div class="d-inline-block font-weight-medium text-uppercase">
                                <img src="img/cooling2.png" width="32" height="32">
                                کولر هال</div>
                            </div>
                            <div class="example">
                                <img src="img/alert.png" style="display:none;" id="cooling2_alert" />
                                <input type="checkbox" data-toggle="toggle" data-on="روشن" data-off="خاموش" data-onstyle="warning" data-offstyle="info" id="cooling2">
                                <input type="checkbox" data-toggle="toggle" data-on="تند" data-off="کند" data-onstyle="danger" data-offstyle="success" id="cooling2_state">

                                <input type="checkbox" id="" style="display:none"/>
                                <label for="cbx" class="toggle">
                                    <span>
                                    <svg width="10px" height="10px" viewBox="0 0 10 10">
                                        <path d="M5,1 L5,1 C2.790861,1 1,2.790861 1,5 L1,5 C1,7.209139 2.790861,9 5,9 L5,9 C7.209139,9 9,7.209139 9,5 L9,5 C9,2.790861 7.209139,1 5,1 L5,9 L5,1 Z"></path>
                                    </svg>
                                    </span>
                                </label>   

				                <script>
                                    var cooling2 = $('#cbx');
                                    var cooling2_state = $('#cooling2_state');
                                    $(function() {
                                        $('#cbx').change(function() {
                                            if(!cooling2.prop('checked'))
                                            {
                                                cooling2_state.bootstrapToggle('enable');
                                                alert(123);
                                            }
                                            else
                                            {
                                                cooling2_state.bootstrapToggle('disable');
                                                alert(543);
                                            }
                                            
                                        })
                                    })
                                </script>
			                </div>
                        </div>
                </div>

                


                <div class="list-group-item" href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="fe-icon-shopping-bag mr-1 text-muted"></i>
                                <div class="d-inline-block font-weight-medium text-uppercase">
                                <img src="img/light1.png" width="32" height="32">
                                چراغ سالن اصلی یک</div>
                            </div>
                            <div class="example">
                                <img src="img/alert.png" style="display:none;" id="light1_alert" />
                                <input type="checkbox" data-toggle="toggle" data-on="خاموش" data-off="روشن" data-onstyle="info" data-offstyle="warning" id="light1">
                                <input type="checkbox" data-toggle="toggle" data-on="زیاد" data-off="کم" data-onstyle="danger" data-offstyle="success" id="light1_state">
				                <script>
                                    var light1 = $('#light1');
                                    var light1_state = $('#light1_state');

                                    light1_state.bootstrapToggle('disable');
                                    light1.bootstrapToggle('on');
                                    
                                    
                                    $(function() {
                                        $('#light1').change(function() {
                                            if(!light1.prop('checked'))
                                            {
                                                light1_state.bootstrapToggle('enable');
                                                alert(123);
                                            }
                                            else
                                            {
                                                light1_state.bootstrapToggle('disable');
                                                alert(543);
                                            }
                                            
                                        })
                                    })
                                </script>
			                </div>
                        </div>
                </div>




                <div class="list-group-item" href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="fe-icon-shopping-bag mr-1 text-muted"></i>
                                <div class="d-inline-block font-weight-medium text-uppercase">
                                <img src="img/light2.png" width="32" height="32">
                                چراغ سالن اصلی دو</div>
                            </div>
                            <div class="example">
                                <img src="img/alert.png" style="display:none;" id="light2_alert" />
                                <input type="checkbox" data-toggle="toggle" data-on="خاموش" data-off="روشن" data-onstyle="info" data-offstyle="warning" id="light2">
                                <input type="checkbox" data-toggle="toggle" data-on="زیاد" data-off="کم" data-onstyle="danger" data-offstyle="success" id="light2_state">
				                <script>
                                    var light2 = $('#light2');
                                    var light2_state = $('#light2_state');

                                    light2_state.bootstrapToggle('disable');
                                    light2.bootstrapToggle('on');
                                    
                                    
                                    $(function() {
                                        $('#light2').change(function() {
                                            if(!light2.prop('checked'))
                                            {
                                                light2_state.bootstrapToggle('enable');
                                                alert(123);
                                            }
                                            else
                                            {
                                                light2_state.bootstrapToggle('disable');
                                                alert(543);
                                            }
                                            
                                        })
                                    })
                                </script>
			                </div>
                        </div>
                </div>





                <div class="list-group-item" href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="fe-icon-shopping-bag mr-1 text-muted"></i>
                                <div class="d-inline-block font-weight-medium text-uppercase">
                                <img src="img/light3.png" width="32" height="32">
                                چراغ هال</div>
                            </div>
                            <div class="example">
                                <img src="img/alert.png" style="display:none;" id="light3_alert" />
                                <input type="checkbox" data-toggle="toggle" data-on="خاموش" data-off="روشن" data-onstyle="info" data-offstyle="warning" id="light3">
                                <input type="checkbox" data-toggle="toggle" data-on="زیاد" data-off="کم" data-onstyle="danger" data-offstyle="success" id="light3_state">
				                <script>
                                    var light3 = $('#light3');
                                    var light3_state = $('#light3_state');

                                    light3_state.bootstrapToggle('disable');
                                    light3.bootstrapToggle('on');
                                    
                                    
                                    $(function() {
                                        $('#light3').change(function() {
                                            if(!light3.prop('checked'))
                                            {
                                                light3_state.bootstrapToggle('enable');
                                                alert(123);
                                            }
                                            else
                                            {
                                                light3_state.bootstrapToggle('disable');
                                                alert(543);
                                            }
                                            
                                        })
                                    })
                                </script>
			                </div>
                        </div>
                </div>



                <div class="list-group-item" href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="fe-icon-shopping-bag mr-1 text-muted"></i>
                                <div class="d-inline-block font-weight-medium text-uppercase">
                                <img src="img/water.png" width="32" height="32">
                                سیستم آبیاری</div>
                            </div>
                            <div class="example">
                                <img src="img/alert.png" style="display:none;" id="light1_alert" />
                                <input type="checkbox" data-toggle="toggle" data-on="غیرفعال" data-off="فعال" data-onstyle="danger" data-offstyle="success" id="water">
				                <script>
                                    var water = $('#water');
                                    water.bootstrapToggle('disable');
                                    
                                    $(function() {
                                        //$('#cooling2').change(function() {
                                          //  if(!cooling2.prop('checked'))
                                            
                                        //})
                                    })
                                </script>
			                </div>
                        </div>
                </div>
                   
                </nav>
            </div>
        </div>
    </div>
</div>

<script src="http://netdna.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>
</html>