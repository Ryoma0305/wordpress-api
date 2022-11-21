//////////////////////////////////////////
// Story一覧ページ 絞り込み機能UI
//////////////////////////////////////////

let [name, value] = location.search.slice(1).split("=");

if (!!name && !!value && name === "category") {
  document.querySelector(
    `#form-sp input[type="radio"][ name="${name}"][value="${value}"]`
  ).checked = true;
  document.querySelector(
    `#form-pc input[type="radio"][ name="${name}"][value="${value}"]`
  ).checked = true;
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
  let queryStr = 'label[for="' + radioButton.id + '"]';
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
  let queryStr = 'label[for="' + radioButton.id + '"]';
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
