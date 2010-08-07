function showSlidingDiv(){
        if($("#slidingDiv_child").css("display") != "none") $("#slidingDiv_child").css("display","none");
        $("#slidingDiv").animate({"width": "toggle"}, { duration: 1000,
                                                        complete: function() {
                                                              $("#slidingDiv_child").fadeIn("fast");
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

