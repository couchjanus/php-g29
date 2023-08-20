<h1>Badges Management</h1>


<table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#Id</th>
              <th scope="col">Title</th>
              <th scope="col">Action</th>
              
            </tr>
          </thead>
          <tbody>
            <?php foreach ($badges as $badge):?>
            <tr>
              <td><?=$badge->id?></td>
              <td><?=$badge->title?></td>
              <td>
                <a href="/admin/badges/edit/<?=$badge->id?>"><button class="btn btn-warning">Edit</button></a>
                <form action="/admin/badges/destroy/<?=$badge->id?>" method="post" style="display: inline-block;">
                <input type="hidden" name="id" value="<?=$badge->id?>">
                <button class="btn btn-danger" type="submit">Delete</button>
              
                </form>
              </td>
              
            </tr>
            <?php endforeach?>

            </tbody>
        </table>
