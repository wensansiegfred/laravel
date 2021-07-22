<div class="main-rooms">
    <div class="container">
      <div class="row">
        <div class="col">
          <button type="button" class="btn btn-primary float-end" onClick="createRoom()">Create Room</button>
        </div>
      </div>
      <div class="row room-list">
        <div class="col">
          <div class="row">
            <label>My Rooms</label>
            <div class="col">
              <table class="table table-hover">
                <thead>
                  <th>Name</th>
                  <th>Public</th>
                  <th>Active</th>
                  <th>Date</th>
                  <th>&nbsp;</th>
                </thead>
                <tbody>
                  @if (count($data["my_rooms"]) > 0)
                    @foreach($data["my_rooms"] as $my_room)
                      <tr>
                        <td>{{ $my_room->name }}</td>
                        <td>{{ $my_room->public ? 'true' : 'false' }}</td>
                        <td>{{ $my_room->active  ? 'true' : 'false' }}</td>
                        <td>{{ date('d-m-Y', strtotime($my_room->created_at)) }}</td>
                        <td><button type="button" class="btn btn-outline-success">Enter</button></td>
                      </tr>
                    @endforeach
                  @else
                    <tr>
                      <td colspan="5">You have no rooms</td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
          <br>
          <div class="row">
            <label>Public Rooms</label>
            <div class="col">
              <table class="table table-hover">
                <thead>
                  <th>Name</th>
                  <th>Created By</th>
                  <th>Date</th>
                  <th>&nbsp;</th>
                </thead>
                <tbody>
                  @if (count($data["public_rooms"]) > 0)
                    @foreach($data["public_rooms"] as $pub_room)
                      <tr>
                        <td>{{ $pub_room->name }}</td>
                        <td>{{ $pub_room->created_by }}</td>
                        <td>{{ date('d-m-Y', strtotime($pub_room->created_at)) }}</td>
                        <td><button type="button" class="btn btn-outline-success">Join</button></td>
                      </tr>
                    @endforeach
                  @else
                    <tr>
                      <td colspan="4">No available public rooms.</td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
