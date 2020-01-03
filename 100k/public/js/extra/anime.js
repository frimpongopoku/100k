$(document).ready(() => {
  //scroll into view smoothly
    $(document).on("click", 'a[href^="#"]', function(event) {
        event.preventDefault();
        $("html, body").animate(
            {
                scrollTop: $($.attr(this, "href")).offset().top
            },
            700
        );
    });
    setTimeout(() => {
        $("#main-div").animate({ opacity: 1 }, 600);
        animateBrandDiv();
        animateTrees();
        showAuthAnimations("login");
        showAuthAnimations("register");
        console.log("all done here");
    }, 1500);

    function animateBrandDiv() {
        setTimeout(() => {
            var box = $(".brand-div");
            box.animate({ opacity: 1, left: 0 }, 1200);
        }, 600);
    }

    function animateTrees() {
        setTimeout(() => {
            var treegroup = $(".tree-group");
            treegroup.animate({ opacity: 1 }, 700);
            for (let index = 0; index < 8; index++) {
                var name = ".tree-" + (index + 1);
                var tree = $(name);
                tree.animate({ opacity: 1, width: 300 }, 900 + index * 500);
            }
        }, 1500);
    }

    function showAuthAnimations(type) {
        setTimeout(() => {
            var login = $("." + type);
            var card = $("." + type + "-card");
            login.animate({ opacity: 1 }, 200);
            card.animate({ opacity: 1 }, 100);
            card.css({ transform: "scale(1)", transition: ".5s ease-in" });
        }, 100);
    }
});
