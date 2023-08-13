<div class="row p-0 m-0">
    <form method="POST" action="/admin/brands/store">
    <div class="mb-3">
        <label for="brand_name" class="form-label">Brand Name</label>
        <input type="text" class="form-control" name="name" id="brand_name" placeholder="Ender Brand Name">
    </div>
    <div class="mb-3">
        <label for="brand_description" class="form-label">Brand description</label>
        <textarea class="form-control" id="brand_description" rows="3" name="description"></textarea>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary mb-3">Create Brand</button>
    </div>

  </form>
</div>
