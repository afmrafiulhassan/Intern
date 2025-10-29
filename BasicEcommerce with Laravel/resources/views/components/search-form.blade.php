<!-- Find a car form -->
<section class="find-a-car">
    <div class="container">
        <form action="{{ route('car.search') }}" method="GET" class="find-a-car-form card flex p-medium">
            <div class="find-a-car-inputs">
                <div>
                    <select id="makerSelect" name="maker_id">
                        <option value="">Maker</option>
                        <option value="1">Toyota</option>
                        <option value="2">Ford</option>
                        <option value="3">Honda</option>
                        <option value="4">Chevrolet</option>
                        <option value="5">Nissan</option>
                        <option value="6">Lexus</option>
                        <option value="7">BMW</option>
                        <option value="8">Mercedes-Benz</option>
                        <option value="9">Hyundai</option>
                        <option value="10">Kia</option>
                    </select>
                </div>
                <div>
                    <select id="modelSelect" name="model_id">
                        <option value="" style="display: block">Model</option>
                        <option value="1" data-parent="1" style="display: none">Camry</option>
                        <option value="2" data-parent="1" style="display: none">Corolla</option>
                        <option value="3" data-parent="1" style="display: none">Highlander</option>
                        <option value="4" data-parent="1" style="display: none">RAV4</option>
                        <option value="5" data-parent="1" style="display: none">Prius</option>
                        <option value="6" data-parent="1" style="display: none">4Runner</option>
                        <option value="7" data-parent="1" style="display: none">Tacoma</option>
                        <option value="8" data-parent="1" style="display: none">Tundra</option>
                        <option value="9" data-parent="2" style="display: none">F-150</option>
                        <option value="10" data-parent="2" style="display: none">Escape</option>
                        <option value="11" data-parent="2" style="display: none">Explorer</option>
                        <option value="12" data-parent="2" style="display: none">Mustang</option>
                        <option value="13" data-parent="2" style="display: none">Fusion</option>
                        <option value="14" data-parent="2" style="display: none">Ranger</option>
                        <option value="15" data-parent="2" style="display: none">Edge</option>
                        <option value="16" data-parent="2" style="display: none">Bronco</option>
                        <option value="17" data-parent="3" style="display: none">Civic</option>
                        <option value="18" data-parent="3" style="display: none">Accord</option>
                        <option value="19" data-parent="3" style="display: none">CR-V</option>
                        <option value="20" data-parent="3" style="display: none">Pilot</option>
                        <option value="21" data-parent="3" style="display: none">Odyssey</option>
                        <option value="22" data-parent="3" style="display: none">HR-V</option>
                        <option value="23" data-parent="3" style="display: none">Ridgeline</option>
                        <option value="24" data-parent="3" style="display: none">Passport</option>
                        <option value="25" data-parent="4" style="display: none">Silverado</option>
                    </select>
                </div>
                <div>
                    <select id="stateSelect" name="state_id">
                        <option value="">State/Region</option>
                        <option value="1">California</option>
                        <option value="2">Texas</option>
                        <option value="3">Florida</option>
                        <option value="4">New York</option>
                        <option value="5">Illinois</option>
                        <option value="6">Pennsylvania</option>
                        <option value="7">Ohio</option>
                        <option value="8">Georgia</option>
                        <option value="9">North Carolina</option>
                        <option value="10">Michigan</option>
                    </select>
                </div>
                <div>
                    <select id="citySelect" name="city_id">
                        <option value="" style="display: block">City</option>
                        <option value="1" data-parent="1" style="display: none">Los Angeles</option>
                        <option value="2" data-parent="1" style="display: none">San Francisco</option>
                        <option value="3" data-parent="1" style="display: none">San Diego</option>
                        <option value="4" data-parent="1" style="display: none">Sacramento</option>
                        <option value="5" data-parent="1" style="display: none">San Jose</option>
                        <option value="6" data-parent="2" style="display: none">Houston</option>
                        <option value="7" data-parent="2" style="display: none">San Antonio</option>
                        <option value="8" data-parent="2" style="display: none">Dallas</option>
                        <option value="9" data-parent="2" style="display: none">Austin</option>
                        <option value="10" data-parent="2" style="display: none">Fort Worth</option>
                        <option value="11" data-parent="3" style="display: none">Miami</option>
                        <option value="12" data-parent="3" style="display: none">Orlando</option>
                        <option value="13" data-parent="3" style="display: none">Tampa</option>
                        <option value="14" data-parent="3" style="display: none">Jacksonville</option>
                        <option value="15" data-parent="3" style="display: none">St. Petersburg</option>
                        <option value="16" data-parent="4" style="display: none">New York City</option>
                        <option value="17" data-parent="4" style="display: none">Buffalo</option>
                        <option value="18" data-parent="4" style="display: none">Rochester</option>
                        <option value="19" data-parent="4" style="display: none">Yonkers</option>
                        <option value="20" data-parent="4" style="display: none">Syracuse</option>
                        <option value="21" data-parent="5" style="display: none">Chicago</option>
                        <option value="22" data-parent="5" style="display: none">Aurora</option>
                        <option value="23" data-parent="5" style="display: none">Naperville</option>
                        <option value="24" data-parent="5" style="display: none">Joliet</option>
                        <option value="25" data-parent="5" style="display: none">Rockford</option>
                    </select>
                </div>
                <div>
                    <select name="car_type_id">
                        <option value="">Type</option>
                        <option value="1">Sedan</option>
                        <option value="2">Hatchback</option>
                        <option value="3">SUV</option>
                        <option value="4">Pickup Truck</option>
                        <option value="5">Minivan</option>
                        <option value="6">Jeep</option>
                        <option value="7">Coupe</option>
                        <option value="8">Crossover</option>
                        <option value="9">Sports Car</option>
                    </select>
                </div>
                <div>
                    <input type="number" placeholder="Year From" name="year_from" />
                </div>
                <div>
                    <input type="number" placeholder="Year To" name="year_to" />
                </div>
                <div>
                    <input type="number" placeholder="Price From" name="price_from" />
                </div>
                <div>
                    <input type="number" placeholder="Price To" name="price_to" />
                </div>
                <div>
                    <select name="fuel_type_id">
                        <option value="">Fuel Type</option>
                        <option value="2">Diesel</option>
                        <option value="3">Electric</option>
                        <option value="1">Gasoline</option>
                        <option value="4">Hybrid</option>
                    </select>
                </div>
            </div>
            <div>
                <button type="button" class="btn btn-find-a-car-reset">
                    Reset
                </button>
                <button class="btn btn-primary btn-find-a-car-submit">
                    Search
                </button>
            </div>
        </form>
    </div>
