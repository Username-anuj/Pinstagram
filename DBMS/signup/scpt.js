var abc = 0;
$(document).ready(function() 
{
	$('body').on('change', '#file', function() 
	{
		if (this.files && this.files[0]) 
		{
			abc += 1;
			var z = abc - 1;
			var x = $(this).parent().find('#previewimg' + z).remove();

			$("#hehe").("<div id='abcd" + abc + "' class='abcd'><img id='previewimg" + abc + "' height='100' width='100' src=''/></div>");
			var reader = new FileReader();
			reader.onload = imageIsLoaded;
			reader.readAsDataURL(this.files[0]);
			$(this).hide();
			$("#abcd" + abc).append($("<img/>", {id: 'img',src: 'x-30465_960_720.png',alt: 'delete',height: '20',width: '20'}).click(function() 
			{
				$(this).parent().parent().remove();
			}));
		}
	});
	function imageIsLoaded(e) {
		$('#previewimg' + abc).attr('src', e.target.result);
	};
	$('#upload').click(function(e) {
		var name = $(":file").val();
	});
});