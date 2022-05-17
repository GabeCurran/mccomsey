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
    bulletList[i].classList.add('list-inside');
}
orderedList = document.querySelectorAll('.blog-content ol');
for (i = 0; i < orderedList.length; i++) {
    orderedList[i].classList.add('list-decimal');
    orderedList[i].classList.add('list-inside');
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
media = document.querySelectorAll('.blog-content figure.media');
for (i = 0; i < media.length; i++) {
    media[i].classList.add('w-1/2');
}
figure = document.querySelectorAll('.blog-content figure.image');
for (i = 0; i < figure.length; i++) {
    figure[i].classList.add('overflow-hidden');
}

//loop through each blog post and wrap figures in a div
$('.blog-content').each(function() {
    let $this = $(this);
    let $figures = $this.find('figure');
    $figures.wrapAll('<div class="flex flex-wrap max-w-2xl"></div>');
    if ($figures.length > 4) {
        for (let i = 3; i <$figures.length; i++) {
            $figures[i].classList.add('hidden');
        }
        $this.find('#more-button').removeClass('hidden');
        $('#more-button').click(function() {
            $figures.removeClass('hidden');
            $('#more-button').addClass('hidden');
        });
    }
});

//wrap images in anchor tag
$('.blog-content img').wrap(function() {
    return '<a title="Click to see full image" href="' + $(this).attr('src') + '" target="_blank" class="image"></a>';
});

//image hover
$('.blog-content img').hover(function() {
    $(this).fadeTo(150, 0.5);
} , function() {
    $(this).fadeTo(150, 1);
});