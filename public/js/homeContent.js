heading1s = document.querySelectorAll('#home-content h2');
for (i = 0; i < heading1s.length; i++) {
    heading1s[i].classList.add('text-2xl');
}
heading2s = document.querySelectorAll('#home-content h3');
for (i = 0; i < heading2s.length; i++) {
    heading2s[i].classList.add('text-xl');
}
heading3s = document.querySelectorAll('#home-content h4');
for (i = 0; i < heading3s.length; i++) {
    heading3s[i].classList.add('text-lg');
}
bulletList = document.querySelectorAll('#home-content ul');
for (i = 0; i < bulletList.length; i++) {
    bulletList[i].classList.add('list-disc');
    bulletList[i].classList.add('list-inside');
}
orderedList = document.querySelectorAll('#home-content ol');
for (i = 0; i < orderedList.length; i++) {
    orderedList[i].classList.add('list-decimal');
    orderedList[i].classList.add('list-inside');
}
links = document.querySelectorAll('#home-content a');
for (i = 0; i < links.length; i++) {
    links[i].classList.add('text-blue-500');
    links[i].classList.add('underline');
}
blockquotes = document.querySelectorAll('#home-content blockquote');
for (i = 0; i < blockquotes.length; i++) {
    blockquotes[i].classList.add('border-l-4');
    blockquotes[i].classList.add('border-gray-300');
    blockquotes[i].classList.add('pl-4');
    blockquotes[i].classList.add('ml-4');
    blockquotes[i].classList.add('mb-4');
}
tables = document.querySelectorAll('#home-content table');
for (i = 0; i < tables.length; i++) {
    tables[i].classList.add('table-auto');
    tables[i].classList.add('border-collapse');
    tables[i].classList.add('ml-4');
    tables[i].classList.add('mb-4');
}
tableCell = document.querySelectorAll('#home-content td');
for (i = 0; i < tableCell.length; i++) {
    tableCell[i].classList.add('border-4');
    tableCell[i].classList.add('border-gray-300');
    tableCell[i].classList.add('p-4');
}
media = document.querySelectorAll('#home-content figure.media');
for (i = 0; i < media.length; i++) {
    media[i].classList.add('w-1/2');
}
images = document.querySelectorAll('#home-content img, #home-content figure.image');
for (i = 0; i < images.length; i++) {
    images[i].classList.add('w-1/2');
    images[i].classList.add('h-auto');
}