$(".icon-get .boxicons-icons .fonticon-container").click(function() {
  	$('.setIcono').val($(this).find('i').attr('class'));
  	$('#view-icon').removeClass().addClass($(this).find('i').attr('class'));
});
