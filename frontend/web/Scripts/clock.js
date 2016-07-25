function updateClock ( )
 	{
 	var currentTime = new Date ( );
  	var currentHours = currentTime.getHours ( );
  	var currentMinutes = currentTime.getMinutes ( );
  	var currentSeconds = currentTime.getSeconds ( );

  	// Pad the minutes and seconds with leading zeros, if required
  	currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
//  	currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
        currentHours = (currentHours < 10 ? "0" : "") + currentHours;

  	// Compose the string for display
//  	var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds;
        var currentTimeString = currentHours + ":" + currentMinutes;
  	
  	
   	$(".clock").html(currentTimeString);
        //var test = $(".clock").text();
        //alert(test);  	  	
 }
 
 $(document).ready(function(){
     setInterval('updateClock()', 1000);
 });

