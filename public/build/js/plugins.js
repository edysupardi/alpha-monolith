//Common plugins
if (document.querySelectorAll("[toast-list]") || document.querySelectorAll('[data-choices]') || document.querySelectorAll("[data-provider]")) {
    document.writeln("<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/toastify-js'></script>");
    document.writeln("<script type='text/javascript' src='build/libs/choices.js/public/assets/scripts/choices.min.js'></script>");
    document.writeln("<script type='text/javascript' src='build/libs/flatpickr/flatpickr.min.js'></script>");
}

(function () {
	("use strict");

	/**
	 *  global variables
	 */
	var navbarMenuHTML = document.querySelector(".navbar-menu").innerHTML;
	var horizontalMenuSplit = 6; // after this number all horizontal menus will be moved in More menu options
	var default_lang = "en"; // set Default Language
	var language = localStorage.getItem("language");

    function windowLoadContent() {
        window.addEventListener("resize", windowResizeHover);
        windowResizeHover();

        document.addEventListener("scroll", function () {
            windowScroll();
        });

        window.addEventListener("load", function () {
            var isTwoColumn = document.documentElement.getAttribute("data-layout");
            if (isTwoColumn == "twocolumn") {
                initTwoColumnActiveMenu();
            } else {
                initActiveMenu();
            }
            isLoadBodyElement();
            addEventListenerOnSmHoverMenu();
        });
        if(document.getElementById("topnav-hamburger-icon")){
        document.getElementById("topnav-hamburger-icon").addEventListener("click", toggleHamburgerMenu);
        }
        var isValues = sessionStorage.getItem("defaultAttribute");
        var defaultValues = JSON.parse(isValues);
        var windowSize = document.documentElement.clientWidth;

        if (defaultValues["data-layout"] == "twocolumn" && windowSize < 767) {
            Array.from(document.getElementById("two-column-menu").querySelectorAll("li")).forEach(function (item) {
                item.addEventListener("click", function (e) {
                    document.body.classList.remove("twocolumn-panel");
                });
            });
        }
    }

    function windowResizeHover() {
		var windowSize = document.documentElement.clientWidth;
		if (windowSize < 1025 && windowSize > 767) {
			document.body.classList.remove("twocolumn-panel");
			if (sessionStorage.getItem("data-layout") == "twocolumn") {
				document.documentElement.setAttribute("data-layout", "twocolumn");
				if (document.getElementById("customizer-layout03")) {
					document.getElementById("customizer-layout03").click();
				}
				twoColumnMenuGenerate();
				initTwoColumnActiveMenu();
				isCollapseMenu();
			}
			if (sessionStorage.getItem("data-layout") == "vertical") {
				document.documentElement.setAttribute("data-sidebar-size", "sm");
			}
			if(document.querySelector(".hamburger-icon")){
			document.querySelector(".hamburger-icon").classList.add("open");
		}
		} else if (windowSize >= 1025) {
			document.body.classList.remove("twocolumn-panel");
			if (sessionStorage.getItem("data-layout") == "twocolumn") {
				document.documentElement.setAttribute("data-layout", "twocolumn");
				if (document.getElementById("customizer-layout03")) {
					document.getElementById("customizer-layout03").click();
				}
				twoColumnMenuGenerate();
				initTwoColumnActiveMenu();
				isCollapseMenu();
			}
			if (sessionStorage.getItem("data-layout") == "vertical") {
				document.documentElement.setAttribute(
					"data-sidebar-size",
					sessionStorage.getItem("data-sidebar-size")
				);
			}
			if(document.querySelector(".hamburger-icon")){
			document.querySelector(".hamburger-icon").classList.remove("open");
			}
		} else if (windowSize <= 767) {
			document.body.classList.remove("vertical-sidebar-enable");
			document.body.classList.add("twocolumn-panel");
			if (sessionStorage.getItem("data-layout") == "twocolumn") {
				document.documentElement.setAttribute("data-layout", "vertical");
				hideShowLayoutOptions("vertical");
				isCollapseMenu();
			}
			if (sessionStorage.getItem("data-layout") != "horizontal") {
				document.documentElement.setAttribute("data-sidebar-size", "lg");
			}
			if(document.querySelector(".hamburger-icon")){
			document.querySelector(".hamburger-icon").classList.add("open");
		}
		}

		var isElement = document.querySelectorAll("#navbar-nav > li.nav-item");
		Array.from(isElement).forEach(function (item) {
			item.addEventListener("click", menuItem.bind(this), false);
			item.addEventListener("mouseover", menuItem.bind(this), false);
		});
	}

    function menuItem(e) {
		if (e.target && e.target.matches("a.nav-link span")) {
			if (elementInViewport(e.target.parentElement.nextElementSibling) == false) {
				e.target.parentElement.nextElementSibling.classList.add("dropdown-custom-right");
				e.target.parentElement.parentElement.parentElement.parentElement.classList.add("dropdown-custom-right");
				var eleChild = e.target.parentElement.nextElementSibling;
				Array.from(eleChild.querySelectorAll(".menu-dropdown")).forEach(function (item) {
					item.classList.add("dropdown-custom-right");
				});
			} else if (elementInViewport(e.target.parentElement.nextElementSibling) == true) {
				if (window.innerWidth >= 1848) {
					var elements = document.getElementsByClassName("dropdown-custom-right");
					while (elements.length > 0) {
						elements[0].classList.remove("dropdown-custom-right");
					}
				}
			}
		}

		if (e.target && e.target.matches("a.nav-link")) {
			if (elementInViewport(e.target.nextElementSibling) == false) {
				e.target.nextElementSibling.classList.add("dropdown-custom-right");
				e.target.parentElement.parentElement.parentElement.classList.add("dropdown-custom-right");
				var eleChild = e.target.nextElementSibling;
				Array.from(eleChild.querySelectorAll(".menu-dropdown")).forEach(function (item) {
					item.classList.add("dropdown-custom-right");
				});
			} else if (elementInViewport(e.target.nextElementSibling) == true) {
				if (window.innerWidth >= 1848) {
					var elements = document.getElementsByClassName("dropdown-custom-right");
					while (elements.length > 0) {
						elements[0].classList.remove("dropdown-custom-right");
					}
				}
			}
		}
	}

    function toggleHamburgerMenu() {
		var windowSize = document.documentElement.clientWidth;

		if (windowSize > 767)
			document.querySelector(".hamburger-icon").classList.toggle("open");

		//For collapse horizontal menu
		if (document.documentElement.getAttribute("data-layout") === "horizontal") {
			document.body.classList.contains("menu") ? document.body.classList.remove("menu") : document.body.classList.add("menu");
		}

		//For collapse vertical menu
		if (document.documentElement.getAttribute("data-layout") === "vertical") {
			if (windowSize < 1025 && windowSize > 767) {
				document.body.classList.remove("vertical-sidebar-enable");
				document.documentElement.getAttribute("data-sidebar-size") == "sm" ?
					document.documentElement.setAttribute("data-sidebar-size", "") :
					document.documentElement.setAttribute("data-sidebar-size", "sm");
			} else if (windowSize > 1025) {
				document.body.classList.remove("vertical-sidebar-enable");
				document.documentElement.getAttribute("data-sidebar-size") == "lg" ?
					document.documentElement.setAttribute("data-sidebar-size", "sm") :
					document.documentElement.setAttribute("data-sidebar-size", "lg");
			} else if (windowSize <= 767) {
				document.body.classList.add("vertical-sidebar-enable");
				document.documentElement.setAttribute("data-sidebar-size", "lg");
			}
		}

		//Two column menu
		if (document.documentElement.getAttribute("data-layout") == "twocolumn") {
			document.body.classList.contains("twocolumn-panel") ?
				document.body.classList.remove("twocolumn-panel") :
				document.body.classList.add("twocolumn-panel");
		}
	}

    // two-column sidebar active js
	function initActiveMenu() {
		var currentPath = location.pathname == "/" ? "index.html" : location.pathname.substring(1);
		currentPath = currentPath.substring(currentPath.lastIndexOf("/") + 1);
		if (currentPath) {
			// navbar-nav
			var a = document.getElementById("navbar-nav").querySelector('[href="' + currentPath + '"]');
			if (a) {
				a.classList.add("active");
				var parentCollapseDiv = a.closest(".collapse.menu-dropdown");
				if (parentCollapseDiv) {
					parentCollapseDiv.classList.add("show");
					parentCollapseDiv.parentElement.children[0].classList.add("active");
					parentCollapseDiv.parentElement.children[0].setAttribute("aria-expanded", "true");
					if (parentCollapseDiv.parentElement.closest(".collapse.menu-dropdown")) {
						parentCollapseDiv.parentElement.closest(".collapse").classList.add("show");
						if (parentCollapseDiv.parentElement.closest(".collapse").previousElementSibling)
							parentCollapseDiv.parentElement.closest(".collapse").previousElementSibling.classList.add("active");

						if (parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown")) {
							parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse").classList.add("show");
							if (parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling) {

								parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling.classList.add("active");
								if((document.documentElement.getAttribute("data-layout") == "horizontal") && parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.closest(".collapse")){
									parentCollapseDiv.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling.classList.add("active")
								}
							}
						}
					}
				}
			}
		}
	}

    function isLoadBodyElement() {
		var verticalOverlay = document.getElementsByClassName("vertical-overlay");
		if (verticalOverlay) {
			Array.from(verticalOverlay).forEach(function (element) {
				element.addEventListener("click", function () {
					document.body.classList.remove("vertical-sidebar-enable");
					if (sessionStorage.getItem("data-layout") == "twocolumn")
						document.body.classList.add("twocolumn-panel");
					else
						document.documentElement.setAttribute("data-sidebar-size", sessionStorage.getItem("data-sidebar-size"));
				});
			});
		}
	}

    // add listener Sidebar Hover icon on change layout from setting
	function addEventListenerOnSmHoverMenu() {
		document.getElementById("vertical-hover").addEventListener("click", function () {
			if (document.documentElement.getAttribute("data-sidebar-size") === "sm-hover") {
				document.documentElement.setAttribute("data-sidebar-size", "sm-hover-active");
			} else if (document.documentElement.getAttribute("data-sidebar-size") === "sm-hover-active") {
				document.documentElement.setAttribute("data-sidebar-size", "sm-hover");
			} else {
				document.documentElement.setAttribute("data-sidebar-size", "sm-hover");
			}
		});
	}

    function elementInViewport(el) {
		if (el) {
			var top = el.offsetTop;
			var left = el.offsetLeft;
			var width = el.offsetWidth;
			var height = el.offsetHeight;

			if (el.offsetParent) {
				while (el.offsetParent) {
					el = el.offsetParent;
					top += el.offsetTop;
					left += el.offsetLeft;
				}
			}
			return (
				top >= window.pageYOffset &&
				left >= window.pageXOffset &&
				top + height <= window.pageYOffset + window.innerHeight &&
				left + width <= window.pageXOffset + window.innerWidth
			);
		}
	}

    function init() {
        windowLoadContent();
    }

    init();
})();
