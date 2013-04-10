function is_parent() {
	$("li").each(function(){
		$(this).next().is("ul") ? $(this).addClass("parent") : $(this).removeClass("parent");
	});
}
var clicks = 0, timer, node;
$(document).ready(function(){
	is_parent();

	$("li").on("dblclick", function(e) {
		e.preventDefault();
	});

	$("li").on("click", function() {
		clicks++;
		node = $(this);

		if(clicks === 1) {
			timer = setTimeout(function() {
				if(node.hasClass("parent")) node.toggleClass("closed");
				clicks = 0;
			}, 250);
		} else {
			clearTimeout(timer);
			alert(node);
			clicks = 0;
		}
	});
});