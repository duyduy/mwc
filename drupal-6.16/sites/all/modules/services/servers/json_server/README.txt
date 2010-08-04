Do not use this version of json_server module with services-6.x-1.x branch.
More information here: http://drupal.org/node/663744

var data = new Object();
data.method = "node.get";
data.nid= 13;

var dataString = $.toJSON(data);
$.post("http://localhost/dev/mywebcreation/drupal-6.16/services/json",  {data: dataString},
 function(data){
   alert(data.name); // John
   console.log(data.time); //  2pm
 }, "json");
