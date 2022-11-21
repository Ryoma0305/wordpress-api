//////////////////////////////////////////
// Service一覧ページ 絞り込み機能UI
//////////////////////////////////////////

let [name, value] = location.search.slice(1).split("=");
if (!!name && !!value && (name === "theme" || name === "category")) {
  document.querySelector(
    `#form-sp input[type="radio"][ name="${name}"][value="${value}"]`
  ).checked = true;
  document.querySelector(
    `#form-pc input[type="radio"][ name="${name}"][value="${value}"]`
  ).checked = true;
} else {
  document.querySelector(`#form-sp .js-radio-all`).checked = true;
  document.querySelector(`#form-pc .js-radio-all`).checked = true;
}

const themeRadio = document.querySelector(
  `input[type="radio"][name="theme"]:checked`
);
if (themeRadio) {
  document.querySelector("#js_category_pc").style.display = "none";
  document.querySelector("#js_category_sp").style.display = "none";
}

const radioButtonsSp = document.querySelectorAll(
  '#form-sp input[type="radio"]'
);
const radioButtonsPc = document.querySelectorAll(
  '#form-pc input[type="radio"]'
);

radioButtonsSp.forEach((radioButton) => {
  radioButton.addEventListener("change", (e) => {
    const name = e.target.name;
    const otherRadio = e.target
      .closest("form")
      .querySelector(`input[type="radio"]:not([name="${name}"]):checked`);
    if (otherRadio) {
      otherRadio.checked = false;
    }
  });
});

const clearRadioButton = (radioButton) => {
  setTimeout(
    (func = () => {
      radioButton.checked = false;
    }),
    50
  );
};

radioButtonsSp.forEach((radioButton) => {
  let label = radioButton.closest("label");
  const form = document.querySelector("#form-sp");

  radioButton.addEventListener("change", (e) => {
    const name = e.target.name;

    const otherRadio = document.querySelector(
      `input[type="radio"]:not([name="${name}"]):checked`
    );
    if (otherRadio) {
      otherRadio.checked = false;
    }
  });

  radioButton.addEventListener(
    "mouseup",
    (func = () => {
      if (radioButton.checked) {
        clearRadioButton(radioButton);
      }

      setTimeout(() => {
        form.submit();
      }, 50);
    })
  );

  if (label) {
    label.addEventListener(
      "mouseup",
      (func = () => {
        if (radioButton.checked) {
          clearRadioButton(radioButton);
        }
        setTimeout(() => {
          form.submit();
        }, 50);
      })
    );
  }
});

radioButtonsPc.forEach((radioButton) => {
  let label = radioButton.closest("label");
  const form = document.querySelector("#form-pc");

  radioButton.addEventListener("change", (e) => {
    const name = e.target.name;

    const otherRadio = document.querySelector(
      `input[type="radio"]:not([name="${name}"]):checked`
    );
    if (otherRadio) {
      otherRadio.checked = false;
    }
  });

  radioButton.addEventListener(
    "mouseup",
    (func = () => {
      if (radioButton.checked) {
        clearRadioButton(radioButton);
      }

      setTimeout(() => {
        form.submit();
      }, 50);
    })
  );

  if (label) {
    label.addEventListener(
      "mouseup",
      (func = () => {
        if (radioButton.checked) {
          clearRadioButton(radioButton);
        }
        setTimeout(() => {
          form.submit();
        }, 50);
      })
    );
  }
});
