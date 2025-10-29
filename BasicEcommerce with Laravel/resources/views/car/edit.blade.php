<x-app-layout>
    <main>
        <div class="container-small">
            <h1 class="car-details-page-title">Edit car</h1>

            <form action="{{ route('car.update', $car->id) }}" method="POST" enctype="multipart/form-data"
                class="card add-new-car-form">
                @csrf
                @method('PUT')

                <div class="form-content">
                    <div class="form-details">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Maker</label>
                                    <select name="maker_id" id="maker_id" required>
                                        <option value="">Select</option>
                                        @foreach ($makers as $maker)
                                            <option value="{{ $maker->id }}"
                                                {{ $car->maker_id == $maker->id ? 'selected' : '' }}>
                                                {{ $maker->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Model</label>
                                    <select name="model_id" id="model_id" required>
                                        <option value="">Select</option>
                                        @foreach ($makers->firstWhere('id', $car->maker_id)?->models ?? [] as $model)
                                            <option value="{{ $model->id }}"
                                                {{ $car->model_id == $model->id ? 'selected' : '' }}>
                                                {{ $model->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select name="year" required>
                                        <option value="">Select</option>
                                        @for ($y = now()->year + 1; $y >= 1990; $y--)
                                            <option value="{{ $y }}"
                                                {{ $car->year == $y ? 'selected' : '' }}>
                                                {{ $y }}
                                            </option>
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
                                            <option value="{{ $ct->id }}"
                                                {{ $car->car_type_id == $ct->id ? 'selected' : '' }}>
                                                {{ $ct->name }}
                                            </option>
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
                                            <option value="{{ $ft->id }}"
                                                {{ $car->fuel_type_id == $ft->id ? 'selected' : '' }}>
                                                {{ $ft->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" name="price" placeholder="Price"
                                        value="{{ $car->price }}" required />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Vin Code</label>
                                    <input name="vin" placeholder="Vin Code" value="{{ $car->vin }}"
                                        required />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Mileage (ml)</label>
                                    <input type="number" name="mileage" placeholder="Mileage"
                                        value="{{ $car->mileage }}" required />
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
                                            <option value="{{ $state->id }}"
                                                {{ $car->state_id == $state->id ? 'selected' : '' }}>
                                                {{ $state->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>City</label>
                                    <select name="city_id" id="city_id" required>
                                        <option value="">City</option>
                                        @foreach ($states->firstWhere('id', $car->state_id)?->cities ?? [] as $city)
                                            <option value="{{ $city->id }}"
                                                {{ $car->city_id == $city->id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <input name="address" placeholder="Address" value="{{ $car->address }}" />
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input name="phone" placeholder="Phone" value="{{ $car->phone }}" />
                        </div>

                        <div class="form-group">
                            <label>Detailed Description</label>
                            <textarea name="description" rows="6">{{ $car->description }}</textarea>
                        </div>

                        {{-- Features --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label class="checkbox">
                                        <input type="checkbox" name="air_conditioning" value="1"
                                            {{ $car->features->air_conditioning ? 'checked' : '' }} />
                                        Air Conditioning
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="power_windows" value="1"
                                            {{ $car->features->power_windows ? 'checked' : '' }} />
                                        Power Windows
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="power_door_locks" value="1"
                                            {{ $car->features->power_door_locks ? 'checked' : '' }} />
                                        Power Door Locks
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="abs" value="1"
                                            {{ $car->features->abs ? 'checked' : '' }} />
                                        ABS
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="cruise_control" value="1"
                                            {{ $car->features->cruise_control ? 'checked' : '' }} />
                                        Cruise Control
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="bluetooth_connectivity" value="1"
                                            {{ $car->features->bluetooth_connectivity ? 'checked' : '' }} />
                                        Bluetooth Connectivity
                                    </label>
                                </div>
                                <div class="col">
                                    <label class="checkbox">
                                        <input type="checkbox" name="remote_start" value="1"
                                            {{ $car->features->remote_start ? 'checked' : '' }} />
                                        Remote Start
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="gps_navigation" value="1"
                                            {{ $car->features->gps_navigation ? 'checked' : '' }} />
                                        GPS Navigation
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="heated_seats" value="1"
                                            {{ $car->features->heated_seats ? 'checked' : '' }} />
                                        Heated Seats
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="climate_control" value="1"
                                            {{ $car->features->climate_control ? 'checked' : '' }} />
                                        Climate Control
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="rear_parking_sensors" value="1"
                                            {{ $car->features->rear_parking_sensors ? 'checked' : '' }} />
                                        Rear Parking Sensors
                                    </label>

                                    <label class="checkbox">
                                        <input type="checkbox" name="leather_seats" value="1"
                                            {{ $car->features->leather_seats ? 'checked' : '' }} />
                                        Leather Seats
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="checkbox">
                                <input type="checkbox" name="published" {{ $car->published_at ? 'checked' : '' }} />
                                Published
                            </label>
                        </div>
                    </div>

                    {{-- Existing + New images --}}
                    <div class="form-images">
                        <div class="mb-medium">
                            <h4>Current Images</h4>
                            <div class="car-form-images" id="sortable-images">
                                @foreach ($car->images as $image)
                                    <div class="car-form-image-preview" data-id="{{ $image->id }}">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Car image"
                                            class="car-item-img">
                                        <span class="delete-icon"
                                            onclick="deleteImage({{ $image->id }}, this)">×</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="images">Add New Images</label>
                            <input type="file" name="images[]" id="images" multiple class="form-control">
                        </div>
                        <div id="newImagePreviews" class="car-form-images"></div>
                    </div>
                </div>
        </div>

        <div class="p-medium" style="width: 100%">
            <div class="flex justify-end gap-1">
                {{-- <button type="reset" class="btn btn-default">Reset</button> --}}
                <button type="button" class="btn btn-default" onclick="clearCarForm()">Reset</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
        </form>
        </div>
    </main>

    {{-- Include SortableJS from CDN --}}

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <script>
        const makers = @json($makersJson);
        const states = @json($statesJson);

        function deleteImage(id, el) {
            if (!confirm('Delete this image?')) return;
            fetch(`/car-images/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        el.closest('.car-form-image-preview').remove();
                    }
                });
        }

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

        // Preview newly selected images before upload
        // document.getElementById('images').addEventListener('change', function(e) {
        //     const preview = document.getElementById('newImagePreviews');
        //     preview.innerHTML = '';
        //     Array.from(e.target.files).forEach(file => {
        //         const reader = new FileReader();
        //         reader.onload = function(event) {
        //             const wrapper = document.createElement('div');
        //             wrapper.classList.add('car-form-image-preview');
        //             wrapper.innerHTML = `
    //         <img src="${event.target.result}" class="car-item-img">
    //     `;
        //             preview.appendChild(wrapper);
        //         };
        //         reader.readAsDataURL(file);
        //     });
        // });

        document.getElementById('images').addEventListener('change', function(e) {
            const sortableContainer = document.getElementById('sortable-images');
            Array.from(e.target.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('car-form-image-preview');
                    wrapper.dataset.temp = "true"; // mark as temporary (not in DB)
                    wrapper.innerHTML = `
                <img src="${event.target.result}" class="car-item-img">
                <span class="delete-icon" onclick="this.parentElement.remove()">×</span>
            `;
                    sortableContainer.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
        });


        // === Drag & Drop Reordering ===
        const sortable = new Sortable(document.getElementById('sortable-images'), {
            animation: 150,
            onEnd: async function() {
                const order = [...document.querySelectorAll('#sortable-images .car-form-image-preview')]
                    .map(el => el.dataset.id);

                await fetch(`{{ route('car-images.reorder') }}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        order
                    })
                });
            }
        });

        function clearCarForm() {
            if (!confirm(
                    'Are you sure you want to clear all fields? This will not delete images, but will reset all inputs.'
                )) {
                return;
            }

            const form = document.querySelector('.add-new-car-form');

            // Reset all input fields except file inputs
            form.querySelectorAll('input:not([type="file"]):not([type="checkbox"])').forEach(el => {
                el.value = '';
            });

            // Reset all dropdowns
            form.querySelectorAll('select').forEach(select => {
                select.selectedIndex = 0;
            });

            // Uncheck all checkboxes
            form.querySelectorAll('input[type="checkbox"]').forEach(cb => {
                cb.checked = false;
            });

            // Clear textareas
            form.querySelectorAll('textarea').forEach(area => {
                area.value = '';
            });

            // Clear new image previews
            const newImagePreviews = document.getElementById('newImagePreviews');
            if (newImagePreviews) newImagePreviews.innerHTML = '';

            // Clear file input selection
            const fileInput = document.getElementById('images');
            if (fileInput) fileInput.value = '';

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>
</x-app-layout>
