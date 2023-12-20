var page = 2;

jQuery(function ($) {
  $("body").on("click", ".projects__btn", function () {
    var data = {
      action: "load_posts_by_ajax",
      page: page,
      security: blog.security,
    };

    $.post(blog.ajaxurl, data, function (response) {
      if ($.trim(response) != "") {
        $(".projects__wrapper").append(response);
        page++;
      } else {
        $(".projects__btn").hide();
      }
    });
  });
});

// Logic Here || Important Stuff Here!

let scrollToTop = document.getElementById("up");

window.onscroll = function () {
  scroll();
};

function scroll() {
  if (
    document.body.scrollTop > 2000 ||
    document.documentElement.scrollTop > 2000
  ) {
    scrollToTop.classList.add("active");
  } else {
    scrollToTop.classList.remove("active");
  }
}
