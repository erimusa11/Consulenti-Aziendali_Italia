$(document).ready(function () {
  //hidding the select with regione
  $("#selectRegione").hide();

  //button search with regione
  $("#btnFilter").on("click", function () {
    //get id from specializzacioni select
    var category_list = [];
    $.each($("input[name='chkbox']:checked"), function () {
      category_list.push($(this).val());
    });

    var regione_list = [];
    //get id from regione select
    $.each($("input[name='chkboxRegione']:checked"), function () {
      regione_list.push($(this).val());
    });

    if (category_list.length == 0) {
      alert("Seleziona un'opzione");
    }

    if (regione_list.length == 0) {
      alert("Seleziona un'opzione");
    } else {
      $.ajax({
        url: "showUserAjax.php",
        type: "post",
        data: {
          categoryList: category_list,
          regioneList: regione_list,
        },
        success: function (data) {
          $("#consulentiList").html(data);
        },
      });
    }
  });

  //button go back
  $("#btnGoBack").on("click", function () {
    $(".chkboxRegione").prop("checked", false);
    $("#checkConsulenti").show();
    $("#selectRegione").hide();
    $("#consulentiList").html("");
  });

  //checkbox filter with category
  $("#btnFilterChk").on("click", function () {
    var cat_list = [];

    $.each($("input[name='chkbox']:checked"), function () {
      cat_list.push($(this).val());
    });
    if (cat_list.length == 0) {
      alert("select an option");
    } else {
      $("#selectRegione").show();
      $("#checkConsulenti").hide();
      arrList = cat_list + "";
      $.ajax({
        url: "showRegione.php",
        type: "post",
        data: {
          idList: arrList,
        },
        success: function (data) {
          arrRegione = JSON.parse(data);
          var theme = '<div class="row">';
          for (i = 0; i < arrRegione.length; i++) {
            theme =
              theme +
              ` <div class="col-md-6">
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-checkbox checkbox-info">
                            <input type="checkbox" class="custom-control-input chkboxRegione"
                                id="chkbox${arrRegione[i].regione}" name='chkboxRegione' value="${arrRegione[i].regione}">
                            <label class="custom-control-label"
                                for="chkbox${arrRegione[i].regione}">${arrRegione[i].regione}</label>
                        </div>
                    </div>
                </div>
         `;
          }
          theme = theme + `    </div>`;
          $("#appendRegione").html(theme);
        },
        error: function (data) {
          console.log("error");
        },
      });
    }
  });

  //open modal
  $(".openModal").on("click", function () {
    var idConsulente = $(this).val();
    $("#idConsulente").val(idConsulente);
  });
});
