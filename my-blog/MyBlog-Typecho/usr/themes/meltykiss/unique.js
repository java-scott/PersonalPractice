$(function () {
    $("#toTop").click(function(){
        var height = $(document).height() - $(window).height();
        if(height < 0){
            height = 0;
        }
        height *= 1.0;
        $("html,body").animate({"scrollTop":0},height);
	    return false;
    });
  
});
$(function(){
  $("h2 a").click(function(){
        $(this).text("正在死命加载中......");
    });
});
$(function () {
    /* ToolTip */
    $("a").each(function(b) {
        if (this.title) {
            var getTitle = this.title;
            var a = 30;
            $(this).mouseover(function(d) {
                this.title = "";
                $("body").append('<div id="ToolTip">' + getTitle + "</div>");
                $("#ToolTip").css({
                    'left': (d.pageX + a) + "px",
                    'top': d.pageY + "px",
                    'opacity': "0.8"
                }).show(250)
            }).mouseout(function() {
                this.title = getTitle;
                $("#ToolTip").remove();
            }).mousemove(function(d) {
                $("#ToolTip").css({
                    'left': (d.pageX + a) + "px",
                    'top': d.pageY + "px"
                })
            })
        }
    })
});
$(document).ready(function() {
	try {
		TagCanvas.Start('myCanvas','tags',{
                textFont: 'Microsoft Yahei,Arial,SimSun,sans-serif',
		textColour: '#2b5797',
		outlineColour: '#fff',
		reverse: true,
		wheelZoom: false,
		depth: 0.8,
		maxSpeed: 0.05
	});
	} catch(e) {
		// something went wrong, hide the canvas container
		// document.getElementById('myCanvasContainer').style.display = 'none';
	}
});