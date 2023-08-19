<h1>Brands Management</h1>


<table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#Id</th>
              <th scope="col">Name</th>
              <th scope="col">Action</th>
              
            </tr>
          </thead>
          <tbody>
            <?php foreach ($brands as $brand):?>
            <tr>
              <td><?=$brand->id?></td>
              <td><?=$brand->name?></td>
              <td>
                <a href="/admin/brands/edit/<?=$brand->id?>"><button class="btn btn-warning">Edit</button></a>
                <form action="/admin/brands/destroy/<?=$brand->id?>" method="post" style="display: inline-block;">
                <input type="hidden" name="id" value="<?=$brand->id?>">
                <button class="btn btn-danger" type="submit">Delete</button>
              
                </form>
              </td>
              
            </tr>
            <?php endforeach?>

            </tbody>
        </table>
