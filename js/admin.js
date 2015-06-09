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
		FrameBox('post.php?id=' + url);
		return false;
	});
	$("#postisbn").click(function(){
		var isbn = $("#isbn").val();
		FrameBox('post.php?isbn=' + isbn);
		return false;
	});
});