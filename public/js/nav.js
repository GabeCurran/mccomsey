const nav = document.querySelector("#nav")
const title = document.querySelector("#title")
const observer = new IntersectionObserver( 
  ([e]) => title.classList.toggle("is-pinned", e.intersectionRatio < 1),
  { threshold: [1] }
);

observer.observe(nav);