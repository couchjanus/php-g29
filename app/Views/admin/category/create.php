<div class="row p-0 m-0">
    <form method="post" action="/admin/categories/create" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="category_name" class="form-label">Category Name</label>
        <input type="text" class="form-control" id="category_name" name="name" placeholder="Ender Category Name">
    </div>
    <div class="mb-3">
        <label for="category_name" class="form-label">Category Section</label>
        <input type="text" class="form-control" id="section_id" name="section_id" placeholder="Ender Category Section">
    </div>
    <div class="input-group mb-3">
        <input type="file" name="cover" class="form-control" id="cover">
        <label for="cover" class="input-group-text">Chooser a file</label>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary mb-3">Create Category</button>
    </div>

  </form>
</div>
