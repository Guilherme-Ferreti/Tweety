<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form method="POST" action="/tweets" enctype="multipart/form-data">
        @csrf

        <textarea name="body" class="w-full" placeholder="What's up doc?" required autofocus style="outline:none; resize:none"></textarea>

        <hr class="my-4">

        <footer class="flex justify-between items-center">

            <input type="file" name="image" style="display:none" id="upload-image"/>

            <img src="{{ current_user()->avatar }}" alt="your avatar" class="rounded-full mr-2" width="50" height="50"/>

            <div style="display:flex;flex-direction:row; align-items:center">
                <svg onclick="document.getElementById('upload-image').click()" id="Layer_1" enable-background="new 0 0 512 512" height="30" width="30" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="256" x2="256" y1="0" y2="512"><stop offset="0" stop-color="#8df49b"/><stop offset="1" stop-color="#589cf9"/></linearGradient><path d="m452 0h-392c-33.084 0-60 26.916-60 60v392c0 33.084 26.916 60 60 60h392c33.084 0 60-26.916 60-60v-392c0-33.084-26.916-60-60-60zm-392 40h392c11.028 0 20 8.972 20 20v293.715l-68.073-68.073c-23.395-23.394-61.459-23.394-84.854 0l-22.073 22.074-62.074-62.074c-23.393-23.394-61.458-23.394-84.853 0l-110.073 110.073v-295.715c0-11.028 8.972-20 20-20zm392 432h-392c-11.028 0-20-8.972-20-20v-39.715l138.357-138.358c7.8-7.798 20.486-7.798 28.284 0l90.359 90.357 50.358-50.358c7.797-7.798 20.486-7.798 28.283 0l96.359 96.359v41.715c0 11.028-8.972 20-20 20zm-128-272c33.084 0 60-26.916 60-60s-26.916-60-60-60-60 26.916-60 60 26.916 60 60 60zm0-80c11.028 0 20 8.972 20 20s-8.972 20-20 20-20-8.972-20-20 8.972-20 20-20z" fill="url(#SVGID_1_)"/></svg>

                <button type="submit" class="bg-blue-500 hover:bg-blue-600 rounded-lg shadow px-10 text-sm text-white h-10 ml-5" style="outline:none" >
                    Publish It
                </button>
            </div>

        </footer>
    </form>

    @if($errors->any())
        <p class="text-red-500 text-sm mt-2">{{ $errors->first() }}</p>
    @endif

    @if( session('success') !== null)
    <p class="text-green-500 text-sm mt-2">{{ session('success') }}</p>
    @endif

</div>