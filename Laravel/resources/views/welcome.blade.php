<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style type="text/tailwindcss">
        @layer utilities {
      .container{
        @apply px-10 mx-auto;   
        content-visibility: auto;
      }
      .btn{
        @apply bg-green-600 text-white rounded py-2 px-4
      }
    }
  </style>

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>


        <!-- confetiiiiii -->
     @if(session()->get('success_animation'))
    <script>
            window.addEventListener('DOMContentLoaded', () => {
                confetti({
                    particleCount: 100,
                    spread: 70,
                    origin: {
                        y: 0.6
                    }
                });
            });
    </script>
    @endif


    
    <title>ReformedTech</title>
</head>

<body>
    <div class="container">
        <div class="flex justify-between my-5">
            <h2 class="text-green-500 text-2xl"><b>ReformedTech</b></h2>
            <a href="/create" class="btn">Add new post</a>

        </div>

        
        <h1 align="center" class="px-1 py-1 text-green-500 text-xl"><b>Hello There!</b></h1>
        <div class="">
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-2.5 min-w-full inline-block align-middle">
                        <div class="border border-green-200 rounded-lg overflow-hidden">
                            <table class="min-w-full divide-y divide-green-200">
                                <thead class="bg-green-50 dark:bg-gray-800">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500  uppercase"><b>ID</b></th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500  uppercase"><b>Name</b></th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500  uppercase"><b>Description</b></th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500  uppercase"><b>Image</b></th>
                                        <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase"><b>Action</b></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($posts as $post)
                                    <!-- {{$post->name}} -->

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{($posts->currentPage() - 1) * $posts->perPage() + $loop->iteration}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{$post->name}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{$post->description}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800"><img src="uploads/{{$post->image}}" alt="" width="80px"></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <a href="{{route('edit', $post->id)}}" class="btn">Edit</a>
                                            <a href="{{route('delete', $post->id)}}" class=" bg-red-600 text-white rounded py-2 px-4">Delete</a>
                                            <!-- <button type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-hidden focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Delete</button> -->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$posts->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>


</body>

</html>