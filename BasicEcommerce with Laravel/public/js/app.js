document.addEventListener("DOMContentLoaded", function () {
    const initSlider = () => {
        const slides = document.querySelectorAll(".hero-slide");
        let currentIndex = 0;
        const totalSlides = slides.length;

        function moveToSlide(n) {
            slides.forEach((slide, index) => {
                slide.style.transform = `translateX(${-100 * n}%)`;
                if (n === index) {
                    slide.classList.add("active");
                } else {
                    slide.classList.remove("active");
                }
            });
            currentIndex = n;
        }

        function nextSlide() {
            currentIndex =
                currentIndex === totalSlides - 1 ? 0 : currentIndex + 1;
            moveToSlide(currentIndex);
        }

        function prevSlide() {
            currentIndex =
                currentIndex === 0 ? totalSlides - 1 : currentIndex - 1;
            moveToSlide(currentIndex);
        }

        const nextBtn = document.querySelector(".hero-slide-next");
        const prevBtn = document.querySelector(".hero-slide-prev");
        if (nextBtn) nextBtn.addEventListener("click", nextSlide);
        if (prevBtn) prevBtn.addEventListener("click", prevSlide);

        moveToSlide(0);
    };

    const initImagePicker = () => {
        const fileInput = document.querySelector("#carFormImageUpload");
        const imagePreview = document.querySelector("#imagePreviews");
        if (!fileInput) return;

        fileInput.onchange = (ev) => {
            imagePreview.innerHTML = "";
            const files = ev.target.files;
            for (let file of files) {
                readFile(file).then((url) => {
                    const img = createImage(url);
                    imagePreview.append(img);
                });
            }
        };

        function readFile(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onload = (ev) => resolve(ev.target.result);
                reader.onerror = reject;
                reader.readAsDataURL(file);
            });
        }

        function createImage(url) {
            const a = document.createElement("a");
            a.classList.add("car-form-image-preview");
            a.innerHTML = `<img src="${url}" />`;
            return a;
        }
    };

    const initMobileNavbar = () => {
        const btnToggle = document.querySelector(".btn-navbar-toggle");
        if (!btnToggle) return;
        btnToggle.onclick = () => {
            document.body.classList.toggle("navbar-opened");
        };
    };

    const imageCarousel = () => {
        const carousel = document.querySelector(".car-images-carousel");
        if (!carousel) return;

        const thumbnails = document.querySelectorAll(
            ".car-image-thumbnails img"
        );
        const activeImage = document.getElementById("activeImage");
        const prevButton = document.getElementById("prevButton");
        const nextButton = document.getElementById("nextButton");

        let currentIndex = 0;

        thumbnails.forEach((thumbnail, index) => {
            if (thumbnail.src === activeImage.src) {
                thumbnail.classList.add("active-thumbnail");
                currentIndex = index;
            }
        });

        const updateActiveImage = (index) => {
            activeImage.src = thumbnails[index].src;
            thumbnails.forEach((t) => t.classList.remove("active-thumbnail"));
            thumbnails[index].classList.add("active-thumbnail");
        };

        thumbnails.forEach((thumbnail, index) => {
            thumbnail.addEventListener("click", () => {
                currentIndex = index;
                updateActiveImage(currentIndex);
            });
        });

        prevButton?.addEventListener("click", () => {
            currentIndex =
                (currentIndex - 1 + thumbnails.length) % thumbnails.length;
            updateActiveImage(currentIndex);
        });

        nextButton?.addEventListener("click", () => {
            currentIndex = (currentIndex + 1) % thumbnails.length;
            updateActiveImage(currentIndex);
        });
    };

    const initMobileFilters = () => {
        const filterButton = document.querySelector(".show-filters-button");
        const sidebar = document.querySelector(".search-cars-sidebar");
        const closeButton = document.querySelector(".close-filters-button");
        if (!filterButton || !sidebar) return;

        filterButton.addEventListener("click", () => {
            sidebar.classList.toggle("opened");
        });

        closeButton?.addEventListener("click", () => {
            sidebar.classList.remove("opened");
        });
    };

    const initCascadingDropdown = (parentSelector, childSelector) => {
        const parentDropdown = document.querySelector(parentSelector);
        const childDropdown = document.querySelector(childSelector);
        if (!parentDropdown || !childDropdown) return;

        hideModelOptions(parentDropdown.value);
        parentDropdown.addEventListener("change", (ev) => {
            hideModelOptions(ev.target.value);
            childDropdown.value = "";
        });

        function hideModelOptions(parentValue) {
            const models = childDropdown.querySelectorAll("option");
            models.forEach((model) => {
                if (
                    model.dataset.parent === parentValue ||
                    model.value === ""
                ) {
                    model.style.display = "block";
                } else {
                    model.style.display = "none";
                }
            });
        }
    };

    const initSortingDropdown = () => {
        const sortingDropdown = document.querySelector(".sort-dropdown");
        if (!sortingDropdown) return;

        const url = new URL(window.location.href);
        const sortValue = url.searchParams.get("sort");
        if (sortValue) sortingDropdown.value = sortValue;

        sortingDropdown.addEventListener("change", (ev) => {
            const url = new URL(window.location.href);
            url.searchParams.set("sort", ev.target.value);
            window.location.href = url.toString();
        });
    };

    // -------------------------------------------------
    // Favourite Toggle Logic (Fixed and Optimized)
    // -------------------------------------------------
    const initFavouriteButtons = () => {
        const meta = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = meta ? meta.getAttribute("content") : null;

        if (!csrfToken) {
            console.warn(
                "[favourite] No CSRF token found. AJAX will likely fail."
            );
        }
        const resolveCarId = (button) => {
            if (button && button.dataset && button.dataset.carId) {
                return button.dataset.carId;
            }
            if (
                button &&
                button.getAttribute &&
                button.getAttribute("data-car-id")
            ) {
                return button.getAttribute("data-car-id");
            }
            const ancestor =
                button && button.closest
                    ? button.closest("[data-car-id], .car-item[data-car-id]")
                    : null;
            if (ancestor) {
                return ancestor.dataset
                    ? ancestor.dataset.carId
                    : ancestor.getAttribute("data-car-id");
            }
            if (button && button.dataset && button.dataset.car)
                return button.dataset.car;
            if (button && button.getAttribute && button.getAttribute("data-id"))
                return button.getAttribute("data-id");
            return null;
        };

        document.addEventListener("click", async (ev) => {
            const btn = ev.target.closest && ev.target.closest(".btn-heart");
            if (!btn) return;

            ev.preventDefault();

            if (btn.dataset.favProcessing === "1") return;
            btn.dataset.favProcessing = "1";

            const carId = resolveCarId(btn);

            if (!carId) {
                console.warn(
                    "[favourite] Could not determine car id for button",
                    btn
                );
                btn.dataset.favProcessing = "0";
                return;
            }
            const url = `/car/${carId}/favourite`;

            try {
                const res = await fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": csrfToken || "",
                    },
                    body: JSON.stringify({}),
                });

                if (res.status === 401) {
                    window.location.href = "/login";
                    return;
                }

                const data = await res.json();
                if (!data || !data.success) {
                    throw new Error(
                        data?.message || "Unknown error toggling favourite"
                    );
                }

                // Visual update logic:
                const wasFav = btn.classList.contains("is-favourited");
                const svgs = btn.querySelectorAll("svg");
                if (svgs && svgs.length > 1) {
                    svgs.forEach((svg) => svg.classList.toggle("hidden"));
                } else {
                    if (data.status === "added") {
                        btn.classList.add("is-favourited");
                        const svg = btn.querySelector("svg");
                        if (svg) svg.setAttribute("fill", "orange");
                    } else {
                        btn.classList.remove("is-favourited");
                        const svg = btn.querySelector("svg");
                        if (svg) svg.setAttribute("fill", "none");
                    }
                }
                btn.setAttribute(
                    "aria-pressed",
                    data.status === "added" ? "true" : "false"
                );
                btn.style.color = data.status === "added" ? "orange" : "#999";
            } catch (err) {
                console.error("[favourite] Toggle failed:", err);
                alert("Could not update favourite status. Try again.");
            } finally {
                btn.dataset.favProcessing = "0";
            }
        });
    };
    initFavouriteButtons();

    initSlider();
    initImagePicker();
    initMobileNavbar();
    imageCarousel();
    initMobileFilters();
    initCascadingDropdown("#makerSelect", "#modelSelect");
    initCascadingDropdown("#stateSelect", "#citySelect");
    initSortingDropdown();
    initFavouriteButtons();

    ScrollReveal().reveal(".hero-slide.active .hero-slider-title", {
        delay: 200,
        reset: true,
    });
    ScrollReveal().reveal(".hero-slide.active .hero-slider-content", {
        delay: 200,
        origin: "bottom",
        distance: "50%",
    });
});
