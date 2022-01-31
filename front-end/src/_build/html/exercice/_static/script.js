function getVideo(path) {
    var vid = "../_static/video/intro_vid.html";
    if (!String.prototype.contains) {
        String.prototype.contains = function (s) {
            return this.indexOf(s) > -1
        }
    }
    if (path.contains("tp0")) {
        vid = "../_static/video/0.html";
    } else if (path.contains("tp1")) {
        vid = "../_static/video/1.html";
    } else if (path.contains("tp2")) {
        vid = "../_static/video/2.html";
    } else if (path.contains("tp3")) {
        vid = "../_static/video/3.html";
    } else if (path.contains("tp4")) {
        vid = "../_static/video/4.html";
    } else if (path.contains("tp5")) {
        vid = "../_static/video/5.html";
    } else if (path.contains("tp6")) {
        vid = "../_static/video/6.html";
    } else if (path.contains("tp7")) {
        vid = "../_static/video/7.html";
    } else if (path.contains("tp8")) {
        vid = "../_static/video/8.html";
    } else if (path.contains("tp9")) {
        vid = "../_static/video/9.html";
    }

    return vid;
}

function remove_tp_button() {
    $(document).ready(function() {
        if ($(".not_allowed")[0]){
            // Do something if class exists
            hideFiles();
        } else {
            // Do something if class does not exist
        }
    });
}

function updateSol(classe,dataTarget,parentId) {
    $(document).ready(function() {
        //console.log("test");
        //console.log("#" + parentId +" > .solution");
        $("#" + parentId +" > .solution").find('button').attr("data-target",dataTarget);
        $("#" + parentId +" > .solution").find('button').attr("aria-controls",classe);
        //console.log(.text());
    });
}

function hideSolution() {
    $(document).ready(function() {
        $(".sol-img").remove();
    });
}

function hideFiles() {
    $(document).ready(function() {
        $('.autorization').remove();
    });
}

function convertPHP(){
    var path = window.location.pathname;
    if (!String.prototype.contains) {
        String.prototype.contains = function (s) {
            return this.indexOf(s) > -1;
        }
    }
    $(function(){
        $('.dropdown-menu > li > a').each(function() {
            $(this).attr('href', (n, old) => old.replace(".html",".php"));
        });
    });
}

