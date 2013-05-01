function is_parent() {
	$("li").each(function(){
		$(this).next().is("ul") ? $(this).addClass("parent") : $(this).removeClass("parent");
	});
}
var clicks = 0, timer, node, crumbs;
$(document).ready(function(){
	is_parent();

	$("li").on("dblclick", function(e) {
		e.preventDefault();
	});

	$("li").on("click", function(e) {
		clicks++;
		node = $(this);

		if(clicks === 1) {
			timer = setTimeout(function() {
				if(node.hasClass("parent")) node.toggleClass("closed");
				clicks = 0;
			}, 250);
		} else {
			clearTimeout(timer);
			from = node.closest("ul").prev("li").text();
			crumbs = from != "" ? from+" > "+node.text() : node.text();
			clicks = 0;

			$.fn.SimpleModal({
				width: "span5",
				model: 'modal-ajax',
				title: crumbs,
				param: {
					url: 'info.php',
					onRequestComplete: function() { },
					onRequestFailure: function() { }
				}
			}).showModal();
		}
	});
});