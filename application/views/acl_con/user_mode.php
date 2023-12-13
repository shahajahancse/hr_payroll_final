
<style>
    #mytable {
        border-collapse: collapse;
    }

    #mytable, th, td {
        border: 1px solid #b0c0df;
        text-align: center;
        vertical-align: middle !important;
    }
    .table td {
        padding: 0px 3px !important;
        font-size: 13px;

    }
    table.dataTable thead th, table.dataTable thead td {
        border-bottom: none;
    }
    table.dataTable tbody th, table.dataTable tbody td {
      padding: 4px !important;
    }
    .center-text {
        vertical-align: center;
        padding: 5px 10px;
        /* line-height: 40px; Should be equal to the button's height */
    }
</style>


<div class="content">
    <div class="col-md-12" style="display: flex; gap: 10px; flex-direction: column">
        <div class="col-md-12">
            <div class="tablebox">
                <div class="col-md-12" style="display: flex; justify-content: space-between">
                    <div class="col-md-6" style="display: flex; justify-content: flex-start; align-items: center;"><a onclick='add_form_render();' class="btn btn-primary">Add User Mode</a>
                    </div>
                    <div class="col-md-6" style="display: flex; justify-content: flex-end; align-items: center;"><input type="text" placeholder="Search"  id="search_text">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12" style="display: none;" id="add_form">
            <div class="tablebox">
                <div class="col-md-12">
                   <div class="col-md-3">
                      <label> Select User</label>
                      <select class="form-control select22" id="select_user" onchange="get_unit(this.value);" >
                          <option value="">Select User</option>
                          <?php foreach ($users as $user) {?>
                              <option value="<?=$user->id?>"><?=$user->id_number?></option>
                         <?php }?>
                      </select>
                   </div>
                   <div class="col-md-3">
                      <label> Unit name </label>
                      <input type="hidden" class="form-control" id="unit_id">
                      <input type="text" class="form-control" id="unit_name" disabled>
                   </div>

                   <div class="col-md-3">
                      <label> Start Month</label>
                      <input type="date" class="form-control" id="start_month">
                   </div>
                   <div class="col-md-3">
                      <label> End Month</label>
                      <input type="date" class="form-control" id="end_month">
                   </div>
                </div>
                <div class="col-md-12">
                   <div class="col-md-3">
                      <label> User Mode </label>
                      <input type="text" class="form-control" id="user_mode" >
                   </div>
                   <div class="col-md-3">
                      <label> EOT</label>
                      <input type="text" class="form-control" id="eot" >
                   </div>
                  <div class="col-md-3" style="margin-top: 15px;">
                      <label> Status</label>
                      <input type="radio" name="status" value="1" id="status"> Active
                      <input type="radio" name="status" value="0" id="status"> In-Active
                  </div>
                  <div class="col-md-3" style="margin-top: 15px;">
                  <input type="hidden" value='' id="action">
                  <input type="hidden" value='' id="id">
                     <a class="btn btn-primary" onclick="submit_user_mode(event);">Submit</a>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="tablebox">
            <div class="col-md-6" style="margin-left:-16px">
                <h3 style="font-weight:bold">User Mode List</h3>
            </div>
               <table  class="table" id="mytable">
                  <thead>
                     <tr>
                        <th>User</th>
                        <th>Unit</th>
                        <th>Start Month</th>
                        <th>End Month</th>
                        <th>User Mode</th>
                        <th>EOT</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody id="data_table">
                    <?php foreach ($data as $key => $value) {?>
                        <tr>
                            <td><?=$value->id_number?></td>
                            <td><?=($value->unit_id == 0) ? 'All Unit' : $value->unit_name?></td>
                            <td><?=$value->start_month?></td>
                            <td><?=$value->end_month?></td>
                            <td><?=$value->user_mode?></td>
                            <td><?=$value->eot?></td>
                            <td><?=$value->status?></td>
                            <td>
                                <a class="btn btn-info btn-sm" onclick="edit_user_mode(<?=$value->id?> ,this);">Edit</a>
                                <a class="btn btn-danger btn-sm" onclick="delete_user_mode(<?=$value->id?>,this);">Delete</a>
                            </td>
                        </tr>
                    <?php }?>
                  </tbody>
               </table>

            </div>
        </div>
    </div>
