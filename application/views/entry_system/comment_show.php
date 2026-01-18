<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Employee Comments</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { padding: 20px; }
    table th, table td { text-align: center; vertical-align: middle; font-size: 13px; }
    .btn { border-radius: 2px; padding: 2px 8px; }
  </style>
</head>
<body>

  <div class="container">
    <h5 class="mb-3 text-center">
      Comments About <br>
      Name: <?php echo $values[0]['name_en']; ?>, 
      Emp. ID: <?php echo $values[0]['emp_id']; ?>
    </h5>

    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sl</th>
          <th>Date</th>
          <th>Comment</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $i = 1;
        foreach ($values as $comment): ?>
          <tr id="row-<?php echo $comment['id']; ?>">
            <td><?php echo $i++; ?></td>
            <td class="date-cell"><?php echo htmlspecialchars($comment['date_time']); ?></td>
            <td class="comment-text"><?php echo htmlspecialchars($comment['comment']); ?></td>
            <td>
              <button 
                class="btn btn-sm btn-primary editBtn"
                data-id="<?php echo $comment['id']; ?>"
                data-comment="<?php echo htmlspecialchars($comment['comment']); ?>"
              >Edit</button>
              <a href="<?php echo base_url('entry_system_con/delete_comment/'.$comment['id']); ?>" 
                 class="btn btn-sm btn-danger"
                 onclick="return confirm('Delete this comment?');">
                Delete
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Comment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editForm">
            <input type="hidden" id="commentId" name="id">
            <div class="mb-3">
              <label for="commentText" class="form-label">Comment</label>
              <textarea id="commentText" name="comment" class="form-control" rows="4"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success btn-sm" id="saveComment">Save Changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery (required by your request) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Bootstrap bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(function(){
// prepare Bootstrap Modal instance
var bsModal = new bootstrap.Modal($('#editModal')[0], {});

// Event delegation: handle clicks on any .editBtn (works if rows change dynamically)
$(document).on('click', '.editBtn', function(e){
    e.preventDefault();
    alert('lo');
    var $btn = $(this);
    console.log('Edit button clicked', $btn.data());

    var id = $btn.data('id');
    var comment = $btn.data('comment') || '';

    // populate modal fields
    $('#commentId').val(id);
    $('#commentText').val(comment);

    // show modal
    bsModal.show();
});

// Save changes
$('#saveComment').on('click', function(e){
    e.preventDefault();

    var id = $('#commentId').val();
    var newComment = $('#commentText').val().trim();

    if (!newComment) {
    alert('Comment cannot be empty!');
    return;
    }

    // disable button while saving
    var $btn = $(this);
    $btn.prop('disabled', true).text('Saving...');

    $.ajax({
    url: '<?php echo base_url("entry_system_con/update_comment"); ?>',
    method: 'POST',
    contentType: 'application/json; charset=utf-8',
    dataType: 'json',
    data: JSON.stringify({ id: id, comment: newComment }),
    success: function(response) {
        console.log('Server response:', response);
        if (response && response.status === 'success') {
        // update table comment cell
        var $row = $('#row-' + id);
        $row.find('.comment-text').text(newComment);

        // update date_time cell if server returned updated datetime
        if (response.date_time) {
            $row.find('.date-cell').text(response.date_time);
        }

        bsModal.hide();
        // give user feedback
        // small non-blocking notice
        $('<div class="toast align-items-center text-bg-success border-0 position-fixed" style="top:20px; right:20px; z-index:2000;" role="alert" aria-live="assertive" aria-atomic="true">' +
            '<div class="d-flex"><div class="toast-body">Comment updated successfully</div>' +
            '<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button></div></div>')
            .appendTo('body')
            .toast({ delay: 3000 })
            .toast('show');

        } else {
        alert('Failed to update comment: ' + (response.message || 'Unknown error'));
        }
    },
    error: function(xhr, status, err) {
        console.error('AJAX error', status, err, xhr.responseText);
        alert('Error while updating comment. See console for details.');
    },
    complete: function() {
        $btn.prop('disabled', false).text('Save Changes');
    }
    });
});
});
</script>
</body>
</html>
