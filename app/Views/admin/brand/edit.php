<div class="row p-0 m-0">
    <form method="post" action="/admin/brands/update">
        <input type="hidden" name="id" value="<?=$brand->id?>">
    <div class="mb-3">
        <label for="brand_name" class="form-label">Brand Name</label>
        <input type="text" class="form-control" name="name" id="brand_name" value="<?=$brand->name?>">
    </div>
    <div class="mb-3">
        <label for="brand_description" class="form-label">Brand description</label>
        <textarea class="form-control" name="description" id="brand_description" rows="3"><?=$brand->description?></textarea>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary mb-3">Update Brand</button>
    </div>

  </form>
</div>
