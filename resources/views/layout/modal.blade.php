<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Edit User: </h4>
      </div>
      <div class="modal-body">
        <form id="editUserForm" method="POST">
          <div class="form-group">
            <label class="control-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
          </div>
          <input type="hidden" name="editUser">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="submitBtn" id="submitBtn" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>