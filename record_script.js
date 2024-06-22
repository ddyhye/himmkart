$(document).ready(function () {
  var prevData = "";

  // php로 db 연결
  $.ajax({
    url: "record_db.php",
    type: "get",
    data: {
      action: "firstLoad"
    },
    success: function (response) {
      $(".mainBody").html(response);
      prevData = $(".mainBody").html();
    },
    error: function (error) {
      console.log(error);
    },
  });

  $(".footBody-Send-btn").click(function () {
    var scoreData = {
      score: $(".footBody-Input-score-int").val(),
      name: $(".footBody-Input-name-int").val(),
      phone_number: $(".footBody-Input-phoneNum-int").val()
    }

    $.ajax({
      url: "record_insert.php",
      type: "GET",
      data: scoreData,
      success: function (response) {
        $.ajax({
	  url: "record_db.php",
	  type: "get",
	  data: {
	    action: "firstLoad"
	  },
	  success: function (response) {
	    $(".mainBody").html(response);
	    var currentData = $(".mainBody").html();

	    if (prevData !== currentData) {
	      var audioElement = $(".audio-play")[0];
	      audioElement.volume = 1.0;
	      audioElement.src = "success.mp3";
	      audioElement.play();
	    } else {
	      var audioElement = $(".audio-play")[0];
	      audioElement.volume = 1.0;
	      audioElement.src = "fail.mp3";
	      audioElement.play();
	    }
	    prevData = currentData;
	  },
	  error: function (error) {
	    console.log(error);
	  },
	});
      },
      error: function (error) {
	console.log(error);
      },
    });
  });
});
