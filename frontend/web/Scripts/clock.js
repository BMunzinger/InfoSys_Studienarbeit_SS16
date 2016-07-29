function updateClock ( )
 	{
 	var currentTime = new Date ( );
  	var currentHours = currentTime.getHours ( );
  	var currentMinutes = currentTime.getMinutes ( );
  	var currentSeconds = currentTime.getSeconds ( );

  	// Pad the minutes and seconds with leading zeros, if required
  	currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
  	currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
        currentHours = (currentHours < 10 ? "0" : "") + currentHours;

  	// Compose the string for display
  	var currentTimeString = currentHours + ":" + currentMinutes;
        //+ ":" + currentSeconds;
  	
  	
   	$(".clock").html(currentTimeString);
        //var test = $(".clock").text();
        //alert(test);  	  	
 }
 
 var idleTime = 0;

function timerIncrement() {
    idleTime = idleTime + 1;
    console.log("idleTime+1: "+ idleTime);
    if (idleTime > 59) { // 1 minute
        if(window.location.href.substr(window.location.href.lastIndexOf("/index.php")) !== "/index.php")
            window.location.href = '/index.php';
    }
}
     
 $(document).ready(function(){
     setInterval('updateClock()', 1000);
     
    //Increment the idle time counter every minute.
    var idleInterval = setInterval(timerIncrement, 10000); // 10 seconds

    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        console.log("Mouse");
        idleTime = 0;
    });
    $(this).keypress(function (e) {
        console.log("Key");
        idleTime = 0;
    });
});