<x-app-layout>
    <main>
        <div class="container-small">
            <h1 class="car-details-page-title">Add new car</h1>

            <form action="{{ route('car.store') }}" method="POST" enctype="multipart/form-data"
                class="card add-new-car-form">
                @csrf

                <div class="form-content">
                    {{-- === Left side form fields === --}}
                    <div class="form-details">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Maker</label>
                                    <select name="maker_id" id="maker_id" required>
                                        <option value="">Maker</option>
                                        @foreach ($makers as $maker)
                                            <option value="{{ $maker->id }}">{{ $maker->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Model</label>
                                    <select name="model_id" id="model_id" required>
                                        <option value="">Model</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select name="year" required>
                                        <option value="">Year</option>
                                        @for ($y = now()->year + 1; $y >= 1990; $y--)
                                            <option value="{{ $y }}">{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Car Type</label>
                                    <select name="car_type_id" required>
                                        <option value="">Select</option>
                                        @foreach ($carTypes as $ct)
                                            <option value="{{ $ct->id }}">{{ $ct->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Fuel Type</label>
                                    <select name="fuel_type_id" required>
                                        <option value="">Select</option>
                                        @foreach ($fuelTypes as $ft)
                                            <option value="{{ $ft->id }}">{{ $ft->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" name="price" placeholder="Price" required />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Vin Code</label>
                                    <input name="vin" placeholder="Vin Code" required />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Mileage (ml)</label>
                                    <input type="number" name="mileage" placeholder="Mileage" required />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>State/Region</label>
                                    <select name="state_id" id="state_id" required>
                                        <option value="">State/Region</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>City</label>
                                    <select name="city_id" id="city_id" required>
                                        <option value="">City</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <input name="address" placeholder="Address" />
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input name="phone" placeholder="Phone" />
                        </div>

                        <div class="form-group">
                            <label>Detailed Description</label>
                            <textarea name="description" rows="6"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Car Features</label>
                            <div class="row">
                                <div class="col">
                                    <label class="checkbox"><input type="checkbox" name="air_conditioning"
                                            value="1"> Air Conditioning</label>
                                    <label class="checkbox"><input type="checkbox" name="power_windows" value="1">
                                        Power Windows</label>
                                    <label class="checkbox"><input type="checkbox" name="power_door_locks"
                                            value="1"> Power Door Locks</label>
                                    <label class="checkbox"><input type="checkbox" name="abs" value="1">
                                        ABS</label>
                                    <label class="checkbox"><input type="checkbox" name="cruise_control" value="1">
                                        Cruise Control</label>
                                    <label class="checkbox"><input type="checkbox" name="bluetooth_connectivity"
                                            value="1"> Bluetooth Connectivity</label>
                                </div>
                                <div class="col">
                                    <label class="checkbox"><input type="checkbox" name="remote_start"
                                            value="1"> Remote Start</label>
                                    <label class="checkbox"><input type="checkbox" name="gps_navigation"
                                            value="1"> GPS Navigation</label>
                                    <label class="checkbox"><input type="checkbox" name="heated_seats"
                                            value="1"> Heated Seats</label>
                                    <label class="checkbox"><input type="checkbox" name="climate_control"
                                            value="1"> Climate Control</label>
                                    <label class="checkbox"><input type="checkbox" name="rear_parking_sensors"
                                            value="1"> Rear Parking Sensors</label>
                                    <label class="checkbox"><input type="checkbox" name="leather_seats"
                                            value="1"> Leather Seats</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="checkbox">
                                <input type="checkbox" name="published" />
                                Published
                            </label>
                        </div>
                    </div>

                    {{-- === Right sidebar (images) === --}}
                    <div class="form-images">
                        <div class="form-group">
                            <label for="images">Car Images</label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple>
                            <small class="form-text text-muted">
                                Drag to reorder, click × to remove. First image is primary.
                            </small>
                        </div>

                        <div id="imagePreviews" class="car-form-images"></div>
                    </div>
                </div>

                <div class="p-medium" style="width: 100%">
                    <div class="flex justify-end gap-1">
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        const makers = @json($makersJson);
        const states = @json($statesJson);

        document.getElementById('maker_id').addEventListener('change', e => {
            const id = e.target.value;
            const modelSelect = document.getElementById('model_id');
            modelSelect.innerHTML = '<option value="">Model</option>';
            const maker = makers.find(m => m.id == id);
            if (maker) {
                maker.models.forEach(m => {
                    modelSelect.innerHTML += `<option value="${m.id}">${m.name}</option>`;
                });
            }
        });

        document.getElementById('state_id').addEventListener('change', e => {
            const id = e.target.value;
            const citySelect = document.getElementById('city_id');
            citySelect.innerHTML = '<option value="">City</option>';
            const state = states.find(s => s.id == id);
            if (state) {
                state.cities.forEach(c => {
                    citySelect.innerHTML += `<option value="${c.id}">${c.name}</option>`;
                });
            }
        });

        // === Image upload with reorder + delete ===
        let filesArray = [];
        const input = document.getElementById('images');
        const preview = document.getElementById('imagePreviews');

        input.addEventListener('change', function(e) {
            filesArray = Array.from(e.target.files);
            renderPreviews();
        });

        function renderPreviews() {
            preview.innerHTML = '';
            filesArray.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('car-form-image-preview');
                    wrapper.dataset.index = index;

                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.style.width = '120px';
                    img.style.height = '120px';
                    img.style.objectFit = 'cover';
                    img.style.borderRadius = '8px';
                    img.style.margin = '5px';

                    const deleteBtn = document.createElement('span');
                    deleteBtn.classList.add('delete-icon');
                    deleteBtn.innerHTML = '×';
                    deleteBtn.onclick = function() {
                        filesArray.splice(index, 1);
                        renderPreviews();
                        updateInputFiles();
                    };

                    wrapper.appendChild(img);
                    wrapper.appendChild(deleteBtn);
                    preview.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });

            makeSortable();
            updateInputFiles();
        }

        function makeSortable() {
            new Sortable(preview, {
                animation: 150,
                onEnd: function() {
                    const newOrder = [];
                    preview.querySelectorAll('.car-form-image-preview').forEach(el => {
                        newOrder.push(filesArray[el.dataset.index]);
                    });
                    filesArray = newOrder;
                    updateInputFiles();
                }
            });
        }

        function updateInputFiles() {
            const dataTransfer = new DataTransfer();
            filesArray.forEach(f => dataTransfer.items.add(f));
            input.files = dataTransfer.files;
        }
    </script>
</x-app-layout>
