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
		FrameBox('./admin/post.php?id=' + url);
		return false;
	});
	$("#postisbn").click(function(){
		var isbn = $("#isbn").val();
		FrameBox('./admin/post.php?isbn=' + isbn);
		return false;
	});
	$(".searchItem").click(function(){
		var id = this.dataset.id;
		FrameBox('./admin/post.php?id=' + id);
		return false;
	});
});