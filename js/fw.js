function create_progress(progress) {
	percent = $(progress).attr("data-percent");
	degree = (percent/100)*180-90+"deg";

	circle = '<div class="circle">';
	circle+= '<div class="percent"></div>';
	circle+= '<div class="hole"></div>';
	circle+= '<div class="bg"></div>';
	circle+= '<div class="clip"><div class="fill primary"></div></div></div>';

	bar = '<div class="bar rounded"><div class="percent primary"></div><div class="fill primary"></div></div>';

	$(progress).append(circle,bar);
	
}

function create_carousel(carousel) {
	width = $(carousel).attr("class").match(/span([0-9]+)/i);
	$(carousel).find("li").addClass("span"+width[1]);

	i = $(carousel).find("li").length;
	$(carousel).children("ul").width(i+"00%").css("left", "-100%");
	$(carousel).find("li").eq(0).addClass("active");
	$(carousel).find("li:last").detach().prependTo($(carousel).children("ul"));

	$(carousel).append('<div class="dir n span2"></div><div class="dir p span2"></div>')
}

function check_val(input) {
	$(input).val() != "" ? $(input).addClass("has_value") : $(input).removeClass("has_value");
}

$(document).ready(function(){
	$(".menu").click(function(){
		$(this).find("ul").toggleClass("show");
	});

	$(".menu ul").click(function(e){
		e.stopPropagation();
	});
	

	$("select").each(function(){
		check_val(this);
	});
	
	$("select").on("keyup click blur focus change paste", function(){
		check_val(this);
	});

	$(".carousel").each(function(){
		create_carousel(this);
	});

	$(".carousel").on("click",".dir", function(){
		dir = $(this).hasClass("p") ? "+" : "-";

		carousel = $(this).siblings("ul");
		$(this).siblings("ul").animate({"left": dir+"=100%"}, {queue: true, duration: 500, complete: function(){
			if(dir == "+"){
				$(carousel).find("li:first").before($(carousel).find("li:last"));
			} else {
				$(carousel).find("li:last").after($(carousel).find("li:first"));
			}

			$(carousel).find(".active").removeClass("active");
			$(carousel).find("li:nth-child(2)").addClass("active");
			$(carousel).css("left", "-100%");
		}});
	});

	$(".progress").each(function(){
		create_progress(this);

		$(this).find(".circle .fill").css({
            '-webkit-transform': 'rotate('+degree+')',
            '-moz-transform': 'rotate('+degree+')',
            'transform': 'rotate('+degree+')'
        });

        $(this).find(".bar .fill").css({
	        width: percent+"%"
        });

        $(this).find(".percent").html(percent+"<span>%</span>");
	});
});