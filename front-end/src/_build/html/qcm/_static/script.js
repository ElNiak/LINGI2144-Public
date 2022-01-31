// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}




function getVideo(path) {
    var vid = "";
    if (!String.prototype.contains) {
        String.prototype.contains = function (s) {
            return this.indexOf(s) > -1
        }
    }
    if (path.contains("/malware_analysisI/introduction.html")) {
        vid = "../_static/video/10.html";
    } else if (path.contains("introduction.html")) {
        vid = "../_static/video/1.html";
    } else if (path.contains("privilege.html")) {
        vid = "../_static/video/2.html";
    } else if (path.contains("corruption.html")) {
        vid = "../_static/video/3.html";
    } else if (path.contains("assembly.html")) {
        vid = "../_static/video/4.html";
    } else if (path.contains("exploit1.html")) {
        vid = "../_static/video/5.html";
    } else if (path.contains("complement.html")) {
        vid = "../_static/video/6.html";
    } else if (path.contains("handmake.html")) {
        vid = "../_static/video/7.html";
    } else if (path.contains("nonexec.html")) {
        vid = "../_static/video/8.html";
    } else if (path.contains("format_string.html")) {
        vid = "../_static/video/9.html";
    } else if (path.contains("analysis.html")) {
        vid = "../_static/video/11.html";
    } else if (path.contains("packing.html")) {
        vid = "../_static/video/12.html";
    }
    return vid;
}

function setVideo(vid) {
    $("#video-view").load(vid);
    var $videoSrc;
    $videoSrc = $("#video").attr("src");
    //console.log("button clicked " + $videoSrc);
    // when the modal is opened autoplay it
    $("#myModal").on("shown.bs.modal", function (e) {
       // console.log("modal opened" + $videoSrc);
        // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
        $("#video").attr(
            "src",
            $videoSrc + "?amp;showinfo=0&amp;modestbranding=1&amp;autoplay=1"
        );
    });
    // stop playing the youtube video when I close the modal
    $("#myModal").on("hide.bs.modal", function (e) {
        // a poor man's stop video
        $("#video").attr("src", $videoSrc);
    });
}

function smoothScroll() {
    // Add scrollspy to <body>
    var bd = document.getElementsByTagName("body");
    $(bd).attr("data-spy", "scroll");
    $(bd).attr("data-target", "#sidebar");
    $(bd).attr("data-offset", "100");

    var first_Section = document.getElementsByClassName("section")[0].id
    //console.log(first_Section)
    let element =  document.getElementById("up")
    if(typeof(element) != 'undefined' && element != null) {
        element.setAttribute("href", "#" + first_Section);
        // Add smooth scrolling on all links inside the navbar
        $("#sidebar li a:not(#notUp), #up").on('click', function (event) {
            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();
                // Store hash
                var hash = this.hash;
                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top - 20
                }, 700, function () {
                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });
    }
}

$(document).ready(function() {
    // Gets the video src from the data-src on each button
    var path = window.location.pathname;
    var vid = getVideo(path);
    setVideo(vid);
    smoothScroll();
});