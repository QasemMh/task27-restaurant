$(function () {
  fetch("http://localhost:81/task27_1/api/about")
    .then((res) => res.json())
    .then((data) => {
      $("#about-title").html(data.title);
      $("#about-text").html(data.content);
    });
  // end
});
