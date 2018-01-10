$(document).ready(function() {
//     $.ajax({url: "cust_view_1.php", success: function(result){
//    }});
   //$(".add").click(alert("hello"));
  $("#search").click(function() {
    var keywords = $('#keyword').val();
    if(keywords != "") {
        
      $.ajax({
        url: "cust_view_1.php",
       data: {keywords : keywords},
        type:"POST",
        success: function(resp) {
            $(".resultDiv").html(resp);          
        }
      });
    }
  });
  
  
 
});

