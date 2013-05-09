$(function() {
    $("ul.sortable").sortable({
        connectWith: ".sortable",
        placeholder: "placeholder",
        dropOnEmpty: true,
        cursor: "move",
        opacity: 0.7
    }).disableSelection();

});

function getObjID() {
    var json = new Array();
    var order = new Array();
    $("ul.sortable li").each(function(index) {
        var obj = {};
        var id = $(this).attr("id").split(/_/);
        obj.id = Number(id[1]);

        var parent = $(this).parent().parent().attr("id");

        if (parent == undefined) {
            console.log('parent', parent);
            obj.pid = 0;
        } else {
            parent = parent.split(/_/);
            obj.pid = Number(parent[1]);
        }
        if (order[obj.pid] == null) {
            order[obj.pid] = 0;
        }
        order[obj.pid]++;
        obj.order = order[obj.pid];
        json.push(obj);
    });
    return json;
}

function is_parent() {
    $("li").each(function() {
        $(this).next().is("ul") ? $(this).addClass("parent") : $(this).removeClass("parent");
    });
}

var clicks = 0, timer, node, crumbs;
$(document).ready(function() {
    is_parent();

    $("li").on("dblclick", function(e) {
        e.preventDefault();
    });

    $("li").on("click", function(e) {
        clicks++;
        node = $(this);

        if (clicks === 1) {
            timer = setTimeout(function() {
                if (node.hasClass("parent"))
                    node.toggleClass("closed");
                clicks = 0;
            }, 250);
        } else {
            clearTimeout(timer);
            from = node.closest("ul").prev("li").text();
            crumbs = from != "" ? from + " > " + node.text() : node.text();
            clicks = 0;

            $.fn.SimpleModal({
                width: "span5",
                model: 'modal-ajax',
                title: crumbs,
                param: {
                    url: 'info.php',
                    onRequestComplete: function() {
                    },
                    onRequestFailure: function() {
                    }
                }
            }).showModal();
        }
    });

    $("#save_btn").click(function() {
        $.ajax({
            type: "POST",
            url: "index.php",
            cache: false,
            dataType: "json",
            data: {
                obj: getObjID()
            },
            success: function(data) {
                alert(data.respond);
            }
        });
    });


});