</div>

<script>
    function add_form_render(){
        $("#add_form").scrollTop(0).slideDown();
        $("#action").val(1)
        $("#select_user").val(''),
        $("#unit_id").val(''),
        $("#unit_name").val(''),
        $("#start_month").val(''),
        $("#end_month").val(''),
        $("#user_mode").val(''),
        $("#eot").val(''),
        $("#status").val('')
    }
</script>
<script>
    function get_unit(id){
        $.ajax({
            type: "get",
            url: "<?=base_url('acl_con/get_unit_member_id')?>" + "/" + id,
            data: {
                id: id
            },
            success: function (d) {
                var data=JSON.parse(d);
                if (data == null) {
                    $("#unit_id").val(0);
                    $("#unit_name").val('All');
                }else{
                    $("#unit_id").val(data.unit_id);
                    $("#unit_name").val(data.unit_name);
                }
            }
        })
    }

</script>
<script>
    function submit_user_mode(e){
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?=base_url('acl_con/submit_user_mode')?>",
            data: {
                select_user: $("#select_user").val(),
                unit_id: $("#unit_id").val(),
                unit_name: $("#unit_name").val(),
                start_month: $("#start_month").val(),
                end_month: $("#end_month").val(),
                user_mode: $("#user_mode").val(),
                eot: $("#eot").val(),
                status: $("#status").val(),
                type:$("#action").val(),
                id:$("#id").val()
            },
            success: function (d) {
                if (d == 'false') {
                    showMessage('danger','Something went wrong!')
                }else{
                    $("#select_user").val(''),
                    $("#unit_id").val(''),
                    $("#unit_name").val(''),
                    $("#start_month").val(''),
                    $("#end_month").val(''),
                    $("#user_mode").val(''),
                    $("#eot").val(''),
                    $("#status").val('')
                    showMessage('success','Record Added successfully!')
                    var data=JSON.parse(d);
                    $("#add_form").slideUp();

                  var tr = `<tr>
                      <td>${data.id_number}</td>
                      <td>${(data.unit_id=='0')? 'All Unit': data.unit_name}</td>
                      <td>${data.start_month}</td>
                      <td>${data.end_month}</td>
                      <td>${data.user_mode}</td>
                      <td>${data.eot}</td>
                      <td>${data.status}</td>
                      <td>
                          <a class="btn btn-info btn-sm" onclick="edit_user_mode(${data.id},this);">Edit</a>
                          <a class="btn btn-danger btn-sm" onclick="delete_user_mode(${data.id},this);">Delete</a>
                      </td>
                  </tr>`;

                  $("#data_table").prepend(tr);
                }
            },
            error: function (d) {
                console.log(d);
            }

        })
    }
</script>
<script>
    function delete_user_mode(id,element){
        $.ajax({
            type: "get",
            url: "<?=base_url('acl_con/delete_user_mode')?>" + "/" + id,
            success: function (d) {
                if (d == 'false') {
                    showMessage('danger','Something went wrong!')
                }
                else{
                    element.closest('tr').remove();
                    showMessage('success','Record Deleted successfully!')
                }
            }

        })
    }
</script>

<script>
    function edit_user_mode(id ,element){
        $("#action").val(2)
        $.ajax({
            type: "get",
            url: "<?=base_url('acl_con/edit_user_mode')?>" + "/" + id,
            data: {
                id: id
            },
            success: function (d) {
                element.closest('tr').remove();
                var data=JSON.parse(d);
                $("#select_user").val(data.user_id);
                $("#unit_id").val(data.unit_id);
                $("#unit_name").val(data.unit_name);
                $("#start_month").val(data.start_month);
                $("#end_month").val(data.end_month);
                $("#user_mode").val(data.user_mode);
                $("#eot").val(data.eot);
                $("#status").val(data.status);
                $("#add_form").slideDown();
            }
        })
    }
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $("#mytable").dataTable();
    $('#mytable_filter').css({"display": "none"})
    $('#mytable_length').css({"display": "none"})
    $("#mytable").dataTable();
    oTable = $('#mytable').DataTable();
    $('#search_text').keyup(function(){
      oTable.search($(this).val()).draw() ;
    })
  });
</script>

