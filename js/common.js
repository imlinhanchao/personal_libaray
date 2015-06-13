jQuery(document).ready(function($){
	$(".control_link").click(function(){
		var datas = this.href.split('#');
		if(datas.length != 2) return true;
		datas = datas[1].split('_');
		if(datas.length < 2) return true;
		var type = datas[0];
		var id = datas[1];
		switch(type)
		{
			case 'order':
				FrameBox('lend.php?t=-1&id=' + id, 300, 200);
				break;
			case 'lend':
				FrameBox('lend.php?t=1&id=' + id, 300, 200);
				break;
			case 'agree':
				FrameBox('lend.php?t=2&id=' + id, 300, 200);
				break;
            case 'read':
                RequestAjax('ajax.php?r='+id, function(obj){
                    if(obj < 1)
                    {
                        alert("网络超时，请稍后重试...");
                    }
                    else
                    {
                        location.reload();
                    }
                });
                break;
            case 'begin':
                RequestAjax('ajax.php?b='+id, function(obj){
                    if(obj < 1)
                    {
                        alert("网络超时，请稍后重试...");
                    }
                    else
                    {
                        location.reload();
                    }
                });
                break;
			case 'del':
				if(confirm("是否確認删除该书籍？"))
					RequestAjax('ajax.php?d='+id, function(obj){
                        if(obj < 1)
                        {
                            alert("网络超时，请稍后重试...");
                        }
                        else
                        {
                            location.reload();
                        }
					});
				break;
            case 'back':
                RequestAjax('ajax.php?k='+id, function(obj){
                    if(obj < 1)
                    {
                        alert("网络超时，请稍后重试...");
                    }
                    else
                    {
                        location.reload();
                    }
                });
				break;
			default: return true;
		}
		return false;
	});
});

function RequestAjax(url, fn)
{
    $.get(url, fn);
}

function FrameBox(link, w, h)
{
	if(!w) w = 800;
	if(!h) h = 400;
	$.fancybox.open({
		href : link,
		type : 'iframe',
		padding : 5,
		autoSize : false,
		width : w,
		height : h,
		scrolling : 'no'
	});
}

function updateStatus(book_Id)
{
    RequestAjax("ajax.php?s=" + book_Id, function(obj){
        // Update book status
    });
}