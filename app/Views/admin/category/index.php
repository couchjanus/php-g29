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
            <?php foreach ($brands as $brand):?>
            <tr>
              <td><?=$brand['id']?></td>
              <td><?=$brand['name']?></td>
              <td>data</td>
              
            </tr>
            <?php endforeach?>

            </tbody>
        </table>
