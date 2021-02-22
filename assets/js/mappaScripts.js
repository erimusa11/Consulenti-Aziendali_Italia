//function to show all the cards
function showConsulenti(category_list) {
  if (category_list.length > 0) {
    $(".card").css("display", "block");
    //for each card check if id from select list are in data-tag
    $(".card").each(function () {
      var item = $(this).attr("data-tag");
      item = item.split(",");
      var constant = false;
      for (var i = 0; i < category_list.length; i++) {
        if (jQuery.inArray(category_list[i], item) != -1) {
          constant = true;
        }
      }
      if (constant == true) {
        $(this).fadeIn("slow");
      } else {
        $(this).hide();
      }
    });
  } else {
    $(".card").css("display", "none");
  }
}

function calabria() {
  var cat_list = ["Calabria"];
  showConsulenti(cat_list);
  $(".consulenticalabria").slideToggle("slow");
  $("#headerH5").text("");
  $(".consulenticalabria").val(function () {
    var regione = $(".consulenticalabria").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}

function veneto() {
  var cat_list = ["Veneto"];
  showConsulenti(cat_list);
  $("#headerH5").text("");
  $(".consulentiveneto").val(function () {
    var regione = $(".consulentiveneto").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}

function friuli() {
  var cat_list = ["Friuli Venezia Giulia"];
  showConsulenti(cat_list);
  $("#headerH5").text("");
  $(".consulentifriuliveneziagiulia").val(function () {
    var regione = $(".consulentifriuliveneziagiulia").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}

function liguria() {
  var cat_list = ["Liguria"];
  showConsulenti(cat_list);
  $("#headerH5").text("");
  $(".consulentiliguria").val(function () {
    var regione = $(".consulentiliguria").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}

function toscana() {
  var cat_list = ["Toscana"];
  showConsulenti(cat_list);
  $("#headerH5").text("");
  $(".consulentitoscana").val(function () {
    var regione = $(".consulentitoscana").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}

function sicilia() {
  var cat_list = ["Sicilia"];
  showConsulenti(cat_list);
  $("#headerH5").text("");
  $(".consulentisicilia").val(function () {
    var regione = $(".consulentisicilia").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}

function sardegna() {
  var cat_list = ["Sardegna"];
  showConsulenti(cat_list);
  $("#headerH5").text("");
  $(".consulentisardegna").val(function () {
    var regione = $(".consulentisardegna").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}

function campania() {
  var cat_list = ["Campania"];
  showConsulenti(cat_list);
  $("#headerH5").text("");
  $(".consulenticampania").val(function () {
    var regione = $(".consulenticampania").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}

function marche() {
  var cat_list = ["Marche"];
  showConsulenti(cat_list);
  $("#headerH5").text("");
  $(".consulentimarche").val(function () {
    var regione = $(".consulentimarche").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}

function puglia() {
  var cat_list = ["Puglia"];
  showConsulenti(cat_list);
  $("#headerH5").text("");
  $(".consulentipuglia").val(function () {
    var regione = $(".consulentipuglia").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}

function lombardia() {
  var cat_list = ["Lombardia"];
  showConsulenti(cat_list);
  $("#headerH5").text("");
  $(".consulentilombardia").val(function () {
    var regione = $(".consulentilombardia").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}

function romagna() {
  var cat_list = ["Emilia Romagna"];
  showConsulenti(cat_list);
  $("#headerH5").text("");
  $(".consulentiemiliaromagna").val(function () {
    var regione = $(".consulentiemiliaromagna").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}

function piemonte() {
  var cat_list = ["Piemonte"];
  showConsulenti(cat_list);
  $("#headerH5").text("");
  $(".consulentipiemonte").val(function () {
    var regione = $(".consulentipiemonte").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}

function trentino() {
  var cat_list = ["Trentino Alto Adige"];
  showConsulenti(cat_list);
  $("#headerH5").text("");
  $(".consulentitrentinoaltoadige").val(function () {
    var regione = $(".consulentitrentinoaltoadige").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}

// /*
// function emilia() {
// $(".consulentimarche, .consulentipuglia, .consulentilombardia, .consulentiromagna, .consulentisardegna, .consulenticampania, .consulentisicilia, .consulentipiemonte, .consulentitrentinoaltoadige, .consulentitoscana, .consulentiliguria, .consulentiveneto, .consulentifriuliveneziagiulia, .consulenticalabria, .consulentilazio, .consulentiaosta, .consulentimolise, .consulentibasilicata, .consulentiabruzzo, .consulentiumbria").css("display","none");
// $(".consulentiemiliaromagna").slideToggle("slow");
// }*/

function lazio() {
  var cat_list = ["Lazio"];
  showConsulenti(cat_list);
  $("#headerH5").text("");
  $(".consulentilazio").val(function () {
    var regione = $(".consulentilazio").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}

function aosta() {
  var cat_list = ["Valle d'Aosta"];
  showConsulenti(cat_list);
  $("#headerH5").text("");
  $(".consulentiaosta").val(function () {
    regione = $(".consulentiaosta").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}

function molise() {
  var cat_list = ["Molise"];
  showConsulenti(cat_list);
  $("#headerH5").text("");
  $(".consulentimolise").val(function () {
    var regione = $(".consulentimolise").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}

function basilicata() {
  var cat_list = ["Basilicata"];
  showConsulenti(cat_list);
  $("#headerH5").text("");
  $(".consulentibasilicata").val(function () {
    var regione = $(".consulentibasilicata").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}

function abruzzo() {
  var cat_list = ["Abruzzo"];
  showConsulenti(cat_list);
  $("#headerH5").text("");
  $(".consulentiabruzzo").val(function () {
    var regione = $(".consulentiabruzzo").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}

function umbria() {
  var cat_list = ["Umbria"];
  showConsulenti(cat_list);
  $("#headerH5").text("");
  $(".consulentiumbria").val(function () {
    var regione = $(".consulentiumbria").attr("attregione");
    $("#headerH5").text(regione);
  });
  $("#headerH5").css("display", "none");
  $("#headerH5").slideToggle("slow");
}
