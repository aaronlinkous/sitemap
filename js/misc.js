function is_parent() {
	$("li").each(function(){
		$(this).next().is("ul") ? $(this).addClass("parent") : $(this).removeClass("parent");
	});
}

$(document).ready(function(){
	is_parent();

	$(".parent").on("click", function() {
		$(this).toggleClass("closed");
	});
});