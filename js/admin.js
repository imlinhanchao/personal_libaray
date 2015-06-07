jQuery(document).ready(function($){
	$("#postdouban").click(function(){
		var url = $("#dburl").val();
		if(url.indexOf('book.douban.com/subject/') < 0)
		{
			alert("非法Url!");
			return false;
		}
		var index = url.substr(0, url.length - 1).lastIndexOf('/') + 1;
		url = url.substr(index, url.length - index - 1);
		$.fancybox.open({
			href : 'post.php?id=' + url,
			type : 'iframe',
			padding : 5,
			autoSize : false,
			width : 800,
			height : 400,
			scrolling : 'no'
		});
		return false;
	});
	$("#postisbn").click(function(){
		var isbn = $("#isbn").val();
		$.fancybox.open({
			href : 'post.php?isbn=' + isbn,
			type : 'iframe',
			padding : 5,
			autoSize : false,
			width : 800,
			height : 400,
			scrolling : 'no'
		});
		return false;
	});
});