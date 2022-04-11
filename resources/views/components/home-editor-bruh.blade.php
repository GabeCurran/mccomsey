<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden">
            <div class="p-6 bg-white border-b border-gray-200">

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
                    <button type="submit" role="submit" class="mt-3 ml-5 p-3 bg-blue-500 text-white hover:bg-blue-400" required>Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type='module'>
    ClassicEditor.create(document.querySelector('#editor'), {
        simpleUpload: {
            uploadUrl: {
                url: '/image-upload',
            }
        }
    }).then(editor => {
        console.log('Editor created successfully!');
    }).catch(err => {
        console.error(err.stack);
    });
</script>