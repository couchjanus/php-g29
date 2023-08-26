<h1>Users Management</h1>


<table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#Id</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
              
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $user):?>
            <tr>
              <td><?=$user->id?></td>
              <td><?=$user->name?></td>
              <td><?=$user->email?></td>
              <td><?=$user->status?></td>
              <td>
                <a href="/admin/users/edit/<?=$user->id?>"><button class="btn btn-warning">Edit</button></a>
                <form action="/admin/users/destroy/<?=$user->id?>" method="post" style="display: inline-block;">
                <input type="hidden" name="id" value="<?=$user->id?>">
                <button class="btn btn-danger" type="submit">Delete</button>
              
                </form>
              </td>
              
            </tr>
            <?php endforeach?>

            </tbody>
        </table>
