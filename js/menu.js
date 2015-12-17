$("#toggle").click(function(event)
	{event.preventDefault(),
		$(this).find(".top").toggleClass("active"),
	$(this).find(".middle").toggleClass("active"),
	$(this).find(".bottom").toggleClass("active"),
	$("#overlay").toggleClass("open")});

$('#maker1').click(function() {

   $("#toggle").find(".top").removeClass("active"),
	$("#toggle").find(".middle").removeClass("active"),
	$("#toggle").find(".bottom").removeClass("active"),
   $('#overlay').removeClass('open');
   
  
  });

$('#timer1').click(function() {

   $("#toggle").find(".top").removeClass("active"),
	$("#toggle").find(".middle").removeClass("active"),
	$("#toggle").find(".bottom").removeClass("active"),
   $('#overlay').removeClass('open');
   
  
  });