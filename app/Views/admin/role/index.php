<h1>Roles Management</h1>


<table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#Id</th>
              <th scope="col">Name</th>
              <th scope="col">Action</th>
              
            </tr>
          </thead>
          <tbody>
            <?php foreach ($roles as $role):?>
            <tr>
              <td><?=$role->id?></td>
              <td><?=$role->name?></td>
              <td>
                <a href="/admin/roles/edit/<?=$role->id?>"><button class="btn btn-warning">Edit</button></a>
                <form action="/admin/roles/destroy/<?=$role->id?>" method="post" style="display: inline-block;">
                <input type="hidden" name="id" value="<?=$role->id?>">
                <button class="btn btn-danger" type="submit">Delete</button>
              
                </form>
              </td>
              
            </tr>
            <?php endforeach?>

            </tbody>
        </table>
