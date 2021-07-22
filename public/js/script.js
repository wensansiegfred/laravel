$(document).ready(function() {
  //console.log("hello")
});

function loadRooms() {
  $.ajax({
			type: 'GET',
			url: '/dashboard/rooms',
			data: {},
			success: function(data) {
        $(".dashboard-content").html(data);
			},
			error: function(xhr) {
				console.log(xhr)
			}
	});
}

function createRoom() {
  $.ajax({
      type: 'GET',
      url: '/dashboard/create_room',
      data: {},
      success: function(data) {
        $(".dashboard-content").html(data);
      },
      error: function(xhr) {
        console.log(xhr)
      }
  });
}

function addRoom() {
  const name = $("#room-name").val();
  const public = $("#is_public").is(":checked");

  if (name.length > 0) {
    $.ajax({
        type: 'POST',
        url: 'api/room/add_room',
        data: {
          name: name,
          public: public,
          userId: $("#userId").val()
        },
        success: function(data) {
          loadRooms();
        },
        error: function(xhr) {
          console.log(xhr)
        }
    });
  }
}