</section>
<!--/ Find a car form -->

<script>
document.addEventListener("DOMContentLoaded", function() {
    const makerSelect = document.getElementById("makerSelect");
    const modelSelect = document.getElementById("modelSelect");
    const stateSelect = document.getElementById("stateSelect");
    const citySelect = document.getElementById("citySelect");

    function filterOptions(parentSelect, childSelect) {
        const selectedParent = parentSelect.value;
        const options = childSelect.querySelectorAll("option[data-parent]");
        options.forEach(option => {
            option.style.display =
                option.getAttribute("data-parent") === selectedParent
                    ? "block"
                    : "none";
        });
        childSelect.value = "";
    }

    if (makerSelect && modelSelect) {
        makerSelect.addEventListener("change", () =>
            filterOptions(makerSelect, modelSelect)
        );
    }

    if (stateSelect && citySelect) {
        stateSelect.addEventListener("change", () =>
            filterOptions(stateSelect, citySelect)
        );
    }

    const resetButton = document.querySelector(".btn-find-a-car-reset");
    const searchForm = document.querySelector(".find-a-car-form");

    if (resetButton && searchForm) {
        resetButton.addEventListener("click", function() {
            searchForm.reset();

            if (modelSelect) {
                modelSelect.querySelectorAll("option[data-parent]").forEach(opt => opt.style.display = "none");
            }
            if (citySelect) {
                citySelect.querySelectorAll("option[data-parent]").forEach(opt => opt.style.display = "none");
            }
        });
    }
});
</script>