$(document).ready(function(){

load_defaults();

$("#jqunlock").click(unlock_user);

$('body').on('click','.jqcellcolor',lit_the_cell);


setInterval(show_timer, 1000);

});

function load_defaults(){
    console.log("going to call");
    var params = {};
    $.ajax({
            url : base_url+'index.php/dashboard/get_default_values/',
          data  : params,
      dataType  : "json",
           type : "post",
       beforeSend : function(){},
       complete  : function(){},
        success  : function(data){
           // alert(data); return false;
            var lock = data.Lock;
            var user_id  = data.UserId;
            var cur_user = data.CurrentUser;
            var cells    = data.Cells;
            $(".jq_light_box_container").html(cells);
            if((user_id != cur_user) && (lock == 1)){
                $("body").prepend("<div class='disable'></div>");
                return false;
            }else if((user_id == cur_user) && (lock == 1)){
                $("#jq_timecount").show();
                 return false;
            }else if((user_id != cur_user) && (lock == 0)){
                $(".disable").remove();
                return false;
            }else if((user_id == cur_user) && (lock == 0)){
                $("#jq_timecount").show();
                 return false;
            }
        }

    });
 return false;
}
function unlock_user(){
   var params = {};
   $.ajax({
            url     : base_url+'index.php/dashboard/unlock_user/',
          data      : params,
      dataType      : "json",
           type     : "post",
       beforeSend   : function(){},
       complete     : function(){},
        success     : function(data){
                    var result  = data.Result;
                    if(result == 'success'){
                         $("#jq_timecount").show();
                         return false;
                    }
        }
   });
   return false;
}
function show_timer(){
    var params = {};
    $.ajax({
            url     : base_url+'index.php/dashboard/get_time/',
          data      : params,
      dataType      : "json",
           type     : "post",
       beforeSend   : function(){},
       complete     : function(){},
        success  : function(data){
            //alert(data); return false;
            var lock        = data.Lock;
            var user_id     = data.UserId;
            var cur_user_id = data.CurrentUser;
            var seconds     = data.Seconds;
            var result      = data.Result;
            var cells       = data.Cells;
            if(lock == 0){
                $("#jq_timecount").html('');
            }
            if((lock == 1) && (user_id != cur_user_id)){
                $(".jq_light_box_container").html(cells);
                if($(".disable").length == 0){
                    $("body").prepend("<div class='disable'></div>");
                    return false;
                }
            }
            if((lock == 0) && (user_id != cur_user_id)){
                $(".jq_light_box_container").html(cells);
                if($(".disable").length == 1){
                    $(".disable").remove();
                    return false;
                }
            }
            if((user_id == cur_user_id) && (lock == 1)){
                $("#jq_timecount").html(seconds);
                 return false;
            }else{
                return false;
            }
            
        }
   });
}
function lit_the_cell(){
    console.log("lit the cell");
    var current             = $(this);
    var current_item        = current.attr("id");
    var cell_info           = current_item.split('-');
    var cell_id             = cell_info[1];
    var params  = {'cellid' : cell_id};
    $.ajax({
               url : base_url+'index.php/dashboard/color_the_cell',
             data  : params,
              type : "post",
          dataType : "json",
      beforeSend   : function(){},
      complete     : function(){},
          success  : function(data){
              //alert(data); return false;
              var result  = data.Result;
              var message = data.Message;
              if(result == 'Success'){
                 var color = data.Color;
                 current.css('background-color', color);
                 return false;
              }else{
                  alert(message);
                  return false;
              }
          }
    });
    return false;
}