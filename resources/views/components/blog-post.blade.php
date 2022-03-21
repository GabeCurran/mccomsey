<div class="mt-4 p-2 bg-gray-100 border rounded-lg">
    <h3 class='border-b mb-2 text-3xl'>{{ $title }}</h3>
    <div>{{ $post_content }}</div>
</div>
<script>
    heading1s = document.getElementsByTagName('h2');
    for (i = 0; i < heading1s.length; i++) {
        heading1s[i].classList.add('text-2xl');
    }
    heading2s = document.getElementsByTagName('h3');
    for (i = 0; i < heading2s.length; i++) {
        heading2s[i].classList.add('text-xl');
    }
    heading3s = document.getElementsByTagName('h4');
    for (i = 0; i < heading3s.length; i++) {
        heading3s[i].classList.add('text-lg');
    }
    bulletList = document.getElementsByTagName('ul');
    for (i = 0; i < bulletList.length; i++) {
        bulletList[i].classList.add('list-disc');
        bulletList[i].classList.add('ml-4');
    }
    orderedList = document.getElementsByTagName('ol');
    for (i = 0; i < orderedList.length; i++) {
        orderedList[i].classList.add('list-decimal');
        orderedList[i].classList.add('ml-4');
    }
</script>