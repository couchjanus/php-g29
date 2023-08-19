<h1>Categories Management</h1>


<table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#Id</th>
              <th scope="col">Name</th>
              <th scope="col">Action</th>
              
            </tr>
          </thead>
          <tbody>
            <?php foreach ($categories as $category):?>
            <tr>
              <td><?=$category->id?></td>
              <td><?=$category->name?></td>
              <td>
                <a href="/admin/categories/edit/<?=$category->id?>"><button class="btn btn-warning">Edit</button></a>
                <form action="/admin/categories/destroy/<?=$category->id?>" method="post" style="display: inline-block;">
                <input type="hidden" name="id" value="<?=$category->id?>">
                <button class="btn btn-danger" type="submit">Delete</button>
              
                </form>
              </td>
              
            </tr>
            <?php endforeach?>

            </tbody>
        </table>
