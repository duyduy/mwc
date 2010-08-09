function showSlidingDiv(){
        //if($("#tell-a-friend").css("display") != "none") 
            $("#tell-a-friend-child").hide();
        $("#tell-a-friend").animate({"width": "toggle"}, { duration: 1000,
                                                        complete: function() {
                                                              $("#tell-a-friend-child").fadeIn("fast");
                                                        }
         });        
}
function showSlidingDiv1(){
        if($("#slidingDiv_child1").css("display") != "none") $("#slidingDiv_child1").css("display","none");
        $("#slidingDiv1").animate({"width": "toggle"}, { duration: 1000,
                                                        complete: function() {
                                                              $("#slidingDiv_child1").fadeIn("fast");
                                                        }
         });    
}
function showSlidingDiv2(){
        if($("#slidingDiv_child2").css("display") != "none") $("#slidingDiv_child2").css("display","none");
        $("#slidingDiv2").animate({"width": "toggle"}, { duration: 1000,
                                                        complete: function() {
                                                              $("#slidingDiv_child2").fadeIn("fast");
                                                        }
         });    
}
function bind_tabs_click(){
    $("#button-tell-a-friend-child").click(function(){
       if ($('#tell-a-friend-form').valid() == true)
            _extra_mwc_show_message('tell-a-friend-form');
       return false;
    });
    $("#button-newsletter-reg").click(function(){
        if ($('#newsletter-form').valid() == true)
            _extra_mwc_show_message('newsletter-form');
        return false;
    });
    $("#button-newsletter-not-reg").click(function(){
      if ($('#newsletter-form').valid() == true)
            _extra_mwc_show_message('newsletter-form');
       return false;
    });
}
function _extra_mwc_validate(){      
$("#tell-a-friend-form").validate({
            errorPlacement: function(error, element) {
                //element.hide();
            },
            showErrors:function(errorMap,errorList){},
            invalidHandler: function(form, validator) {
                var invalid = validator.errorMap;
                var count = 0;
                for(key in invalid) {
                 if (count ==0){
                         //
                        if (key =='desc'){
                           alert($("textarea[name='"+key+"']").prev().html().replace(/:/,'')+" skal udfyldes!");
                        }else{
                        
                          // alert($("input[name='"+key+"']").prev().html().replace(/:/,'')+" skal udfyldes!");   
                           alert ("Email skal udfyldes!");
                        }
                        
                 }
                 count++;
                }

            }                                                                                
        });
$("#newsletter-form").validate({
            errorPlacement: function(error, element) {
                //element.hide();
            },
            showErrors:function(errorMap,errorList){},
            invalidHandler: function(form, validator) {
                var invalid = validator.errorMap;
                var count = 0;
                for(key in invalid) {
                 if (count ==0){
                         //
                        if (key =='desc'){
                           alert($("textarea[name='"+key+"']").prev().html().replace(/:/,'')+" skal udfyldes!");
                        }else{
                        
                          // alert($("input[name='"+key+"']").prev().html().replace(/:/,'')+" skal udfyldes!");   
                           alert ("Email skal udfyldes!");
                        }
                        
                 }
                 count++;
                }

            }                                                                                
        });
}

function _extra_mwc_show_message(idForm){
     var options = {};  
    
    if (idForm ='tell-a-friend-form'){ 
        $('#tell-a-friend-child').hide('slide',options,1500,function(){
                $('#tell-a-friend-child').html('Loading ...').show('slide',options,1000,function(){
                    mwc_get_variable_and_sent_to_server_json('tell-a-friend-form'); 
                });    
        }); 
                       
    }
} 
function mwc_get_variable_and_sent_to_server_json(idForm){
    var data = {};
    var options = {}; 
    var html_message = 'Tak for din henvendelse! <br/>Vi vil kontakte dig hurtigst muligt <br/>Med venlig hilsen ';
    data.fields = $('#'+idForm).serializeArray();
    if (idForm =='tell-a-friend-form'){data.task = '3';}
    //if (idForm =='bestil-form') {data.task = '2';}
    Drupal.service('mwc.contact',data,function(status, data) {
           if(status == false) {
                  alert("Fatal error: could not load content");
           }
           else {
               
                    if (data.Task =='Tell-A-Friend'){ 
                        $('#tell-a-friend-child').hide('pulsate',options,500,function(){                          
                            $('#tell-a-friend-child').html(html_message).css('opacity',1).show('blind',options,1000);
                        })
                    }

              
           }
    });     
}
$(function(){
   bind_tabs_click();   
   _extra_mwc_validate()  ;  
});