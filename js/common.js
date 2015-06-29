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
            case 'null':
                break;
            default: return true;
		}
		return false;
	});

    $("form").submit(function(){
        var bSubmit = true;
        $(".v_noempty").each(function(){
            if($(this).val() == "")
            {
                (new balloon(this, 1, "該項不能為空...", 20, 10, 5000, true)).Show();
                bSubmit = false;
            }
            return bSubmit;
        });
        return bSubmit;
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

balloon = function(element, id, message, left, top, timeout, scroll)
{
    // Init value
    this.timeout = -1;	// ms
    this.message = "";
    this.element = undefined;
    this.id = "";
    this.left = 0;
    this.top = 6;
    this.scroll = false;

    if(!isNaN(timeout) && timeout == timeout)	this.timeout = parseInt(timeout);
    this.message = message;
    this.element = element;
    this.id = id;
    if(!isNaN(left) && left == left) this.left = parseInt(left);
    if(!isNaN(top) && top == top) this.top = parseInt(top);
    if(scroll != null && scroll != undefined) this.scroll = scroll;
};


balloon.prototype = {

    constructor : balloon,

    _timeouter : -1,

    Show : function()
    {
        if(!this.element) return false;
        if(this.element.box)
            this.element.box.Remove(true);
        var balloon = document.createElement("div");
        balloon.className = "balloon";
        balloon.id = "balloon_" + this.id;
        var balloon_top = document.createElement("div");
        balloon_top.className = "balloon_top";
        var balloon_meg = document.createElement("div");
        balloon_meg.className = "balloon_msg";
        var balloon_txt = document.createElement("div");
        balloon_txt.className = "balloon_txt";
        var megs=document.createTextNode(this.message);

        balloon.appendChild(balloon_top);
        balloon.appendChild(balloon_meg);
        balloon_meg.appendChild(balloon_txt);
        balloon_txt.appendChild(megs);
        this.element.box = this;

        this.element.parentNode.appendChild(balloon);

        var node_view = document.getElementView(this.element);
        var node_top = document.getElementTop(this.element);
        var node_left = document.getElementLeft(this.element);

        if(this.scroll){
            var timer = setInterval(function(){
                var top =  node_top - 30 - document.getScrollXY().top;
                var left = node_left - 30 - document.getScrollXY().left;
                if(Math.abs(top) < 5 || Math.abs(left) < 5)
                {
                    clearInterval(timer);
                }
                else
                {
                    top = document.getScrollXY().top + top / 5.0;
                    left = document.getScrollXY().left + left / 5.0;
                    scrollTo(left, top);
                }
            }, 10);
        }

        if(document.GetCurrentStyle(this.element.parentNode, "position") == "relative")
            node_top = node_left = 0;
        balloon.style.top = (node_top + node_view.height + this.top) + "px";
        balloon.style.left = (node_left + this.left) + "px";

        if(this.timeout > 0)
        {
            var ball = this;
            this._timeouter = setTimeout(function(){
                ball.Remove();
            }, this.timeout);
        }

        return true;
    },

    Remove : function(unanimated)
    {
        var id = this.id;
        var node = document.getElementById("balloon_" + id);
        if(node && unanimated)
        {
            node.parentNode.removeChild(node);
            if(this._timeouter > 0) clearTimeout(this._timeouter);
            return true;
        }
        if(node)
        {
            var h = document.getElementView(node.getElementsByTagName("div")[1]).height * 1.00;
            var w = document.getElementView(node.getElementsByTagName("div")[1]).width * 1.00;
            var timer = setInterval(function(){
                var n = node;
                h = h - 1;
                w = w - 1;
                if(h > 0)node.getElementsByTagName("div")[1].style.height = h + "px";
                if(w > 0)node.getElementsByTagName("div")[1].style.width = w + "px";
                if(h <= 0 || w <= 0) {node.parentNode.removeChild(node);clearInterval(timer);}
            }, 10);
            return true;
        }
        return false;
    },

    toString : function(){ return this.id + ", " + this.message; }
};

document.getElementView = function (element)
{
    if(element != document)
        return {
            width: element.offsetWidth,
            height: element.offsetHeight
        };
    if (document.compatMode == "BackCompat"){
        return {
            width: document.body.clientWidth,
            height: document.body.clientHeight
        };
    } else {
        return {
            width: document.documentElement.clientWidth,
            height: document.documentElement.clientHeight
        };
    }
};

/* ---------------------------------------------------------------
 * 獲取元素水平座標位置
 * -------------------------------------------------------------- */
document.getElementLeft = function (element)
{
    var actualLeft = element.offsetLeft;
    var current = element.offsetParent;
    while (current !== null){
        actualLeft += current.offsetLeft;
        current = current.offsetParent;
    }
    return actualLeft;
};

/* ---------------------------------------------------------------
 * 獲取元素垂直座標位置
 * -------------------------------------------------------------- */
document.getElementTop = function (element)
{
    var actualTop = element.offsetTop;
    var current = element.offsetParent;
    while (current !== null){
        actualTop += current.offsetTop;
        current = current.offsetParent;
    }
    return actualTop;
};

/* ---------------------------------------------------------------
 * 獲取頁面當前滾動到的位置
 * -------------------------------------------------------------- */
document.getScrollXY = function()
{
    var scrOfX = 0, scrOfY = 0;
    if(typeof( window.pageYOffset ) == 'number' ) {
        //Netscape compliant
        scrOfY = window.pageYOffset;
        scrOfX = window.pageXOffset;
    } else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
        //DOM compliant
        scrOfY = document.body.scrollTop;
        scrOfX = document.body.scrollLeft;
    } else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {
        //IE6 standards compliant mode
        scrOfY = document.documentElement.scrollTop;
        scrOfX = document.documentElement.scrollLeft;
    }
    return {top:scrOfY, left:scrOfX};
};

/* ---------------------------------------------------------------
 * 獲取元素的當前指定樣式
 * -------------------------------------------------------------- */
document.GetCurrentStyle = function(element, prop) {
    if (element.currentStyle) { //IE浏览器
        return element.currentStyle[prop];
    } else if (window.getComputedStyle) { //W3C标准浏览器
        prop = prop.replace(/([A-Z])/g, "-$1");
        prop = prop.toLowerCase();
        return document.defaultView.getComputedStyle(element, null)[prop];
    }
    return null;
};

/* ---------------------------------------------------------------
 * 通過指定html元素ID查找html元素對象
 * 示例：$id("tbl_selected")返回表格ID為tbl_selected的對象
 * -------------------------------------------------------------- */
$id = function (id, element)
{
    return (element || document).getElementById(id);
};

/* ---------------------------------------------------------------
 * 通過指定html元素name查找html元素對象數組
 * 示例：$name("rbl_Type")返回name為rbl_Type的所有單選框對象
 * -------------------------------------------------------------- */
$name = function (name, element)
{
    return (element || document).getElementsByName(name);
};

/* ---------------------------------------------------------------
 * 通過指定html元素tag名, 返回html元素對象數組
 * 示例：$tag("table")返回所有表格元素對象數組
 * -------------------------------------------------------------- */
$tag = function (tag, element)
{
    return (element || document).getElementsByTagName(tag);
};

/* ---------------------------------------------------------------
 * 通過指定html元素class名, 返回html元素對象數組
 * 示例：$tag("table")返回所有表格元素對象數組
 * -------------------------------------------------------------- */
$className = function(className, element){
    if(document.getElementsByClassName)
        return (element || document).getElementsByClassName(className);
    var children = (element || document).getElementsByTagName('*');
    var elements = [];
    for (var i = 0; i < children.length; i++){
        var child = children[i];
        var classNames = child.className.split(' ');
        for (var j = 0; j<classNames.length; j++){
            if (classNames[j] == className){
                child.dataset = getDataset(child.attributes);
                elements.push(child);
                break;
            }
        }
    }
    return elements;
};

/* ---------------------------------------------------------------
 * 通過指定html元素，获取元素是否可见
 * -------------------------------------------------------------- */
$isVisiable = function(element){
    var display = document.GetCurrentStyle(element, "display");
    var visibility = document.GetCurrentStyle(element, "visibility");
    var view = document.getElementView(element);
    return display != "none" && visibility != "hidden" && view.width * view.height > 0;
};

/* ---------------------------------------------------------------
 * 通過指定html元素，获取元素是否可被使用者操作，用于表单验证。
 * -------------------------------------------------------------- */
$isEnable = function(element){
    var bEnable = true;
    if(element.nodeName.toUpperCase() == "INPUT")
    {
        bEnable = bEnable && !element.disabled;
        if(element.type.toUpperCase() == "TEXT")
        {
            bEnable = bEnable && !element.readOnly;
        }
    }
    return bEnable && $isVisiable(element);
};