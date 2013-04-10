function is_parent() {
	$("li").each(function(){
		$(this).next().is("ul") ? $(this).addClass("parent") : $(this).removeClass("parent");
	});
}
var clicks = 0, timer, node, active;
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
			    $.fn.SimpleModal({
			        btn_ok: 'Confirm button',
			        model: 'confirm',
			        callback: function(){
			            alert('Action confirm!');
			        },
			        title: 'Confirm Modal Title',
			        contents: 'Lorem ipsum dolor sit amet...'
			    }).addButton("fart", "btn").showModal();
			clicks = 0;
		}
	});
});