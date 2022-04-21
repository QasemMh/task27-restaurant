$(function () {
  fetch("http://localhost:81/task27_1/api/month_special")
    .then((res) => res.json())
    .then((data) => {
      let sectionData = "";
      for (const item of data) {
        sectionData += `
        <div class="special">
        <div class="special-img img-01">
          <img src="http://localhost:81/task27_1/image/${item.path}" />
        </div>
        <div class="special-items spec-01">
          <h2 class="scroll-reveal" data-origin="top" data-distance="20%">
            ${item.title}
          </h2>
          <span
            class="line scroll-reveal"
            data-origin="top"
            data-distance="20%"
          ></span>
          <p class="scroll-reveal" data-origin="bottom" data-distance="30%">
            ${item.sub_title}
          </p>
          <span
            class="scroll-reveal"
            data-origin="bottom"
            data-distance="60%"
            >${item.price}$</span
          >
        </div>
      </div>
      <!--.special-->
          `;
      }

      $("#month-specials").html(sectionData);
    });
  // end
});
