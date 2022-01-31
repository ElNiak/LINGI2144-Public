function convertPHP(){
    var path = window.location.pathname;
    if (!String.prototype.contains) {
        String.prototype.contains = function (s) {
            return this.indexOf(s) > -1;
        }
    }
    if (path.contains("manage")) {
        var brand = document.getElementsByClassName("navbar-brand");
        $(brand).attr("href","index.php");
    }
    if(path.contains("exercice/index.html")
        || path.contains("exercice/forstudent.html")) {
        $(function(){
            $('ul > li > a').each(function() {
                $(this).filter(':not([href="/index.html"])').filter(':not([href="/theory/index.html"])').filter(':not([href="/qcm/index.html"])').filter(':not([href="forstudent.html"])').attr('href', (n, old) => old.replace(".html",".php"));
            });
            $('.dropdown > a').each(function() {
                $(this).attr('href', (n, old) => old.replace(".html",".php"));
            });
        });
    }
}
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

//TODO hardcoded
function addButtonVerify(path) {
    if(path.contains("/qcm/forstudent") || path.contains("/qcm/index")) {
        var element = document.getElementById("checker").innerHTML = ''
    }
}

function convertTableOfContent(){
    var path = window.location.pathname;
    if (!String.prototype.contains) {
        String.prototype.contains = function (s) {
            return this.indexOf(s) > -1;
        }
    }
    if (path.contains("index.html")) {
        $(function(){
            $('.toctree-wrapper > ul').addClass("list-group");
        });
        $('.toctree-wrapper > ul > li').each(function() {
            $(this).addClass("list-group-item list-group-item-action").css("font-weight","bold");
        });
    }
}

function checkupdate(i) { //TODO  bugs
    var checkBox = document.getElementById(i);
    var parent = checkBox.parentNode;
    // Get the output text
    $(".toggle-group").click(function () {
        var checkBox = document.getElementById(i);
        var parent = checkBox.parentNode;
        // Get the output text
        // console.log(parent);
        // console.log(i);
        // console.log(i.concat("text"));
        if (parent.getAttribute("class") === "toggle btn btn-default off"){
            $("#".concat(i.concat("text"))).css("color","green");
            //texts.style.color = "blue";
        } else  {
            $("#".concat(i.concat("text"))).css("color","red");
            //texts.style.color = "red";
        }
    });
    if (checkBox.checked){
        //texts.style.color = "red";
        $("#".concat(i.concat("text"))).css("color","green");
    } else {
        //texts.style.color = "blue";
        $("#".concat(i.concat("text"))).css("color","red");
    }
}

function smoothScroll() {
    var bd = document.getElementsByTagName("body");
    $(bd).attr("data-spy", "scroll");
    $(bd).attr("data-target", "#sidebar #up");
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
    convertTableOfContent();
    smoothScroll();
    var path = window.location.pathname;
    addButtonVerify(path);
});