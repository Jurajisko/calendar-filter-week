$(document).ready(function () {
  M.AutoInit();

  // Materialize
  $("select").formSelect();

  $("[name=reset]").click(function () {
    window.location.href = window.location.href.split("?")[0];
  });

  $("[name=load-events]").click(function () {
    let month = $(".months").val(),
      year = $(".years").val(),
      week = $(".week").val();

    if (month == null) {
      alert("Please, Select a month");
    } else if (year == null) {
      alert("Please, Select a year");
    } else {
      // Adding 0 before single / one digit (0-9)
      month.length < 2 ? (month = "0" + month) : (month = month);
      location.href = `?month=${month}&year=${year}&week=${week}`;
    }
  });

  //   $("[name=next]").click(function () {
  //     let month = $(".months").val(),
  //       year = $(".years").val(),
  //       week = $(".week").val();
  //     if (month == null) {
  //       alert("Please, Select a month");
  //     } else if (year == null) {
  //       alert("Please, Select a year");
  //     } else {
  //       // Adding 0 before single / one digit (0-9)
  //       month.length < 2 ? (month = "0" + month) : (month = month);
  //     }
  //   });

  let getHref = location.href;
  console.log(getHref);

  selectedWeek = $(".week").val();
  if (selectedWeek != "Full") {
    $("table tr").fadeOut(100, () => {
      // Fade In The Headers
      $("table tr").eq(0).fadeIn(500);

      // Fade In Only the Selected Week (ROW)
      $("table tr").eq(selectedWeek).fadeIn(500);
    });
  } else {
    false;
  }

  //   localStorage.setItem("jsonData");
  //   $(".week").on("click", function () {
  //     let uncheck_week = [];
  //     let check_week = [];
  //     let this_week = $(this).data("week");

  //     /* if checkbox checked */
  //     if ($(this).children("input").is(":checked")) {
  //       /* YES CHECKED */
  //       /* click for uncheck*/
  //       $(this).children("input").prop("checked", false);
  //       /* get data for checked checkbox */
  //       if (localStorage.getItem("json_check")) {
  //         /* get JSON check data  */
  //         let json_check = JSON.parse(localStorage.getItem("json_check"));

  //         /* check same value from JSON data from LocalStorage */
  //         $.each(json_check, function (key, value) {
  //           if (value != this_week) {
  //             // json_check.push(value);
  //             console.log(value);
  //           }
  //         });

  //         /* Save new data for CHECK week */
  //         localStorage.setItem("json_check", JSON.stringify(json_check));

  //         console.log(json_check);
  //       } else {
  //         uncheck_week.push(this_week);
  //         localStorage.setItem("json_uncheck", JSON.stringify(uncheck_week));
  //       }
  //     } else {
  //       $(this).children("input").prop("checked", true);
  //       if (localStorage.getItem("json_check")) {
  //         let json_check = JSON.parse(localStorage.getItem("json_check"));
  //         json_check.push(this_week);
  //         localStorage.setItem("json_check", JSON.stringify(json_check));
  //       } else {
  //         check_week.push(this_week);
  //         localStorage.setItem("json_check", JSON.stringify(check_week));
  //       }
  //     }
  //   });

  var chks = {
    check_week: [],
    only_weekend: [],
  };

  function saveSet(id, checks) {
    console.log(id, checks);
    chks[id] = checks;
    localStorage.setItem("selected_checkboxes", JSON.stringify(chks));
    // console.log(id, localStorage.getItem("selected_checkboxes"));
  }

  $(".weekend").on("click", function () {
    let id = $(this).data("id");
    let weekend = $(this).find(":checkbox").is(":checked");
    //   console.log(weekend);
    let $weekend = $("#" + id).find(":checkbox");
    //   console.log($weekend);
    saveSet(
      id,
      weekend
        ? $weekend
            .map(function () {
              return "1";
            })
            .get()
        : []
    ); // save all or none
  });

  $(function () {
    var chks = localStorage.getItem("selected_checkboxes");
    if (chks) {
      chks = JSON.parse(chks);
      $.each(chks, function (key, val) {
        $.each(val, function (_, id) {
          $("#" + id).prop("checked", true);
        });
      });
    }

    $(".sel, .remove").on("click", function () {
      let sel = $(this).is(".sel"); // sel => true/flase
      //   console.log(sel);
      let id = $(this).data("id");
      let $checks = $("#" + id).find(":checkbox");
      //   console.log($checks);
      $checks.prop("checked", sel); // true/false
      saveSet(
        id,
        sel
          ? $checks
              .map(function () {
                return this.id;
              })
              .get()
          : []
      ); // save all or none
    });

    $("table :checkbox").on("click", function () {
      var $container = $(this).closest("table");
      saveSet(
        $container.attr("id"),
        $container
          .find(":checkbox:checked")
          .map(function () {
            return this.id;
          })
          .get()
      );
    });
  });
});
