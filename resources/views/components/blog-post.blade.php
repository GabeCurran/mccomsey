<div class="mt-4 p-2 bg-gray-100 border rounded-lg">
    <h3 class='border-b mb-2 text-3xl'>{{ $title }}</h3>
    <div class='blog-content'>{{ $post_content }}</div>
</div>
<script>
    heading1s = document.querySelectorAll('.blog-content h2');
    for (i = 0; i < heading1s.length; i++) {
        heading1s[i].classList.add('text-2xl');
    }
    heading2s = document.querySelectorAll('.blog-content h3');
    for (i = 0; i < heading2s.length; i++) {
        heading2s[i].classList.add('text-xl');
    }
    heading3s = document.querySelectorAll('.blog-content h4');
    for (i = 0; i < heading3s.length; i++) {
        heading3s[i].classList.add('text-lg');
    }
    bulletList = document.querySelectorAll('.blog-content ul');
    for (i = 0; i < bulletList.length; i++) {
        bulletList[i].classList.add('list-disc');
        bulletList[i].classList.add('ml-4');
    }
    orderedList = document.querySelectorAll('.blog-content ol');
    for (i = 0; i < orderedList.length; i++) {
        orderedList[i].classList.add('list-decimal');
        orderedList[i].classList.add('ml-4');
    }
    links = document.querySelectorAll('.blog-content a');
    for (i = 0; i < links.length; i++) {
        links[i].classList.add('text-blue-500');
        links[i].classList.add('underline');
    }
    blockquotes = document.querySelectorAll('.blog-content blockquote');
    for (i = 0; i < blockquotes.length; i++) {
        blockquotes[i].classList.add('border-l-4');
        blockquotes[i].classList.add('border-gray-300');
        blockquotes[i].classList.add('pl-4');
        blockquotes[i].classList.add('ml-4');
        blockquotes[i].classList.add('mb-4');
    }
    tables = document.querySelectorAll('.blog-content table');
    for (i = 0; i < tables.length; i++) {
        tables[i].classList.add('table-auto');
        tables[i].classList.add('border-collapse');
        tables[i].classList.add('ml-4');
        tables[i].classList.add('mb-4');
    }
    tableCell = document.querySelectorAll('.blog-content td');
    for (i = 0; i < tableCell.length; i++) {
        tableCell[i].classList.add('border-4');
        tableCell[i].classList.add('border-gray-300');
        tableCell[i].classList.add('p-4');
    }
    media = document.querySelectorAll('oembed');
    for (i = 0; i < media.length; i++) {
        media[i].classList.add('width-full');
    }
</script>