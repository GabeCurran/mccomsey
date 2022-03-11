<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="mb-4">
                    <label class="text-xl text-gray-600">Title <span class="text-red-500">*</span></label></br>
                    <input type="text" class="border-2 border-gray-300 p-2 w-full" name="title" id="title" value="" required>
                </div>

                {{-- <div class="mb-4">
                    <label class="text-xl text-gray-600">Description</label></br>
                    <input type="text" class="border-2 border-gray-300 p-2 w-full" name="description" id="description" placeholder="(Optional)">
                </div> --}}

                <div>
                    <label class="text-xl text-gray-600">Content <span class="text-red-500">*</span></label></br>
                    <textarea name='content' id='editor'>
                    </textarea>
                    </div>
                </div>

                <div class="flex p-1">
                    <select class="border-2 border-gray-300 border-r p-1 w-auto" name="action">
                        <option>Save and Publish</option>
                        <option>Save Draft</option>
                    </select>
                    <button type="submit" role="submit" class="p-3 bg-blue-500 text-white hover:bg-blue-400" required>Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>