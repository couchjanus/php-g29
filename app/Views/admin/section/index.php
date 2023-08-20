<h1>Sectiuons Management</h1>


<table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#Id</th>
              <th scope="col">Name</th>
              <th scope="col">Action</th>
              
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sections as $section):?>
            <tr>
              <td><?=$section->id?></td>
              <td><?=$section->name?></td>
              <td>
                <a href="/admin/sections/edit/<?=$section->id?>"><button class="btn btn-warning">Edit</button></a>
                <form action="/admin/sections/destroy/<?=$section->id?>" method="post" style="display: inline-block;">
                <input type="hidden" name="id" value="<?=$section->id?>">
                <button class="btn btn-danger" type="submit">Delete</button>
              
                </form>
              </td>
              
            </tr>
            <?php endforeach?>

            </tbody>
        </table>