function getTPpdf(path) {

    var pdf = "../_static/dl/";
    
    //TODO automatize
    var fw  = "extra/heapoverflow";  //file_writer
    var fw2 = "extra/heapoverflow2"; //function pointer
    var fw3 = "extra/handmadeshellcode";  
    var fw4 = "extra/en-var"; 
    var fw5 = "extra/nfsshare";
    var fw6 = "extra/gdb"; 
    var fw7 = "extra/stackstethoscope";

    if (!String.prototype.contains) {
        String.prototype.contains = function (s) {
            return this.indexOf(s) > -1;
        }
    }

    if (path.contains("tp0")) {
        pdf = pdf + "tp0";
    } else if (path.contains("tp1")) {
        pdf = pdf + "tp1";
    } else if (path.contains("tp2")) {
        pdf = pdf + "tp2";
    } else if (path.contains("tp3")) {
        pdf = pdf + "tp3";
    } else if (path.contains("tp4")) {
        pdf = pdf + "tp4";
    } else if (path.contains("tp5")) {
        pdf = pdf + "tp5";
    } else if (path.contains("tp6")) {
        pdf = pdf + "tp6";
    } else if (path.contains("tp7")) {
        pdf = pdf + "tp7";
    } else if (path.contains("tp8")) {
        pdf = pdf + "tp8";
    } else if (path.contains("tp9")) {
        pdf = pdf + "tp9";
    } else if (path.contains(fw)) {
        pdf = pdf + fw;
        pdf = pdf + "/heapoverflow.zip"
        $("#pdf_tp").attr("action", pdf);
        return
    } else if (path.contains(fw2)) {
        pdf = pdf + fw2;
        pdf = pdf + "/heapoverflow2.zip"
        $("#pdf_tp").attr("action", pdf);
        return
    } else if (path.contains(fw3)) {
        pdf = pdf + fw3;
        pdf = pdf + "/shellcode.zip"
        $("#pdf_tp").attr("action", pdf);
        return
    } else if (path.contains(fw4)) {
        pdf = pdf + fw4;
        pdf = pdf + "/env-variable.zip"
        $("#pdf_tp").attr("action", pdf);
        return
    } else if (path.contains(fw5)) {
        pdf = pdf + fw5;
        pdf = pdf + "/nfsshare.zip"
        $("#pdf_tp").attr("action", pdf);
        return
    } else if (path.contains(fw6)) {
        pdf = pdf + fw6;
        pdf = pdf + "/LINGI2144_GDB.pdf"
        $("#pdf_tp").attr("action", pdf);
        return
    } else if (path.contains(fw7)) {
        pdf = pdf + fw7;
        pdf = pdf + "/LINGI2144_stackstethoscope.pdf"
        $("#pdf_tp").attr("action", pdf);
        return
    }

    if(pdf !== "../_static/dl/") {
        pdf = pdf + "/LINGI2144_TPs.pdf";
        $("#pdf_tp").attr("action", pdf);
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

function getTPzip(path) {
    //folder in _static/dl

    var fw  = "extra/heapoverflow";  //file_writer
    var fw2 = "extra/heapoverflow2"; //function pointer
    var fw3 = "extra/handmadeshellcode";  
    var fw4 = "extra/en-var"; 
    var fw5 = "extra/nfsshare"; 
    var fw6 = "extra/gdb"; 
    var fw7 = "extra/stackstethoscope"; 

    var pdf = "../_static/dl/";

    if (!String.prototype.contains) {
        String.prototype.contains = function (s) {
            return this.indexOf(s) > -1;
        }
    }

    if (path.contains("tp0")) {
        pdf = pdf + "tp0";
    } else if (path.contains("tp1")) {
        pdf = pdf + "tp1";
    } else if (path.contains("tp2")) {
        pdf = pdf + "tp2";
    } else if (path.contains("tp3")) {
        pdf = pdf + "tp3";
    } else if (path.contains("tp4")) {
        pdf = pdf + "tp4";
    } else if (path.contains("tp5")) {
        pdf = pdf + "tp5";
    } else if (path.contains("tp6")) {
        pdf = pdf + "tp6";
    } else if (path.contains("tp7")) {
        pdf = pdf + "tp7";
    } else if (path.contains("tp8")) {
        pdf = pdf + "tp8";
    } else if (path.contains("tp9")) {
        pdf = pdf + "tp9";
    } else if (path.contains(fw)) {
        pdf = pdf + fw;
        pdf = pdf + "/file_writer.tar.gz"
        $("#rar_tp").attr("action", pdf);
        return
    } else if (path.contains(fw2)) {
        pdf = pdf + fw2;
        pdf = pdf + "/function_pointer.tar.gz"
        $("#rar_tp").attr("action", pdf);
        return
    } else if (path.contains(fw3)) {
        pdf = pdf + fw3;
        pdf = pdf + "/helloworld1.zip"
        $("#rar_tp").attr("action", pdf);
        return
    } else if (path.contains(fw6)) {
        pdf = pdf + fw6;
        pdf = pdf + "/program.zip"
        $("#rar_tp").attr("action", pdf);
        return
    } else if (path.contains(fw7)) {
        pdf = pdf + fw7;
        pdf = pdf + "/stackstethoscope.zip"
        $("#rar_tp").attr("action", pdf);
        return
    }

    if(pdf !== "../_static/dl/") {
        pdf = pdf + "/files.zip"
        $("#rar_tp").attr("action", pdf);
    }
}

function setVideo(vid) {
    //https://codepen.io/JacobLett/pen/xqpEYE
    $("#video-view").load(vid);
    var $videoSrc;
    $videoSrc = $("#video").attr("src");
    //console.log("button clicked " + $videoSrc);

    // when the modal is opened autoplay it
    $("#myModal").on("shown.bs.modal", function (e) {
        //console.log("modal opened" + $videoSrc);
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
    convertPHP();
    var path = window.location.pathname;
    remove_tp_button();
    getTPpdf(path);
    getTPzip(path);
    var vid = getVideo(path)
    setVideo(vid);
    smoothScroll();
    $(".image-reference").attr("target","_blank");
});