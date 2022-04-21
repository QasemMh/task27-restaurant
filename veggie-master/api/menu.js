$(function () {
  let menuData = [[], [], [], []];

  //limit 10
  fetch("http://localhost:81/task27_1/api/menu/index/1")
    .then((res) => res.json())
    .then((data) => {
      for (const item of data) {
        menuData[0].push({
          title: item.title,
          sub_title: item.sub_title,
          price: item.price,
          category: item.category,
        });
      }
      //limit 10
      return fetch("http://localhost:81/task27_1/api/menu/index/2");
    })
    .then((res) => res.json())
    .then((data) => {
      for (const item of data) {
        menuData[1].push({
          title: item.title,
          sub_title: item.sub_title,
          price: item.price,
          category: item.category,
        });
      }
      //limit 10
      return fetch("http://localhost:81/task27_1/api/menu/index/3");
    })
    .then((res) => res.json())
    .then((data) => {
      for (const item of data) {
        menuData[2].push({
          title: item.title,
          sub_title: item.sub_title,
          price: item.price,
          category: item.category,
        });
      }

      //limit 10
      return fetch("http://localhost:81/task27_1/api/menu/index/4");
    })
    .then((res) => res.json())
    .then((data) => {
      for (const item of data) {
        menuData[3].push({
          title: item.title,
          sub_title: item.sub_title,
          price: item.price,
          category: item.category,
        });
      }
    })
    .then(() => {
      let i = 0;
      let panels = "";
      let panelLeft = "";
      let panelRight = "";

      for (const item of menuData[0]) {
        if (i < 5) {
          panelLeft += `
          <tr>
          <td> <span>${item.title}</span></td>
          <td> <span>${item.price}</span></td>
          </tr>
          <tr>
          <td>${item.sub_title}</td>
          </tr>
          `;
        } else {
          panelRight += `
          <tr>
          <td> <span>${item.title}</span></td>
          <td> <span>${item.price}</span></td>
          </tr>
          <tr>
          <td>${item.sub_title}</td>
          </tr>
          `;
        }
        i++;
      }
      panels += `
       <div class="tabs-panel is-active" id="panel1">
        <div class="menu-content">
          <div class="menu-section">
            <table>
              ${panelLeft}
            </table>
          </div>
          <!--.menu-section-->
          <div class="menu-section">
            <table>
            ${panelRight}
            </table>
          </div>
          <!--.menu-section-->
        </div>
        <!--.menu-content-->
      </div>
       `;

      panelLeft = "";
      panelRight = "";

      //
      i = 0;
      for (const item of menuData[1]) {
        if (i < 5) {
          panelLeft += `
          <tr>
          <td> <span>${item.title}</span></td>
          <td> <span>${item.price}</span></td>
          </tr>
          <tr>
          <td>${item.sub_title}</td>
          </tr>
          `;
        } else {
          panelRight += `
          <tr>
          <td> <span>${item.title}</span></td>
          <td> <span>${item.price}</span></td>
          </tr>
          <tr>
          <td>${item.sub_title}</td>
          </tr>
          `;
        }
        i++;
      }
      panels += `
      <div class="tabs-panel"  id="panel2">
       <div class="menu-content">
         <div class="menu-section">
           <table>
                 ${panelLeft}
           </table>
         </div>
         <!--.menu-section-->
         <div class="menu-section">
           <table>
           ${panelRight}
           </table>
         </div>
         <!--.menu-section-->
       </div>
       <!--.menu-content-->
     </div>
      `;
      panelLeft = "";
      panelRight = "";

      //
      i = 0;
      for (const item of menuData[2]) {
        if (i < 5) {
          panelLeft += `
            <tr>
            <td> <span>${item.title}</span></td>
            <td> <span>${item.price}</span></td>
            </tr>
            <tr>
            <td>${item.sub_title}</td>
            </tr>
            `;
        } else {
          panelRight += `
            <tr>
            <td> <span>${item.title}</span></td>
            <td> <span>${item.price}</span></td>
            </tr>
            <tr>
            <td>${item.sub_title}</td>
            </tr>
            `;
        }
        i++;
      }
      panels += `
        <div class="tabs-panel"   id="panel3">
         <div class="menu-content">
           <div class="menu-section">
             <table>
                   ${panelLeft}
             </table>
           </div>
           <!--.menu-section-->
           <div class="menu-section">
             <table>
             ${panelRight}
             </table>
           </div>
           <!--.menu-section-->
         </div>
         <!--.menu-content-->
       </div>
        `;
      panelLeft = "";
      panelRight = "";

      //
      i = 0;
      for (const item of menuData[3]) {
        if (i < 5) {
          panelLeft += `
      <tr>
      <td> <span>${item.title}</span></td>
      <td> <span>${item.price}</span></td>
      </tr>
      <tr>
      <td>${item.sub_title}</td>
      </tr>
      `;
        } else {
          panelRight += `
      <tr>
      <td> <span>${item.title}</span></td>
      <td> <span>${item.price}</span></td>
      </tr>
      <tr>
      <td>${item.sub_title}</td>
      </tr>
      `;
        }
        i++;
      }
      panels += `
  <div class="tabs-panel"   id="panel4">
   <div class="menu-content">
     <div class="menu-section">
       <table>
             ${panelLeft}
       </table>
     </div>
     <!--.menu-section-->
     <div class="menu-section">
       <table>
       ${panelRight}
       </table>
     </div>
     <!--.menu-section-->
   </div>
   <!--.menu-content-->
 </div>
  `;
      panelLeft = "";
      panelRight = "";

      $("#menu-content").html(panels);
      console.table(menuData);
      console.table(menuData[0]);
      console.log(panels);
    });
  // end
});
