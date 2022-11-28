const api_url =
  "http://practicearimuraryomacom.local//wp-content/themes/hagukumu.co.jp/loading.php"; // POST先のPHPファイルパス
let current = 3; // 初期表示投稿数（投稿取得開始位置）
const add = 3; // 投稿取得数
const trigger = document.getElementById("infinite_loading_button"); // トリガー要素指定
const container = document.getElementById("infinite_loading_container"); // 表示コンテナ要素指定
trigger.addEventListener("click", () => {
  fetch(api_url, {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
    },
    body: `currently_loaded_count=${current}&additional_loading_count=${add}`,
  })
    .then((response) => {
      console.log(response);
      return response.json();
    })
    .then((json) => {
      json.content.forEach((item) => {
        container.insertAdjacentHTML("beforeEnd", item);
      });
      current = current + add;
      if (json.complete) {
        trigger.remove();
      }
    })
    .catch((error) => {
      return error.message;
    });
});
