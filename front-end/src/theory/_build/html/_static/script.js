// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

function getVideo(path) {
    var vid = "../_static/video/";
    if (!String.prototype.contains) {
        String.prototype.contains = function (s) {
            return this.indexOf(s) > -1
        }
    }
    if (path.contains("/malware_analysisI/introduction.html")) {
        vid = vid + "10.html";
    } else if (path.contains("introduction.html")) {
        vid = vid + "1.html";
    } else if (path.contains("privilege.html")) {
        vid = vid + "2.html";
    } else if (path.contains("corruption.html")) {
        vid = vid + "3.html";
    } else if (path.contains("assembly.html")) {
        vid = vid + "4.html";
    } else if (path.contains("exploit1.html")) {
        vid = vid + "5.html";
    } else if (path.contains("complement.html")) {
        vid = vid + "6.html";
    } else if (path.contains("handmake.html")) {
        vid = vid + "7.html";
    } else if (path.contains("nonexec.html")) {
        vid = vid + "8.html";
    } else if (path.contains("format_string.html")) {
        vid = vid + "9.html";
    } else if (path.contains("analysis.html")) {
        vid = vid + "11.html";
    } else if (path.contains("packing.html")) {
        vid = vid + "12.html";
    }
    return vid;
}

function setModalImage() {
    //https://www.w3schools.com/howto/howto_css_modal_images.asp
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var images = $('.body').children('img').map(function(){
        return $(this).attr('src')
    }).get()
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");

    for (let i = 0; i < images.length; i++){
      let anImage = images[i]
      anImage.onclick = function(){
          modal.style.display = "block";
          modalImg.src = this.src;
          captionText.innerHTML = this.alt;
        }
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
}

function getSlide(path) {
    var zipfile = "../_static/slides/";
    if (!String.prototype.contains) {
        String.prototype.contains = function (s) {
            return this.indexOf(s) > -1
        }
    }
    if (path.contains("/malware_analysisI/introduction.html")) {
        zipfile = zipfile + "week10.zip";
    } else if (path.contains("introduction.html")) {
        zipfile = zipfile + "week1.zip";
    } else if (path.contains("privilege.html")) {
        zipfile = zipfile + "week2.zip";
    } else if (path.contains("corruption.html")) {
        zipfile = zipfile + "week3.zip";
    } else if (path.contains("assembly.html")) {
        zipfile = zipfile + "week4.zip";
    } else if (path.contains("exploit1.html")) {
        zipfile = zipfile + "week5.zip";
    } else if (path.contains("complement.html")) {
        zipfile = zipfile + "week6.zip";
    } else if (path.contains("handmake.html")) {
        zipfile = zipfile + "week7.zip";
    } else if (path.contains("nonexec.html")) {
        zipfile = zipfile + "week8.zip";
    } else if (path.contains("format_string.html")) {
        zipfile = zipfile + "week9.zip";
    } else if (path.contains("analysis.html")) {
        zipfile = zipfile + "week11.zip";
    } else if (path.contains("packing.html")) {
        zipfile = zipfile + "week11.zip";
    }

    if(zipfile !== "../_static/slides/") {
        $("#rar_tp").attr("action", zipfile);
    }
}


function setVideo(vid) {
    $("#video-view").load(vid);
    var $videoSrc;
    $videoSrc = $("#video").attr("src");
    console.log("button clicked " + $videoSrc);

    // when the modal is opened autoplay it
    $("#myModal").on("shown.bs.modal", function (e) {
        console.log("modal opened" + $videoSrc);
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
    console.log(first_Section)
    document.getElementById("up").setAttribute("href", "#" + first_Section);

    // Add smooth scrolling on all links inside the navbar
    $("#sidebar li a:not(#notUp),#up:not(#notUp)").on('click', function (event) {
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

$(document).ready(function() {
    // Gets the video src from the data-src on each button
    var path = window.location.pathname;
    var vid = getVideo(path);
    setVideo(vid);
    getSlide(path);
    smoothScroll();
    //setModalImage();
    $(".image-reference").attr("target","_blank");
});