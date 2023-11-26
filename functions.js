"use strict";
let dpk;
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

function randomInteger(min, max) {
  let rand = min - 0.5 + Math.random() * (max - min + 1);
  return Math.round(rand);
}

function card_selection(cards) {
  let ids_arr = [];

  cards.forEach(function(element) {
    ids_arr.push(+element.dataset.card_id);
  });

  //console.log(ids_arr);
  let rand_card_id = ids_arr[randomInteger(0, ids_arr.length-1)];

  cards.forEach(function(element) {
    if(+element.dataset.card_id === +rand_card_id) {
      console.log('e');
      element.dataset.display_status = 'show';
    }
  });

  console.log();
}

document.addEventListener("DOMContentLoaded", function() {
  /*
  const button = document.querySelector('#choose_deck_f_but');
  button.addEventListener('click', function (event) {
    console.log(event.target);
  })
  */
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

document.addEventListener('submit', event => {
  event.preventDefault();
  let deck_id_from_option = event.target.querySelector('select[name="deck_select"]').value;

  const decks = document.querySelectorAll('.deck-rem');
  decks.forEach(function(element) {
    element.dataset.display_status = 'hide';
  });

  decks.forEach(function(element) {
    //console.log(element.dataset.deck_id);
    if(+deck_id_from_option === +element.dataset.deck_id) {
      element.dataset.display_status = 'show';
    }
  });

  event.target.closest('form').remove();

  const cards = document.querySelectorAll('.deck-rem[data-display_status="show"] .card');
  card_selection(cards);
});


document.addEventListener("click", event => {

  const show_answer_but = event.target.closest('.show-answer-but');

  if (show_answer_but) {
    let card = show_answer_but.closest('.card').querySelector('.card-answ');

    if (card) {
      if (card.dataset.display_status === 'hide') {
        card.dataset.display_status = 'show';
      }
    }
    show_answer_but.remove();
  }

});