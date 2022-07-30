$(document).ready(function(){

  var limit = 18; //The number of records to display per request
  var start = 0; //The starting pointer of the data
  var action = 'inactive'; //Check if current action is going on or not. If not then inactive otherwise active
    function load_country_data(limit, start) {
        $.ajax({
           url:"page-content.php",
           method:"POST",
           data:{limit:limit, start:start},
           cache:false,
           success:function(data)
           {
            $('#load_data').append(data);
              if(data == '') {
               $('#load_data_message').html("<h3 style='text-align:center'>End Loading</h3>");
               action = 'active';
              } else {
               $('#load_data_message').html("<h3 style='text-align:center'>Please Wait....</h3>");
               action = 'inactive';
              }
           }
        });
     }

    if(action == 'inactive') {
       action = 'active';
       load_country_data(limit, start);
    }

    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
      {
       action = 'active';
       start = start + limit;
       setTimeout(function(){
        load_country_data(limit, start);
       }, 500);
      }
     });

});