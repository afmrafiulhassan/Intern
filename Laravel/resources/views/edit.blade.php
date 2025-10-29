<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>

    <style type="text/tailwindcss">
        @layer utilities {
      .container{
        @apply px-10 mx-auto;   
        content-visibility: auto;
      }
    }
  </style>

    <title>ReformedTech</title>
</head>

<body>
    <div class="container">
        <div class="flex justify-between my-5">
            <h2 class="text-yellow-500 text-xl"><b>Edit | {{$ourPost->name}}</b></h2>
            <a href="/" class="bg-green-600 text-white rounded py-2 px-4">Back To Home</a>
        </div>
        <div>
            <form method="POST" action="{{route('update', $ourPost->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col gap-5">
                    <label for=""><b>Name</b></label>
                    <input type="text" name="name" value="{{$ourPost->name}}">
                    @error('name')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror



                    <label for=""><b>Description</b></label>
                    <input type="text" name="description" value="{{$ourPost->description}}">
                    @error('description')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror



                    <label for=""><b>Select Image</b></label>
                    <input type="file" name="image" id="imageInput">
                    @error('image')
                    <p class="text-red-600">{{$message}}</p>
                    @enderror

                    <!-- Preview Image Area -->
                    <img id="imagePreview" src="#" alt="Image Preview" class="mt-4 hidden w-40 h-auto border rounded" />
                    <div>
                        <input type="submit" class="bg-green-600 text-white rounded py-2 px-4">
                    </div>
                </div>
            </form>
        </div>
    </div>
        <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const [file] = event.target.files;
            const preview = document.getElementById('imagePreview');

            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            } else {
                preview.src = "#";
                preview.classList.add('hidden');
            }
        });
    </script>
</body>

</html>