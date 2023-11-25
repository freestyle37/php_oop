"use strict";
function ajax_req(info, card) {
  // 1. Создаём новый XMLHttpRequest-объект
  let xhr = new XMLHttpRequest();

  // 2. Настраиваем его: GET-запрос по URL /article/.../load
  xhr.open('POST', './actions/ajax_remove_card_action.php', true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  // 3. Отсылаем запрос
  xhr.send(info);

  // 4. Этот код сработает после того, как мы получим ответ сервера
  xhr.onload = function() {
    if (xhr.status != 200) { // анализируем HTTP-статус ответа, если статус не 200, то произошла ошибка
      alert(`Ошибка ${xhr.status}: ${xhr.statusText}`); // Например, 404: Not Found
    } else { // если всё прошло гладко, выводим результат
      card.style.display = 'none';
      //alert(`Готово, получили ${xhr.response.length} байт`); // response -- это ответ сервера
    }
  };

  xhr.onprogress = function(event) {
    if (event.lengthComputable) {
      //alert(`Получено ${event.loaded} из ${event.total} байт`);
    } else {
      //alert(`Получено ${event.loaded} байт`); // если в ответе нет заголовка Content-Length
    }

  };

  xhr.onerror = function() {
    alert("Запрос не удался");
  };
}

document.addEventListener("DOMContentLoaded", function() {
  console.log("hi");
});

document.addEventListener("click", event => {

  const removeButton = event.target.closest('.card .remove-card');

  if (removeButton) {
    let card = removeButton.closest('.card');

    if (card) {
      console.log(card.dataset.card_id);
      ajax_req("id=" + card.dataset.card_id, card);
    }
  }

});

