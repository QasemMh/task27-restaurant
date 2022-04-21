$(function () {
  fetch("http://localhost:81/task27_1/api/special")
    .then((res) => res.json())
    .then((data) => {
      let sectionData = "";
      for (const item of data) {
        sectionData += `
        <div class="icon">
        <img
          class="scroll-reveal"
          data-origin="top"
          data-distance="20%"
          src="http://localhost:81/task27_1/image/${item.path}"
        />
        
        <p class="scroll-reveal" data-distance="0" data-duration="500">
          ${item.title}
        </p>
      </div>
        `;
      }

      $("#special-section").html(sectionData);
    });
  // end
});
