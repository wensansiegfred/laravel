<div class="container">
  <form class="form-control">
    @csrf
    <input type="hidden" id="userId" value="{{ $userId }}" />
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <label for="room-name" class="form-label">Room</label>
          <input type="text" class="form-control" id="room-name" placeholder="Room Name">
        </div>
        <div class="mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="is_public">
            <label class="form-check-label" for="is_public">
              Public
            </label>
          </div>
        </div>
        <div class="mb-3">
          <button type="button" class="btn btn-success" onClick="addRoom()">Submit</button>
        </div>
      </div>
    </div>
  </form>
</div>
