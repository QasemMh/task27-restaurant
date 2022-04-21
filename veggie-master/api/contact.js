$(function () {
  let logoName = "LOGO";

  fetch("http://localhost:81/task27_1/api/home")
    .then((res) => res.json())
    .then((data) => {
      logoName = data.logo_name;
      document.title = logoName;
      return fetch("http://localhost:81/task27_1/api/contact");
    })
    .then((res) => res.json())
    .then((item) => {
      let sectionData = ` 
      <div class="info-address">
      <h3>${logoName}</h3>
      <p>${item.location}</p>
      </div>
      <div class="reservations">
      <h3>Reservations</h3>
      <p>${item.email}<br />${item.phone}</p>
      </div> 
      `;
      $("#contact-data").html(sectionData);
    });

  //

  //when form submit
  // will run if create  form was submitted
  $(document).on("submit", "#contact-formx", function (e) {
    e.preventDefault();
    const form = document.getElementById("contact-formx");
    const formData = {};
    // Get all input elements inside a form
    // and create key:value pairs inside formData
    form.querySelectorAll("input").forEach((element) => {
      formData[element.name] = element.value;
    });
    form.querySelectorAll("textarea").forEach((element) => {
      formData[element.name] = element.value;
    });

    // Send data to backend
    fetch("http://localhost:81/task27_1/api/message/create", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    }).then((res) => {
      if (res.ok) {
        form.reset();
        alert("Message Sent");
      } else {
        alert(new Error("Error. try again"));
      }
    });
  });
  // end
});
